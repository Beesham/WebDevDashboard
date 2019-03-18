<?php
//Aothoer(s): Beesham Sarendranauth

    session_start();
    include("../../extras/adminConfig.php");
    include("../utils/DatabaseUtils.php");
    include("../utils/HTTPUtils.php");
    
    
    if (array_key_exists('username', $_POST)
        && array_key_exists('password', $_POST)
        && count($_POST) == 2) {

        $status = DatabaseUtils::login($_POST['username'], $_POST['password']);  
        if($status) {
            $_SESSION["logged_in"] = true;
            HTTPUtils::redirectPage("/html/mainpage.html");
        } else {
            $_SESSION["logged_in"] = false;
        }
    } else {
        //TODO
        //invalid login info
    }
?>


