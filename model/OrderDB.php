<?php

//require_once 'model/AbstractDB.php';

class OrderDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO bill (id_user, id_seller, status) "
                        . " VALUES (:id_user, :id_seller, :status)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE bill SET id_user = :id_user, "
                        . "id_seller = :id_seller, status = :status"
                        . " WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM bill WHERE id = :id", $id);
    }

    public static function get(array $id) {
        $orders = parent::query("SELECT id, id_user, id_seller, status"
                        . " FROM bill"
                        . " WHERE id = :id", $id);
        
        if (count($orders) == 1) {
            return $orders[0];
        } else {
            throw new InvalidArgumentException("No such order");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id, id_user, id_seller, status"
                        . " FROM bill"
                        . " ORDER BY id ASC");
    }

    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT id, id_user, id_seller, status"
                        . "          CONCAT(:prefix, id) as uri "
                        . "FROM bill "
                        . "ORDER BY id ASC", $prefix);
    }
}

