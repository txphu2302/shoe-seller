<?php

class Contacts extends CoreModel
{
    private static $columnExistsCache = [];

    private function hasColumn($column)
    {
        $column = (string)$column;
        if (isset(self::$columnExistsCache[$column])) {
            return self::$columnExistsCache[$column];
        }

        try {
            $sql = "SHOW COLUMNS FROM contacts LIKE :col";
            $this->query($sql);
            $this->bind(':col', $column);
            $row = $this->single();
            self::$columnExistsCache[$column] = $row ? true : false;
        } catch (Exception $e) {
            // If query fails (permissions/driver), assume column not present to avoid fatal errors.
            self::$columnExistsCache[$column] = false;
        }

        return self::$columnExistsCache[$column];
    }

    public function getAllContacts($limit = null, $offset = null)
    {
        $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
        if ($limit !== null) {
            $sql .= " LIMIT :limit";
            if ($offset !== null) {
                $sql .= " OFFSET :offset";
            }
        }
        $this->query($sql);
        if ($limit !== null) {
            $this->bind(':limit', $limit, PDO::PARAM_INT);
            if ($offset !== null) {
                $this->bind(':offset', $offset, PDO::PARAM_INT);
            }
        }
        return $this->resultSet();
    }

    public function getContactById($id)
    {
        $sql = "SELECT * FROM contacts WHERE id = :id LIMIT 1";
        $this->query($sql);
        $this->bind(':id', $id, PDO::PARAM_INT);
        return $this->single();
    }

    public function getContactsByStatus($status, $limit = null, $offset = null)
    {
        $sql = "SELECT * FROM contacts WHERE status = :status ORDER BY created_at DESC";
        if ($limit !== null) {
            $sql .= " LIMIT :limit";
            if ($offset !== null) {
                $sql .= " OFFSET :offset";
            }
        }
        $this->query($sql);
        $this->bind(':status', $status);
        if ($limit !== null) {
            $this->bind(':limit', $limit, PDO::PARAM_INT);
            if ($offset !== null) {
                $this->bind(':offset', $offset, PDO::PARAM_INT);
            }
        }
        return $this->resultSet();
    }

    public function countContacts($status = null)
    {
        $sql = "SELECT COUNT(*) as count FROM contacts";
        if ($status !== null) {
            $sql .= " WHERE status = :status";
        }
        $this->query($sql);
        if ($status !== null) {
            $this->bind(':status', $status);
        }
        $result = $this->single();
        return $result->count;
    }

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE contacts SET status = :status WHERE id = :id";
        $this->query($sql);
        $this->bind(':id', $id, PDO::PARAM_INT);
        $this->bind(':status', $status);
        return $this->execute();
    }

    public function deleteContact($id)
    {
        $sql = "DELETE FROM contacts WHERE id = :id";
        $this->query($sql);
        $this->bind(':id', $id, PDO::PARAM_INT);
        return $this->execute();
    }

    public function createContact($data)
    {
        $hasSubject = $this->hasColumn('subject');
        if ($hasSubject) {
            $sql = "INSERT INTO contacts (name, email, phone, subject, message, status, created_at) 
                    VALUES (:name, :email, :phone, :subject, :message, 'unread', NOW())";
        } else {
            $sql = "INSERT INTO contacts (name, email, phone, message, status, created_at) 
                    VALUES (:name, :email, :phone, :message, 'unread', NOW())";
        }
        $this->query($sql);
        $this->bind(':name', $data['name']);
        $this->bind(':email', $data['email']);
        $this->bind(':phone', $data['phone'] ?? null);
        if ($hasSubject) {
            $this->bind(':subject', $data['subject'] ?? null);
        }
        $this->bind(':message', $data['message']);
        return $this->execute();
    }
}
