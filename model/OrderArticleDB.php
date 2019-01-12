<?php

//require_once 'model/AbstractDB.php';

class OrderArticleDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO order_article (id_order, id_article, amount) "
                        . " VALUES (:id_order, :id_article, :amount)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE order_article SET id_order = :id_order, "
                        . "id_article = :id_article, amount = :amount"
                        . " WHERE id_order = :id_order AND id_article = :id_article", $params);
    }

    public static function delete(array $id_order) {
        return parent::modify("DELETE FROM order_article WHERE id_order = :id_order", $id_order);
    }

    public static function get(array $id_order) {
        $order_articles = parent::query("SELECT id_order, id_article, amount"
                        . " FROM order_article"
                        . " WHERE id_order = :id_order", $id_order);
        
        if (count($order_articles) == 1) {
            return $order_articles[0];
        } else {
            throw new InvalidArgumentException("No such order_article");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id_order, id_article, amount"
                        . " FROM order_article"
                        . " ORDER BY id_order ASC");
    }

    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT id_order, id_article, amount"
                        . "          CONCAT(:prefix, id_order) as uri "
                        . "FROM order_article "
                        . "ORDER BY id_order ASC", $prefix);
    }
}

