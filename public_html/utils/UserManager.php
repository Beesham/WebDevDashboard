<?php
//Author: Beesham Sarendranauth
include_once("../utils/DatabaseUtils.php");
include_once("../utils/HTTPUtils.php");

class UserManager {
   static function login_user($username, $password) {
        $status = DatabaseUtils::login($username, $password); 
        return $status;
   }

   static function logout_user() {
        session_start();
        unset($_SESSION["logge_in"]);
        HTTPUtils::redirectPage("/html/homepage.html");
   }
}
?>
