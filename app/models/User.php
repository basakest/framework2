<?php

class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findByEmail($email)
    {
        $this->db->prepare("select * from users where email = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->fetchOne();
        if ($this->db->count() != 0) {
            return true;
        } else {
            return false;
        }
    }

    public function register($name, $email, $password)
    {
        $this->db->prepare("insert into users (name, email, password) values (:name, :email, :password)");
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        return $this->db->execute();
    }

    public function login($email, $password)
    {
        $this->db->prepare("select * from users where email = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->fetchOne();
        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password)) {
            return $row;
        } else {
            return null;
        }
    }

    public function getById($id)
    {
        $this->db->prepare("select * from users where id = :id");
        $this->db->bind(':id', $id);
        $result = $this->db->fetchOne();
        return $result;
    }
}