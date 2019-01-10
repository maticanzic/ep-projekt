<?php

    require_once("ViewHelper.php");

    class CtrlRegistration {

        public static function index() {
            echo ViewHelper::render("view/ClientRegistration.php");
        }
        
        public static function login() {
            echo ViewHelper::render("view/Login.php");
        }
    }
?>
