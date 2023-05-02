<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Use "require_once" to load the files needed for the class

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/UserModel.php";

class UsersDatabase extends Database
{
    private $table_name = "users";

    // Get one User by using the inherited function getOneRowByIdFromTable
    public function getOne($user_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, 'user_id', $user_id);

        $user = $result->fetch_object("UserModel");

        return $user;
    }


    // Get all Users by using the inherited function getAllRowsFromTable
    public function getAll()
    {
        $result = $this->getAllRowsFromTable($this->table_name);

        $users = [];

        while($user = $result->fetch_object("UserModel")){
            $users[] = $user;
        }

        return $users;
    }

    // Create one by creating a query and using the inherited $this->conn 
    public function insert(UserModel $user){
        $query = "INSERT INTO users (first_name, last_name) VALUES (?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ss", $user->first_name, $user->last_name);

        $success = $stmt->execute();

        return $success;
    }

        // modify the user with the matching user id
    public function modifyUser($user_id, $user)
    {
        $query = "UPDATE users  SET first_name= ?, last_name=? WHERE user_id = ?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssi", $user->first_name, $user->last_name, $user_id);

        $success = $stmt->execute();

        return $success;
 
    }

    public function deleteByID($user_id)
    {
        $query = "DELETE FROM users WHERE user_id = ?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $user_id);

        $success = $stmt->execute();

        return $success;
 
    }
}
