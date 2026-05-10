<?php
class Order extends CoreModel
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'orders';
    }

    public function createOrder($userId, $totalAmount, $items)
    {
        try {
            $this->db->beginTransaction();

            // Insert into orders table
            $this->db->query("INSERT INTO orders (user_id, total_amount, status) VALUES (:user_id, :total_amount, 'pending')");
            $this->db->bind(':user_id', $userId);
            $this->db->bind(':total_amount', $totalAmount);
            $this->db->execute();

            $orderId = $this->db->lastInsertId();

            // Insert into order_details table
            foreach ($items as $item) {
                $this->db->query("INSERT INTO order_details (order_id, product_id, size, quantity, price) VALUES (:order_id, :product_id, :size, :quantity, :price)");
                $this->db->bind(':order_id', $orderId);
                $this->db->bind(':product_id', $item['product_id']);
                $this->db->bind(':size', $item['size']);
                $this->db->bind(':quantity', $item['quantity']);
                $this->db->bind(':price', $item['price']);
                $this->db->execute();
            }

            $this->db->commit();
            return $orderId;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Create Order Error: " . $e->getMessage());
            return false;
        }
    }

    public function getOrdersByUserId($userId)
    {
        $this->db->query("SELECT * FROM orders WHERE user_id = :user_id ORDER BY created_at DESC");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSetAssoc();
    }

    public function getOrderDetails($orderId)
    {
        $this->db->query("SELECT od.*, p.name as product_name, p.image as product_image 
                         FROM order_details od 
                         JOIN products p ON od.product_id = p.id 
                         WHERE od.order_id = :order_id");
        $this->db->bind(':order_id', $orderId);
        return $this->db->resultSetAssoc();
    }
}
