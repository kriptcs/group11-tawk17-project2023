<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";
require_once __DIR__ . "/../../business-logic/MemeService.php";


class MemeController extends ControllerBase
{
    public function handleRequest()
    {        
        
        $text0 = isset($this->query_params["text0"]) ? $this->query_params["text0"] : null;
        $text1 = isset($this->query_params["text1"]) ? $this->query_params["text1"] : null;
        $this->model = "";

        if($text0 && $text1){
            // Get uper text and bottom text
            $this->model = MemeService::getMeme($text0, $text1);
        }

        $this->viewPage("meme/home");
    }
}