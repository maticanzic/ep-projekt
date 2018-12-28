<?php

require_once("model/ArticleDB.php");
require_once("ViewHelper.php");

class ArticlesController {

    public static function get($id) {
        echo ViewHelper::render("view/article-detail.php", ArticleDB::get(["id" => $id]));
    }

    public static function index() {
        echo ViewHelper::render("view/article-list.php", [
            "articles" => ArticleDB::getAll()
        ]);
    }

    public static function addForm($values = [
        "title" => "",
        "price" => "",
        "activated" => "",
        "description" => ""
    ]) {
        echo ViewHelper::render("view/article-add.php", $values);
    }

    public static function add() {
        $data = filter_input_array(INPUT_POST, self::getRules());

        if (self::checkValues($data)) {
            $id = ArticleDB::insert($data);
            echo ViewHelper::redirect(BASE_URL . "articles/" . $id);
        } else {
            self::addForm($data);
        }
    }

    public static function editForm($params) {
        if (is_array($params)) {
            $values = $params;
        } else if (is_numeric($params)) {
            $values = ArticleDB::get(["id" => $params]);
        } else {
            throw new InvalidArgumentException("Cannot show form.");
        }

        echo ViewHelper::render("view/article-edit.php", $values);
    }

    public static function edit($id) {
        $data = filter_input_array(INPUT_POST, self::getRules());
        
        if (!isset($data["activated"]) || $data["activated"] === "") {
            $data["activated"] = 0;
        }

        if (self::checkValues($data)) {
            $data["id"] = $id;
            ArticleDB::update($data);
            ViewHelper::redirect(BASE_URL . "articles/" . $data["id"]);
        } else {
            self::editForm($data);
        }
    }

    public static function delete($id) {
        $data = filter_input_array(INPUT_POST, [
            'delete_confirmation' => FILTER_REQUIRE_SCALAR
        ]);

        if (self::checkValues($data)) {
            ArticleDB::delete(["id" => $id]);
            $url = BASE_URL . "articles";
        } else {
            $url = BASE_URL . "articles/edit/" . $id;
        }

        ViewHelper::redirect($url);
    }

    /**
     * Returns TRUE if given $input array contains no FALSE values
     * @param type $input
     * @return type
     */
    public static function checkValues($input) {
        if (empty($input)) {
            return FALSE;
        }

        $result = TRUE;
        foreach ($input as $value) {
            $result = $result && $value !== false;
        }

        return $result;
    }

    /**
     * Returns an array of filtering rules for manipulation articles
     * @return type
     */
    public static function getRules() {
        return [
            'title' => FILTER_SANITIZE_SPECIAL_CHARS,
            'description' => FILTER_SANITIZE_SPECIAL_CHARS,
            'price' => FILTER_VALIDATE_FLOAT,
            'activated' => FILTER_VALIDATE_BOOLEAN
        ];
    }
}
