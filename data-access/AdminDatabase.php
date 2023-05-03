<?php
//UNFINISHED





// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Use "require_once" to load the files needed for the class

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/AdminModel.php";

class AdminDatabase extends Database
{
    private $table_name = "admin";

    // Get one post by using the inherited function getOneRowByIdFromTable
    public function getOne($post_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, 'post_id', $post_id);

        $post = $result->fetch_object("PostModel");

        return $post;
    }


    // Get all posts by using the inherited function getAllRowsFromTable
    public function getAll()
    {
        $result = $this->getAllRowsFromTable($this->table_name);

        $posts = [];

        while($post = $result->fetch_object("PostModel")){
            $posts[] = $post;
        }

        return $posts;
    }

    // Create one by creating a query and using the inherited $this->conn 
    public function insert(PostModel $post){
        $query = "INSERT INTO adminaccess (user_id, content) VALUES (?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("is", $post->user_id, $post->content);

        $success = $stmt->execute();

        return $success;
    }

    // modify the post with the matching post id
    public function modifyPost($post_id, $post)
    {
        $query = "UPDATE adminaccess  SET user_id=?, content=? WHERE post_id = ?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("isi", $post_id, $post->content, $post->user_id);

        $success = $stmt->execute();

        return $success;
 
    }

    public function deleteByID($post_id)
    {
        $query = "DELETE FROM posts WHERE post_id = ?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $post_id);

        $success = $stmt->execute();

        return $success;
 
    }
}
