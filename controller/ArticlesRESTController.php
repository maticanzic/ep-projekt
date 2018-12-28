<?php

require_once("model/ArticleDB.php");
require_once("controller/ArticlesController.php");
require_once("ViewHelper.php");

class ArticlesRESTController {

    public static function get($id) {
        try {
            echo ViewHelper::renderJSON(ArticleDB::get(["id" => $id]));
        } catch (InvalidArgumentException $e) {
            echo ViewHelper::renderJSON($e->getMessage(), 404);
        }
    }

    public static function index() {
        $prefix = $_SERVER["REQUEST_SCHEME"] . "://" . $_SERVER["HTTP_HOST"]
                . $_SERVER["REQUEST_URI"];
        echo ViewHelper::renderJSON(ArticleDB::getAllwithURI(["prefix" => $prefix]));
    }

    public static function add() {
        $data = filter_input_array(INPUT_POST, ArticlesController::getRules());

        if (ArticlesController::checkValues($data)) {
            $id = ArticleDB::insert($data);
            echo ViewHelper::renderJSON("", 201);
            ViewHelper::redirect(BASE_URL . "api/articles/$id");
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
    }

    public static function edit($id) {
        // spremenljivka $_PUT ne obstaja, zato jo moremo narediti sami
        $_PUT = [];
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = filter_var_array($_PUT, ArticlesController::getRules());

        if (ArticlesController::checkValues($data)) {
            $data["id"] = $id;
            ArticleDB::update($data);
            echo ViewHelper::renderJSON("", 200);
        } else {
            echo ViewHelper::renderJSON("Missing data.", 400);
        }
    }

    public static function delete($id) {
        try {
            ArticleDB::get(["id" => $id]);
            ArticleDB::delete(["id" => $id]);
            echo ViewHelper::renderJSON("", 200);
        } catch (Exception $ex) {
            // Vrni kodo 404 v primeru neobstoječe knjige
            echo ViewHelper::renderJSON("No such article", 404);
            }
        }
}
