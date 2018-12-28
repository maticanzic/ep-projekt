<?php

require_once 'model/AbstractDB.php';

class ArticleDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO article (title, description, price, activated) "
                        . " VALUES (:title, :description, :price, :activated)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE article SET title = :title, "
                        . "description = :description, price = :price, activated = :activated"
                        . " WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM article WHERE id = :id", $id);
    }

    public static function get(array $id) {
        $articles = parent::query("SELECT id, title, description, price, activated"
                        . " FROM article"
                        . " WHERE id = :id", $id);
        
        if (count($articles) == 1) {
            return $articles[0];
        } else {
            throw new InvalidArgumentException("No such article");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id, title, price, activated, description"
                        . " FROM article"
                        . " ORDER BY id ASC");
    }

    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT id, title, price, activated, "
                        . "          CONCAT(:prefix, id) as uri "
                        . "FROM article "
                        . "ORDER BY id ASC", $prefix);
    }

}
