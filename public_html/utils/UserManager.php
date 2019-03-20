<?php
//Author: Beesham Sarendranauth
include_once("../utils/DatabaseUtils.php");
include_once("../utils/HTTPUtils.php");

class UserManager {

    private static function getDb() {
        $db = new DatabaseUtils();
        $db->connectTodb();
        return $db;
    }

    static function login_user($username, $password) {
        $db = UserManager::getdb();
        $status = $db->checkLogin($username, $password); 
        return $status;
    }

    static function logout_user() {
        session_start();
        unset($_SESSION["logged_in"]);
        HTTPUtils::redirectPage("/html/homepage.html");
    }

    static function getUser($username) {
       //TODO
        $db = UserManager::getdb();
        $user = $db->queryUser($username);
        error_log($user->firstname);
    }
}
?>
