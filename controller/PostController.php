<?php
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    require_once("model/PostDB.php");
    require_once("ViewHelper.php");

    class PostController {

        public static function get($id) {
            echo PostDB::get(["id" => $id]);
        }
    }
?>