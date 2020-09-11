<?php

class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $this->db->prepare("select posts.id as postId, user_id,title,content,posts.created_at as postCreateAt, users.id as userId, name, email, users.created_at as userCreateAt from posts inner join users on users.id = posts.user_id order by postCreateAt desc");
        return $results = $this->db->fetchAll();
    }

    public function add($title, $content, $user_id)
    {
        $this->db->prepare("insert into posts(title, content, user_id) values (:title, :content, :user_id)");
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        $this->db->bind(':user_id', $user_id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getById($id)
    {
        $this->db->prepare("select * from posts where id = :id");
        $this->db->bind(':id', $id);
        $result = $this->db->fetchOne();
        return $result;
    }


    public function update($title, $content, $id)
    {
        $this->db->prepare("update posts set title = :title, content = :content where id = :id");
        $this->db->bind(':title', $title);
        $this->db->bind(':content', $content);
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($id) {
        $this->db->prepare("delete from posts where id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}