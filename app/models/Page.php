<?php

class Page
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPosts()
    {
        $this->db->prepare('select * from category');
        return $this->db->fetchAll();
    }
}