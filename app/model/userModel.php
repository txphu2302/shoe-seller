<?php
class UserModel
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->dbh;
    }


    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM users ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindValue(':id', (int) $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function checkEmailExists($email)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE LOWER(email) = LOWER(:email) LIMIT 1");
        $stmt->bindValue(':email', trim($email), PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    }

    public function checkUsernameExists($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE name = :name LIMIT 1");
        $stmt->bindValue(':name', trim($username), PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    }

    public function register($params)
    {
        $name = trim($params["name"] ?? ($params["username"] ?? ""));
        $password = $params["password"];
        $email = strtolower(trim($params["email"]));
        $avatar = $params["avatar"] ?? null;
        $role = ($params["role"] ?? "member") === "admin" ? "admin" : "member";
        $status = $params["status"] ?? "active";
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (name, password, email, avatar, role, status) VALUES (:name, :password, :email, :avatar, :role, :status)");
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':avatar', $avatar, $avatar === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':role', $role, PDO::PARAM_STR);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function findByLoginIdentifier($identifier)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE LOWER(email) = LOWER(:identifier) OR name = :name LIMIT 1");
        $stmt->bindValue(':identifier', trim($identifier), PDO::PARAM_STR);
        $stmt->bindValue(':name', trim($identifier), PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    }

    public function login($params)
    {
        $user = $this->findByLoginIdentifier($params["usernameEmail"] ?? "");
        if (!$user) {
            return false;
        }

        return password_verify($params["password"] ?? "", $user["password"]) ? $user : false;
    }
}
