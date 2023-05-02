<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Use "require_once" to load the files needed for the class

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/AppModel.php";

class AppsDatabase extends Database
{
    private $table_name = "apps";

    // Get one app by using the inherited function getOneRowByIdFromTable
    public function getOne($app_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, 'app_id', $app_id);

        $app = $result->fetch_object("AppModel");

        return $app;
    }


    // Get all apps by using the inherited function getAllRowsFromTable
    public function getAll()
    {
        $result = $this->getAllRowsFromTable($this->table_name);

        $apps = [];

        while($app = $result->fetch_object("AppModel")){
            $apps[] = $app;
        }

        return $apps;
    }

    // Create one by creating a query and using the inherited $this->conn 
    public function insert(AppModel $app){
        $query = "INSERT INTO apps (app_name, description, price) VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssi", $app->app_name, $app->description, $app->price);

        $success = $stmt->execute();

        return $success;
    }

    // modify the application with the matching app id
    public function modifyApp($app_id, $app)
    {
        $query = "UPDATE apps  SET app_name= ?, description=?, price=? WHERE app_id = ?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssii", $app->app_name, $app->description, $app->price, $app_id);

        $success = $stmt->execute();

        return $success;
 
    }

    public function deleteByID($app_id)
    {
        $query = "DELETE FROM apps WHERE app_id = ?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $app_id);

        $success = $stmt->execute();

        return $success;
 
    }
}

/* {
   "app_name":"The test",
    "description":"random description",
    "price":"9"
}

{
"first_name": "Johnny",
"last_name": "Doey"
}

*/