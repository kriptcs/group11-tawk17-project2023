<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";

class FeedController extends ControllerBase
{

        private function showAll()
    {
            $posts = PostsService::getAllPosts();   
        // $this->model is used for sending data to the view
        $this->model = $posts;
        $this->viewPage("feed");

    }

    public function handleRequest()
    {    // GET: /home/posts
            $this->showAll();
       $this->viewPage("feed");
    }
}