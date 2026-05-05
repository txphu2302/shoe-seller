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
}
