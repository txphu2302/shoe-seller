<?php

class Users extends CoreModel
{
    public function findByUsernameOrEmail($identifier)
    {
        $sql = "SELECT id, name, email, password, avatar, role, status
                FROM users
                WHERE email = :identifier OR name = :identifier
                LIMIT 1";

        $this->query($sql);
        $this->bind(':identifier', $identifier);
        return $this->single();
    }

    public function findById($id)
    {
        $sql = "SELECT id, name, email, password, avatar, role, status
                FROM users
                WHERE id = :id
                LIMIT 1";

        $this->query($sql);
        $this->bind(':id', $id, PDO::PARAM_INT);
        return $this->single();
    }

    public function findByEmail($email)
    {
        $sql = "SELECT id, name, email, password, avatar, role, status
                FROM users
                WHERE email = :email
                LIMIT 1";

        $this->query($sql);
        $this->bind(':email', $email);
        return $this->single();
    }

    public function createUser($data)
    {
        $sql = "INSERT INTO users (name, email, password, avatar, role, status)
                VALUES (:name, :email, :password, :avatar, :role, :status)";

        $this->query($sql);
        $this->bind(':name', $data['name']);
        $this->bind(':email', $data['email']);
        $this->bind(':password', $data['password']);
        $this->bind(':avatar', $data['avatar']);
        $this->bind(':role', $data['role']);
        $this->bind(':status', $data['status']);

        return $this->execute();
    }

    public function countUsers($role = null)
    {
        $sql = "SELECT COUNT(*) as count FROM users";
        if ($role !== null) {
            $sql .= " WHERE role = :role";
        }
        $this->query($sql);
        if ($role !== null) {
            $this->bind(':role', $role);
        }
        $result = $this->single();
        return $result->count;
    }

    public function getAllUsers($limit = null, $offset = null)
    {
        $sql = "SELECT id, name, email, avatar, role, status, created_at FROM users ORDER BY created_at DESC";
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

    public function updateStatus($id, $status)
    {
        $sql = "UPDATE users SET status = :status WHERE id = :id";
        $this->query($sql);
        $this->bind(':status', $status);
        $this->bind(':id', $id, PDO::PARAM_INT);
        return $this->execute();
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $this->query($sql);
        $this->bind(':id', $id, PDO::PARAM_INT);
        return $this->execute();
    }
    public function updateProfile($id, $name, $avatar = null, $password = null)
    {
        $sql = "UPDATE users SET name = :name";
        if ($avatar !== null) {
            $sql .= ", avatar = :avatar";
        }
        if ($password !== null) {
            $sql .= ", password = :password";
        }
        $sql .= " WHERE id = :id";

        $this->query($sql);
        $this->bind(':name', $name);
        $this->bind(':id', $id, PDO::PARAM_INT);
        
        if ($avatar !== null) {
            $this->bind(':avatar', $avatar);
        }
        if ($password !== null) {
            $this->bind(':password', $password);
        }

        return $this->execute();
    }
}

