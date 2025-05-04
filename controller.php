<?php
ini_set("display_errors", "On");
include_once "controllers/ProductAction.php";
include_once "controllers/ProductController.php";
include_once "model/ProductDAO.php";

class FrontControllers {
    private $controllers;

    public function __construct() {
        $this->showErrors(0);
        $this->controllers = $this->loadControllers();
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $page = $_REQUEST['page'];
        
        $key = $method . $page;
        if(!array_key_exists($key, $this->controllers)){
            header("Location: controller.php?page=LIST");
            return;
        }

        $controller = $this->controllers[$key];

        $methodType = strtoupper(substr($method,0,4));
        if ($methodType == 'GET') {
            $controller->processGET();
        }

        if ($methodType == 'POST') {
            $controller->processPOST();
        }
    }

    public function loadControllers() {
        $controllers["GETLIST"] = new ProductList();
        $controllers["GETADD"] = new ProductAdd();
        $controllers["POSTADD"] = new ProductAdd();
        $controllers["GETUPDATE"] = new ProductUpdate();
        $controllers["POSTUPDATE"] = new ProductUpdate();
        $controllers["GETDELETE"] = new ProductDelete();
        $controllers["POSTDELETE"] = new ProductDelete();

        return $controllers;
    }

    private function showErrors($debug) {
        if ($debug == 1) {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        }
    }
}

$controller = new FrontControllers();
$controller->run();

?>