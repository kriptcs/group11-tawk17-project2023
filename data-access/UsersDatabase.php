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
private $id_name="user_id";

     public function getByUsername($username)
    {
        $user = $this->getByUsernameWithPassword($username);

        // Never send the password hash unless needed for authentication
        unset($user->password_hash);

        // Return the UserModel object or null if no user was found
        return $user;
    }

        public function getByUsernameWithPassword($username)
    {
        // Define SQL query to retrieve user data by username
        $query = "SELECT * FROM users WHERE username = ?";

        // Prepare the query statement
        $stmt = $this->conn->prepare($query);

        // Bind the username parameter to the prepared statement
        $stmt->bind_param("s", $username);

        // Execute the query
        $stmt->execute();

        // Get the result of the query as a mysqli_result object
        $result = $stmt->get_result();

        // Fetch the user data as a UserModel object
        $user = $result->fetch_object("UserModel");

        // Return the UserModel object or null if no user was found
        return $user;
    }

        public function getByIdWithPassword($user_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $user_id);

        $user = $result->fetch_object("UserModel");

        return $user;
    }

        // Update one by creating a query and using the inherited $this->conn 
    public function updatePasswordById($user_id, $password_hash)
    {
        $query = "UPDATE users SET password_hash=? WHERE user_id=?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("si", $password_hash, $user_id);

        $success = $stmt->execute();

        return $success;
    }



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
        $query = "INSERT INTO users (username, passwordd) VALUES (?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ss", $user->username, $user->password_hash);

        $success = $stmt->execute();

        return $success;
    }

        // modify the user with the matching user id
    public function modifyUser($user_id, $user)
    {
        $query = "UPDATE users  SET username= ?, passwordd=? WHERE user_id = ?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssi", $user->username, $user->passwordd, $user_id);

        $success = $stmt->execute();

        return $success;
 
    }

    // Update one by creating a query and using the inherited $this->conn 
    public function updateById($user_id, UserModel $user)
    {
        $query = "UPDATE users SET username=?, user_role=? WHERE user_id=?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssi", $user->username, $user->user_role, $user_id);

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
