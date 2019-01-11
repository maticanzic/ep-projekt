<?php

require_once("ViewHelper.php");

class CtrlLogout {

    public static function logout() {
        ViewHelper::render("view/Logout.php");
    }
}
