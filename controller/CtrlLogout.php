<?php
    header('X-Frame-Options: SAMEORIGIN');
    header('X-Content-Type-Options: nosniff');
    require_once("ViewHelper.php");

    class CtrlLogout {

        public static function logout() {
            ViewHelper::render("view/Logout.php");
        }
}
