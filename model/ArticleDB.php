<?php

require_once 'model/AbstractDB.php';

class ArticleDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO article (author, title, description, price, year) "
                        . " VALUES (:author, :title, :description, :price, :year)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE article SET author = :author, title = :title, "
                        . "description = :description, price = :price, year = :year"
                        . " WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM article WHERE id = :id", $id);
    }

    public static function get(array $id) {
        $articles = parent::query("SELECT id, author, title, description, price, year"
                        . " FROM article"
                        . " WHERE id = :id", $id);

        if (count($articles) == 1) {
            return $articles[0];
        } else {
            throw new InvalidArgumentException("No such article");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id, author, title, price, year, description"
                        . " FROM article"
                        . " ORDER BY id ASC");
    }

    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT id, author, title, price, year, "
                        . "          CONCAT(:prefix, id) as uri "
                        . "FROM article "
                        . "ORDER BY id ASC", $prefix);
    }

}
