<?php

class Product extends CoreModel
{
    public function getCategories()
    {
        $sql = "
            SELECT id, name
            FROM categories
            ORDER BY name ASC
        ";

        return $this->getAll($sql);
    }

    public function countProductsByCategory($categoryId = null)
    {
        $params = [];
        $where = '';

        if ($categoryId !== null && $categoryId !== '' && ctype_digit((string)$categoryId)) {
            $where = 'WHERE p.category_id = :category_id';
            $params[':category_id'] = (int)$categoryId;
        }

        $sql = "
            SELECT COUNT(*) AS total
            FROM products p
            {$where}
        ";

        $this->query($sql);
        foreach ($params as $key => $value) {
            $this->bind($key, $value, PDO::PARAM_INT);
        }
        $this->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        return (int)($row['total'] ?? 0);
    }

    public function getProductsByCategory($categoryId = null, $limit = null, $offset = 0)
    {
        $params = [];
        $where = '';

        if ($categoryId !== null && $categoryId !== '' && ctype_digit((string)$categoryId)) {
            $where = 'WHERE p.category_id = :category_id';
            $params[':category_id'] = (int)$categoryId;
        }

        $limitClause = '';
        if ($limit !== null) {
            $safeLimit = max(1, (int)$limit);
            $safeOffset = max(0, (int)$offset);
            $limitClause = " LIMIT {$safeOffset}, {$safeLimit}";
        }

        $sql = "
            SELECT p.id, p.name, p.description, p.price, p.image, p.created_at,
                   c.id AS category_id, c.name AS category_name
            FROM products p
            JOIN categories c ON c.id = p.category_id
            {$where}
            ORDER BY p.created_at DESC, p.id DESC
            {$limitClause}
        ";

        $this->query($sql);
        foreach ($params as $key => $value) {
            $this->bind($key, $value, PDO::PARAM_INT);
        }
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

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

    public function getProductById($id)
    {
        $sql = "
            SELECT p.*, c.name AS category_name
            FROM products p
            JOIN categories c ON c.id = p.category_id
            WHERE p.id = :id
            LIMIT 1
        ";
        $this->query($sql);
        $this->bind(':id', (int)$id, PDO::PARAM_INT);
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function createProduct($data)
    {
        $sql = "
            INSERT INTO products (category_id, name, description, price, image)
            VALUES (:category_id, :name, :description, :price, :image)
        ";

        $this->query($sql);
        $this->bind(':category_id', (int)$data['category_id'], PDO::PARAM_INT);
        $this->bind(':name', (string)$data['name']);
        $this->bind(':description', (string)($data['description'] ?? ''));
        $this->bind(':price', (float)$data['price']);
        $this->bind(':image', (string)($data['image'] ?? ''));

        return $this->execute();
    }

    public function updateProduct($id, $data)
    {
        $sql = "
            UPDATE products
            SET category_id = :category_id,
                name = :name,
                description = :description,
                price = :price,
                image = :image
            WHERE id = :id
        ";

        $this->query($sql);
        $this->bind(':category_id', (int)$data['category_id'], PDO::PARAM_INT);
        $this->bind(':name', (string)$data['name']);
        $this->bind(':description', (string)($data['description'] ?? ''));
        $this->bind(':price', (float)$data['price']);
        $this->bind(':image', (string)($data['image'] ?? ''));
        $this->bind(':id', (int)$id, PDO::PARAM_INT);

        return $this->execute();
    }

    public function deleteProduct($id)
    {
        $this->query("DELETE FROM products WHERE id = :id");
        $this->bind(':id', (int)$id, PDO::PARAM_INT);
        return $this->execute();
    }

    public function countAdminProducts($filters = [])
    {
        $params = [];
        $whereSql = $this->buildAdminFilterWhere($filters, $params);

        $sql = "
            SELECT COUNT(*) AS total
            FROM products p
            JOIN categories c ON c.id = p.category_id
            {$whereSql}
        ";

        $this->query($sql);
        foreach ($params as $param => $value) {
            if ($param === ':filter_product_id' || $param === ':filter_category_id') {
                $this->bind($param, $value, PDO::PARAM_INT);
            } else {
                $this->bind($param, $value);
            }
        }
        $this->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);

        return (int)($row['total'] ?? 0);
    }

    public function getAdminProducts($filters = [], $limit = 25, $offset = 0)
    {
        $params = [];
        $whereSql = $this->buildAdminFilterWhere($filters, $params);
        $safeLimit = max(1, (int)$limit);
        $safeOffset = max(0, (int)$offset);

        $sql = "
            SELECT p.id, p.name, p.description, p.price, p.image, p.created_at,
                   c.id AS category_id, c.name AS category_name
            FROM products p
            JOIN categories c ON c.id = p.category_id
            {$whereSql}
            ORDER BY p.id ASC
            LIMIT {$safeOffset}, {$safeLimit}
        ";

        $this->query($sql);
        foreach ($params as $param => $value) {
            if ($param === ':filter_product_id' || $param === ':filter_category_id') {
                $this->bind($param, $value, PDO::PARAM_INT);
            } else {
                $this->bind($param, $value);
            }
        }
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function buildAdminFilterWhere($filters, &$params)
    {
        $clauses = [];

        if (!empty($filters['product_id'])) {
            if (ctype_digit((string)$filters['product_id'])) {
                $clauses[] = 'p.id = :filter_product_id';
                $params[':filter_product_id'] = (int)$filters['product_id'];
            } else {
                // Invalid product id filter should return no rows.
                $clauses[] = '1 = 0';
            }
        }

        if (!empty($filters['name'])) {
            $clauses[] = 'p.name LIKE :filter_name';
            $params[':filter_name'] = '%' . trim((string)$filters['name']) . '%';
        }

        if (!empty($filters['category_id'])) {
            if (ctype_digit((string)$filters['category_id'])) {
                $clauses[] = 'p.category_id = :filter_category_id';
                $params[':filter_category_id'] = (int)$filters['category_id'];
            } else {
                // Invalid category filter should return no rows.
                $clauses[] = '1 = 0';
            }
        }

        if (empty($clauses)) {
            return '';
        }

        return 'WHERE (' . implode(' OR ', $clauses) . ')';
    }

    // Public search methods for frontend
    public function searchProducts($keyword, $categoryId = null, $limit = null, $offset = 0)
    {
        $params = [];
        $where = 'WHERE (p.name LIKE :keyword OR p.description LIKE :keyword)';
        $params[':keyword'] = '%' . trim((string)$keyword) . '%';

        if ($categoryId !== null && $categoryId !== '' && ctype_digit((string)$categoryId)) {
            $where .= ' AND p.category_id = :category_id';
            $params[':category_id'] = (int)$categoryId;
        }

        $limitClause = '';
        if ($limit !== null) {
            $safeLimit = max(1, (int)$limit);
            $safeOffset = max(0, (int)$offset);
            $limitClause = " LIMIT {$safeOffset}, {$safeLimit}";
        }

        $sql = "
            SELECT p.id, p.name, p.description, p.price, p.image, p.created_at,
                   c.id AS category_id, c.name AS category_name
            FROM products p
            JOIN categories c ON c.id = p.category_id
            {$where}
            ORDER BY p.created_at DESC, p.id DESC
            {$limitClause}
        ";

        $this->query($sql);
        foreach ($params as $key => $value) {
            if ($key === ':category_id') {
                $this->bind($key, $value, PDO::PARAM_INT);
            } else {
                $this->bind($key, $value);
            }
        }
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countProductsBySearch($keyword, $categoryId = null)
    {
        $params = [];
        $where = 'WHERE (p.name LIKE :keyword OR p.description LIKE :keyword)';
        $params[':keyword'] = '%' . trim((string)$keyword) . '%';

        if ($categoryId !== null && $categoryId !== '' && ctype_digit((string)$categoryId)) {
            $where .= ' AND p.category_id = :category_id';
            $params[':category_id'] = (int)$categoryId;
        }

        $sql = "
            SELECT COUNT(*) AS total
            FROM products p
            {$where}
        ";

        $this->query($sql);
        foreach ($params as $key => $value) {
            if ($key === ':category_id') {
                $this->bind($key, $value, PDO::PARAM_INT);
            } else {
                $this->bind($key, $value);
            }
        }
        $this->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return (int)($row['total'] ?? 0);
    }
}
