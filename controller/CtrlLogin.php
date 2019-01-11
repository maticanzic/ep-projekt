<?php
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    require_once("ViewHelper.php");
    require_once 'model/ArticleDB.php';

        class CtrlLogin {

            public static function index() {
                echo ViewHelper::render("view/Login.php");
            }

            public static function logged_in() {
                if($_SESSION["type"] == 0) {
                    header("location:". BASE_URL . "users");
                } else {
                    header("location:". BASE_URL . "articles");
                }
            }
        }
?>