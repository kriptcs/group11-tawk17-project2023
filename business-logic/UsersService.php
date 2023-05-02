<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/UsersDatabase.php";

class UsersService{

    // Get one user by creating a database object 
    // from data-access layer and calling its getOne function.
    public static function getUserById($id){
        $users_database = new UsersDatabase();

        $user = $users_database->getOne($id);

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $user;
    }

    // Get all users by creating a database object 
    // from data-access layer and calling its getAll function.
    public static function getAllUsers(){
        $users_database = new UsersDatabase();

        $users = $users_database->getAll();

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $users;
    }

    // Save a user to the database by creating a database object 
    // from data-access layer and calling its insert function.
    public static function saveUser(UserModel $users){
        $users_database = new UsersDatabase();

        // If you need to validate data or control what 
        // gets saved to the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $users_database->insert($users);

        return $success;
    }

        public static function modifyUser($id, $user)
        {$users_database = new UsersDatabase();
            
        $success = $users_database->modifyUser($id, $user);

        return $success;
        }

        public static function deleteByID($id)
        {$users_database = new UsersDatabase();
            
        $success = $users_database->deleteByID($id);

        return $success;
        }
}