<?php

require_once("ViewHelper.php");

    class CtrlLogin {

        public static function index() {
            echo ViewHelper::render("view/Login.php");
        }
        
        public static function logged_in() {
            echo ViewHelper::render("view/article-list.php");
        }
    }

