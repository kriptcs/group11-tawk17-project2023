<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/AppsDatabase.php";

class AppsService{

    // Get one app by creating a database object 
    // from data-access layer and calling its getOne function.
    public static function getAppById($id){
        $apps_database = new AppsDatabase();

        $app = $apps_database->getOne($id);

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $app;
    }

    // Get all apps by creating a database object 
    // from data-access layer and calling its getAll function.
    public static function getAllApps(){
        $apps_database = new AppsDatabase();

        $apps = $apps_database->getAll();

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $apps;
    }

    // Save an app to the database by creating a database object 
    // from data-access layer and calling its insert function.
    public static function saveApp(AppModel $apps){
        $apps_database = new AppsDatabase();

        // If you need to validate data or control what 
        // gets saved to the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $apps_database->insert($apps);

        return $success;
    }

    public static function modifyApp($id, $app)
        {$apps_database = new AppsDatabase();
            
        $success = $apps_database->modifyApp($id, $app);

        return $success;
        }

        public static function deleteByID($id)
        {$apps_database = new AppsDatabase();
            
        $success = $apps_database->deleteByID($id);

        return $success;
        }
}