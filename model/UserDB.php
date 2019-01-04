<?php

//require_once 'model/AbstractDB.php';

class UserDB extends AbstractDB {

    public static function insert(array $params) {
        return parent::modify("INSERT INTO user (name, lastName, email, password, type, address, phone) "
                        . " VALUES (:name, :lastName, :email, :password, :type, :address, :phone)", $params);
    }

    public static function update(array $params) {
        return parent::modify("UPDATE article SET name = :name, "
                        . "lastName = :lastName, email = :email, password = :password, "
                        . "type = :type, address = :address, phone = :phone"
                        . " WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM user WHERE id = :id", $id);
    }

    public static function get(array $id) {
        $users = parent::query("SELECT id, name, lastName, email, password, type, address, phone"
                        . " FROM user"
                        . " WHERE id = :id", $id);
        
        if (count($users) == 1) {
            return $users[0];
        } else {
            throw new InvalidArgumentException("No such user");
        }
    }

    public static function getAll() {
        return parent::query("SELECT id, name, lastName, email, password, type, address, phone"
                        . " FROM user"
                        . " ORDER BY id ASC");
    }

    public static function getAllwithURI(array $prefix) {
        return parent::query("SELECT id, name, lastName, email, "
                        . "          CONCAT(:prefix, id) as uri "
                        . "FROM user "
                        . "ORDER BY id ASC", $prefix);
    }

}
