<?php

require_once __DIR__ . '/../config/db.php';

class User extends DB{
    public function __construct() {
        parent::__construct();
    }

    public function register($fullname, $email, $password, $role){ 
        try {
            $sql = "INSERT INTO users (name, email, password, role) VALUES (:fullname, :email, :password, :role)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':fullname' => $fullname,
                ':email' => $email,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':role' => $role
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login($email, $password){
        try {
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':email' => $email
            ]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            }
            return false;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getStatus($email) {
        try {
            $sql = "SELECT status FROM users WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':email' => $email
            ]);
            $status = $stmt->fetch(PDO::FETCH_ASSOC);
            return $status['status'];
        } catch (PDOException $e) {
            return false;
        }
    }


    
}