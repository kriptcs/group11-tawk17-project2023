<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}


require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/PostModel.php";

class PostsDatabase extends Database
{
    private $table_name = "posts";
    private $id_name = "post_id";


    public function getOne($post_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $post_id);

        $post = $result->fetch_object("PostModel");

        return $post;
    }



    public function getAll()
    {
        $result = $this->getAllRowsFromTable($this->table_name);

        $posts = [];

        while ($post = $result->fetch_object("PostModel")) {
            $posts[] = $post;
        }

        return $posts;
    }


    public function getByUserId($user_id)
    {
        $query = "SELECT * FROM posts WHERE user_id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $user_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $posts = [];

        while ($post = $result->fetch_object("PostModel")) {
            $posts[] = $post;
        }

        return $posts;
    }



    public function insert(PostModel $post)
    {
        $query = "INSERT INTO posts (content, user_id) VALUES (?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("si", $post->content, $post->user_id);

        $success = $stmt->execute();

        return $success;
    }


     
    public function updateById($post_id, PostModel $post)
    {
        $query = "UPDATE posts SET content=?, user_id=? WHERE post_id=?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sii", $post->content, $post->user_id, $post_id);

        $success = $stmt->execute();

        return $success;
    }

    
    public function deleteById($post_id)
    {
        $success = $this->deleteOneRowByIdFromTable($this->table_name, $this->id_name, $post_id);

        return $success;
    }
}
