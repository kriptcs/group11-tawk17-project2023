<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/RestAPI.php";
require_once __DIR__ . "/../business-logic/PostsService.php";


class PostsAPI extends RestAPI
{

    // Handles the request by calling the appropriate member function
    public function handleRequest()
    {

        // GET: /api/posts
        if ($this->method == "GET" && $this->path_count == 2) {
            $this->getAll();
        }

        // GET: /api/posts/{id}
        else if ($this->path_count == 3 && $this->method == "GET") {
            $this->getById($this->path_parts[2]);
        }

        // POST: /api/posts
        else if ($this->path_count == 2 && $this->method == "POST") {
            $this->postOne();
        }

        // PUT: /api/posts/{id}
        else if ($this->path_count == 3 && $this->method == "PUT") {
            $this->putOne($this->path_parts[2]);
        }

        // DELETE: /api/posts/{id}
        else if ($this->path_count == 3 && $this->method == "DELETE") {
            $this->deleteOne($this->path_parts[2]);
        }

        // If none of our ifs are true, we should respond with "not found"
        else {
            $this->notFound();
        }
    }


    private function getAll()
    {$posts = PostsService::getAllPosts();
       /* $this->requireAuth();

        if ($this->user->user_role === "admin") {
            
        } else {
            $posts = PostsService::getPostsByUser($this->user->user_id);
        } */

        $this->sendJson($posts);
    }


    private function getById($id)
    {
        $this->requireAuth();

        $post = PostsService::getPostById($id);

        if (!$post) {
            $this->notFound();
        }

        if ($this->user->user_role !== "admin" || $post->user_id !== $this->user->user_id) {
            $this->forbidden();
        }

        $this->sendJson($post);
    }


    private function postOne()
    {
        $this->requireAuth();

        $post = new PostModel();

        $post->content = $this->body["content"];

        // Admins can connect any user to the post
        if ($this->user->user_role === "admin") {
            $post->user_id = $this->body["user_id"];
        }

        // Regular users can only add posts to themself
        else {
            $post->user_id = $this->user->user_id;
        }

        $success = PostsService::savePost($post);

        if ($success) {
            $this->created();
        } else {
            $this->error();
        }
    }


    private function putOne($id)
    {
        $this->requireAuth(["admin"]);

        $post = new PostModel();

        $post->content = $this->body["content"];
        $post->user_id = $this->body["user_id"];

        $success = PostsService::updatePostById($id, $post);

        if ($success) {
            $this->ok();
        } else {
            $this->error();
        }
    }

    // Deletes the post with the specified ID in the DB
    private function deleteOne($id)
    {
        // only admins can delete posts
        $this->requireAuth(["admin"]);

        $post = PostsService::getPostById($id);

        if ($post == null) {
            $this->notFound();
        }

        $success = PostsService::deletePostById($id);

        if ($success) {
            $this->noContent();
        } else {
            $this->error();
        }
    }
}
