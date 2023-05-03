<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Model class for apps table in database

class AdminModel{
    public $adminname;
    public $adminpassword;
    public $post_id;
    public $user_id;
}