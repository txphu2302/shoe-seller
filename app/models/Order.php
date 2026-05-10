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

    // Admin methods
    public function getAllOrders($limit = null, $offset = 0, $filters = [])
    {
        $params = [];
        $where = '';
        $orderBy = 'ORDER BY o.created_at DESC';

        if (!empty($filters['status'])) {
            $where .= ($where ? ' AND ' : 'WHERE ') . 'o.status = :status';
            $params[':status'] = $filters['status'];
        }

        if (!empty($filters['order_id'])) {
            $where .= ($where ? ' AND ' : 'WHERE ') . 'o.id = :order_id';
            $params[':order_id'] = (int)$filters['order_id'];
        }

        if (!empty($filters['user_name'])) {
            $where .= ($where ? ' AND ' : 'WHERE ') . 'u.name LIKE :user_name';
            $params[':user_name'] = '%' . trim($filters['user_name']) . '%';
        }

        $sql = "SELECT o.*, u.name as user_name, u.email as user_email 
                FROM orders o 
                LEFT JOIN users u ON o.user_id = u.id 
                {$where} 
                {$orderBy}";

        if ($limit !== null) {
            $safeLimit = max(1, (int)$limit);
            $safeOffset = max(0, (int)$offset);
            $sql .= " LIMIT {$safeOffset}, {$safeLimit}";
        }

        $this->db->query($sql);
        foreach ($params as $key => $value) {
            $this->db->bind($key, $value);
        }
        return $this->db->resultSetAssoc();
    }

    public function countAllOrders($filters = [])
    {
        $params = [];
        $where = '';

        if (!empty($filters['status'])) {
            $where .= ($where ? ' AND ' : 'WHERE ') . 'o.status = :status';
            $params[':status'] = $filters['status'];
        }

        if (!empty($filters['order_id'])) {
            $where .= ($where ? ' AND ' : 'WHERE ') . 'o.id = :order_id';
            $params[':order_id'] = (int)$filters['order_id'];
        }

        if (!empty($filters['user_name'])) {
            $where .= ($where ? ' AND ' : 'WHERE ') . 'u.name LIKE :user_name';
            $params[':user_name'] = '%' . trim($filters['user_name']) . '%';
        }

        $sql = "SELECT COUNT(*) as total FROM orders o LEFT JOIN users u ON o.user_id = u.id {$where}";
        $this->query($sql);
        foreach ($params as $key => $value) {
            $this->bind($key, $value);
        }
        $this->execute();
        $row = $this->stmt->fetch(PDO::FETCH_ASSOC);
        return (int)($row['total'] ?? 0);
    }

    public function getOrderById($orderId)
    {
        $this->query("SELECT o.*, u.name as user_name, u.email as user_email, '' as user_phone 
                     FROM orders o 
                     LEFT JOIN users u ON o.user_id = u.id 
                     WHERE o.id = :order_id");
        $this->bind(':order_id', $orderId, PDO::PARAM_INT);
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function updateOrderStatus($orderId, $status)
    {
        $validStatuses = ['pending', 'processing', 'shipped', 'delivered', 'cancelled'];
        if (!in_array($status, $validStatuses)) {
            return false;
        }

        $this->db->query("UPDATE orders SET status = :status WHERE id = :order_id");
        $this->db->bind(':status', $status);
        $this->db->bind(':order_id', $orderId);
        return $this->db->execute();
    }

    public function deleteOrder($orderId)
    {
        try {
            $this->db->beginTransaction();

            // Delete order details first
            $this->db->query("DELETE FROM order_details WHERE order_id = :order_id");
            $this->db->bind(':order_id', $orderId);
            $this->db->execute();

            // Delete order
            $this->db->query("DELETE FROM orders WHERE id = :order_id");
            $this->db->bind(':order_id', $orderId);
            $this->db->execute();

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            error_log("Delete Order Error: " . $e->getMessage());
            return false;
        }
    }
}
