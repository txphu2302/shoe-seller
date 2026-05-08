<?php

class Product extends CoreModel
{
    public function getLatestProducts($limit = 6)
    {
        $limit = max(1, (int)$limit);

        $sql = "
            SELECT p.id, p.name, p.price, p.image, p.created_at, c.name AS category_name
            FROM products p
            JOIN categories c ON c.id = p.category_id
            ORDER BY p.created_at DESC, p.id DESC
            LIMIT {$limit}
        ";

        return $this->getAll($sql);
    }

    public function getBestSellingProducts($limit = 8)
    {
        $limit = max(1, (int)$limit);

        // Nếu chưa có đơn hàng, fallback sang latest products.
        $sql = "
            SELECT
                p.id, p.name, p.price, p.image, p.created_at, c.name AS category_name,
                SUM(od.quantity) AS sold_qty
            FROM order_details od
            JOIN products p ON p.id = od.product_id
            JOIN categories c ON c.id = p.category_id
            GROUP BY p.id, p.name, p.price, p.image, p.created_at, c.name
            ORDER BY sold_qty DESC, p.id DESC
            LIMIT {$limit}
        ";

        $rows = $this->getAll($sql);
        if (!empty($rows)) {
            return $rows;
        }

        return $this->getLatestProducts($limit);
    }
}

