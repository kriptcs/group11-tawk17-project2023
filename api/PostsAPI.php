<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/RestAPI.php";
require_once __DIR__ . "/../business-logic/PostsService.php";

// Class for handling requests to "api/app"

class PostsAPI extends RestAPI
{

    // Handles the request by calling the appropriate member function
    public function handleRequest()
    {

        
        // If theres two parts in the path and the request method is GET 
        // it means that the client is requesting "api/apps" and
        // we should respond by returning a list of all apps 
        if ($this->method == "GET" && $this->path_count == 2) {
            $this->getAll();
        } 

        // If there's three parts in the path and the request method is GET
        // it means that the client is requesting "api/apps/{something}".
        // In our API the last part ({something}) should contain the ID of an 
        // app and we should respond with the app of that ID
        else if ($this->path_count == 3 && $this->method == "GET") {
            $this->getById($this->path_parts[2]);
        }

        // If theres two parts in the path and the request method is POST 
        // it means that the client is requesting "api/apps" and we
        // should get ths contents of the body and create a app.
        else if ($this->path_count == 2 && $this->method == "POST") {
            $this->postOne();
        } 

        //Modify by ID
         else if ($this->path_count == 3 && $this->method == "PUT") {
            $this->modifyByID($this->path_parts[2]);
        } 

        else if ($this->path_count == 3 && $this->method == "DELETE") {
            $this->deleteByID($this->path_parts[2]);
        } 

        
        // If none of our ifs are true, we should respond with "not found"
        else {
            $this->notFound();
        }
    }

    // Gets all apps and sends them to the client as JSON
    private function getAll()
    {
        $posts = PostsService::getAllPosts();

        $this->sendJson($posts);
    }

    // Gets one and sends it to the client as JSON
    private function getById($id)
    {
        $post = PostsService::getPostById($id);

        if ($post) {
            $this->sendJson($post);
        } else {
            $this->notFound();
        }
    }

    // Gets the contents of the body and saves it as an app by 
    // inserting it in the database.
    private function postOne()
    {
        $post = new PostModel();

        $post->user_id = $this->body["user_id"];
        $post->content = $this->body["content"];
        $success = PostsService::savePost($post);

        if($success){
            $this->created();
        }
        else{
            $this->error();
        }
    }

    private function modifyByID($id) {

        $post = new PostModel();

        $post->user_id = $this->body["user_id"];
        $post->content = $this->body["content"];

        $success = PostsService::modifyPost($id, $post);
          if($success){
            $this->modify();
        }
        else{
            $this->error();
        }
    }

    private function deleteByID($id) {
        
         $post = PostsService::deleteByID($id);

        if ($post) {
            $this->delete();
        } else {
            $this->notFound();
        }
    }
}
