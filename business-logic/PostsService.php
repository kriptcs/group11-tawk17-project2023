<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/PostsDatabase.php";

class PostsService{

    public static function getPostById($id){
        $posts_database = new PostsDatabase();

        $post = $posts_database->getOne($id);

        return $post;
    }
    

    public static function getAllPosts(){
        $posts_database = new PostsDatabase();

        $posts = $posts_database->getAll();

        return $posts;
    }
    

    public static function getPostsByUser($user_id){
        $posts_database = new PostsDatabase();

        $posts = $posts_database->getByUserId($user_id);

        return $posts;
    }

    
    public static function savePost(PostModel $post){
        $posts_database = new PostsDatabase();

        $success = $posts_database->insert($post);

        return $success;
    }

    
    public static function updatePostById($post_id, PostModel $post){
        $post_database = new PostsDatabase();

        $success = $post_database->updateById($post_id, $post);

        return $success;
    }

    
    public static function deletePostById($post_id){
        $post_database = new PostsDatabase();

        $success = $post_database->deleteById($post_id);

        return $success;
    }
}

