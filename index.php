<?php

require_once("controller/ArticlesController.php");
require_once("controller/ArticlesRESTController.php");
require_once("controller/UsersController.php");
require_once("controller/ClientRegistration.php");
require_once("controller/Login.php");
require_once("controller/Logout.php");

define("BASE_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

$urls = [
    "/^users$/" => function ($method) {
        UsersController::index();
    },
        "/^users\/(\d+)$/" => function ($method, $id) {
        UsersController::get($id);
    },
    "/^users\/add$/" => function ($method) {
        if ($method == "POST") {
            UsersController::add();
        } else {
            UsersController::addForm();
        }
    },
    "/^users\/edit\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            UsersController::edit($id);
        } else {
            UsersController::editForm($id);
        }
    },
    "/^users\/delete\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            UsersController::delete($id);
        }
    },
    "/^articles$/" => function ($method) {
        ArticlesController::index();
    },
    "/^articles\/(\d+)$/" => function ($method, $id) {
        ArticlesController::get($id);
    },
    "/^articles\/add$/" => function ($method) {
        if ($method == "POST") {
            ArticlesController::add();
        } else {
            ArticlesController::addForm();
        }
    },
    "/^articles\/edit\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            ArticlesController::edit($id);
        } else {
            ArticlesController::editForm($id);
        }
    },
    "/^articles\/delete\/(\d+)$/" => function ($method, $id) {
        if ($method == "POST") {
            ArticlesController::delete($id);
        }
    },
    "/^articles\/(\d+)\/(foo|bar|baz)\/(\d+)$/" => function ($method, $id, $val, $num) {
        // primer kako definirati funkcijo, ki vzame dodatne parametre
        // http://localhost/netbeans/mvc-rest/articles/1/foo/10
        echo "$id, $val, $num";
    },
    "/^$/" => function () {
        ViewHelper::redirect(BASE_URL . "articles");
    },
    # REST API
    "/^api\/articles\/(\d+)$/" => function ($method, $id) {
        // TODO: izbris knjige z uporabo HTTP metode DELETE
        switch ($method) {
            case "DELETE":
                ArticlesRESTController::delete($id);
                break;
            case "PUT":
                ArticlesRESTController::edit($id);
                break;
            default: # GET
                ArticlesRESTController::get($id);
                break;
        }
    },
    "/^api\/articles$/" => function ($method) {
        switch ($method) {
            case "POST":
                ArticlesRESTController::add();
                break;
            default: # GET
                ArticlesRESTController::index();
                break;
        }
    },
];

foreach ($urls as $pattern => $controller) {
    if (preg_match($pattern, $path, $params)) {
        try {
            $params[0] = $_SERVER["REQUEST_METHOD"];
            $controller(...$params);
        } catch (InvalidArgumentException $e) {
            ViewHelper::error404();
        } catch (Exception $e) {
            ViewHelper::displayError($e, true);
        }

        exit();
    }
}

ViewHelper::displayError(new InvalidArgumentException("No controller matched."), true);
