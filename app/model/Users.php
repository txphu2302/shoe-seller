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

    public function updateProfile($id, $name, $email)
    {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $this->query($sql);
        $this->bind(':name', $name);
        $this->bind(':email', $email);
        $this->bind(':id', $id, PDO::PARAM_INT);
        return $this->execute();
    }

    public function updatePassword($id, $hashedPassword)
    {
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $this->query($sql);
        $this->bind(':password', $hashedPassword);
        $this->bind(':id', $id, PDO::PARAM_INT);
        return $this->execute();
    }

    public function updateAvatar($id, $avatar)
    {
        $sql = "UPDATE users SET avatar = :avatar WHERE id = :id";
        $this->query($sql);
        $this->bind(':avatar', $avatar);
        $this->bind(':id', $id, PDO::PARAM_INT);
        return $this->execute();
    }

    public function findByEmailExcept($email, $excludeId)
    {
        $sql = "SELECT id FROM users WHERE email = :email AND id != :excludeId LIMIT 1";
        $this->query($sql);
        $this->bind(':email', $email);
        $this->bind(':excludeId', $excludeId, PDO::PARAM_INT);
        return $this->single();
    }
}
