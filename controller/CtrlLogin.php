<?php

require_once("ViewHelper.php");
require_once 'model/ArticleDB.php';

    class CtrlLogin {

        public static function index() {
            echo ViewHelper::render("view/Login.php");
        }
        
        public static function logged_in() {
            header("location:". BASE_URL . "articles");
        }
    }

