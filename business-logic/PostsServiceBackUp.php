<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/PostsDatabase.php";

class PostsService{

    // Get one post by creating a database object 
    // from data-access layer and calling its getOne function.
    public static function getPostById($id){
        $posts_database = new PostsDatabase();

        $post = $posts_database->getOne($id);

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $post;
    }

    // Get all posts by creating a database object 
    // from data-access layer and calling its getAll function.
    public static function getAllPosts(){
        $posts_database = new PostsDatabase();

        $posts = $posts_database->getAll();

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $posts;
    }

    // Save an post to the database by creating a database object 
    // from data-access layer and calling its insert function.
    public static function savePost(PostModel $posts){
        $posts_database = new PostsDatabase();

        // If you need to validate data or control what 
        // gets saved to the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $posts_database->insert($posts);

        return $success;
    }

    public static function modifyPost($id, $post)
        {$posts_database = new PostsDatabase();
            
        $success = $posts_database->modifyPost($id, $post);

        return $success;
        }

        public static function deleteByID($id)
        {$posts_database = new PostsDatabase();
            
        $success = $posts_database->deleteByID($id);

        return $success;
        }
}