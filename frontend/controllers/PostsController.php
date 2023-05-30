<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";
require_once __DIR__ . "/../../business-logic/PostsService.php";


function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

class PostController extends ControllerBase
{

    public function handleRequest()
    {

        // Check for POST method before checking any of the GET-routes
        if ($this->method == "POST") {
            $this->handlePost();
        }


        // GET: /home/posts
        if ($this->path_count == 2) {
            $this->showAll();
        }


        // GET: /home/posts/new
        else if ($this->path_count == 3 && $this->path_parts[2] == "new") {
            $this->showNewPostForm();
        }


        // GET: /home/posts/{id}
        else if ($this->path_count == 3) {
            $this->showOne();
        }


        // GET: /home/posts/{id}/edit
        else if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->showEditForm();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }



    // Gets all posts and shows them in the index view
    private function showAll()
    {
        $this->requireAuth();

        if ($this->user->user_role === "admin") {
            $posts = PostsService::getAllPosts();
        } else {
            $posts = PostsService::getPostsByUser($this->user->user_id);
        }

        // $this->model is used for sending data to the view
        $this->model = $posts;

        $this->viewPage("posts/index");
    }



    // Gets one post and shows the in the single view
    private function showOne()
    {
        // Get the post with the ID from the URL
        $post = $this->getPost();

        // $this->model is used for sending data to the view
        $this->model["post"] = $post;



     
        // Shows the view file posts/single.php
        $this->viewPage("posts/single");
    }



    // Gets one and shows it in the edit view
    private function showEditForm()
    {
        $this->requireAuth(["admin"]);

        // Get the post with the ID from the URL
        $post = $this->getPost();

        // $this->model is used for sending data to the view
        $this->model = $post;

        // Shows the view file posts/edit.php
        $this->viewPage("posts/edit");
    }




    private function showNewPostForm()
    {
        $this->requireAuth();

        // Shows the view file posts/new.php
        $this->viewPage("posts/new");
    }



    // Gets one post based on the id in the url
    private function getPost()
    {
        $this->requireAuth();

        // Get the post with the specified ID
        $id = $this->path_parts[2];

        $post = PostsService::getPostById($id);

        if (!$post) {
            $this->notFound();
        }

        if ($this->user->user_role !== "admin" && $post->user_id !== $this->user->user_id) {
            $this->forbidden();
        }

        return $post;
    }


    // handle all post requests for posts in one place
    private function handlePost()
    {
        // POST: /home/posts
        if ($this->path_count == 2) {
            $this->createPost();
        }

        // POST: /home/post/{id}/edit
        else if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->updatePost();
        }

        // POST: /home/post/{id}/delete
        else if ($this->path_count == 4 && $this->path_parts[3] == "delete") {
            $this->deletePost();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }


    // Create a post with data from the URL and body
    private function createPost()
    {
        $this->requireAuth();
debug_to_console("Goes past auth 1");

        $post = new PostModel();

        debug_to_console("Goes past post model 2");


        // Get updated properties from the body
        $post->content = $this->body["content"];

        debug_to_console("Goes past content line 3");

        // Admins can connect any user to the post
        if($this->user->user_role === "admin"){
            $post->user_id = $this->body["user_id"];
        }

        // Regular users can only add posts to themselves
        else{
            $post->user_id = $this->user->user_id;
        }

        // Save the post
        $success = PostsService::savePost($post);
        debug_to_console("Goes past save post 4");

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/posts");
        } else {
            $this->error();
        }
    }


    // Update a post with data from the URL and body
    private function updatePost()
    {
        $this->requireAuth(["admin"]);

        $post = new PostModel();

        // Get ID from the URL
        $id = $this->path_parts[2];

        $existing_post = PostsService::getPostById($id);

        // Get updated properties from the body
        $post->content = $this->body["content"];
        $post->user_id = $this->body["user_id"];

        $success = PostsService::updatePostById($id, $post);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/posts");
        } else {
            $this->error();
        }
    }


    // Delete a post with data from the URL
    private function deletePost()
    {
        $this->requireAuth(["admin"]);

        // Get ID from the URL
        $id = $this->path_parts[2];

        // Delete the post
        $success = PostsService::deletePostById($id);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/posts");
        } else {
            $this->error();
        }
    }
}
