<?php
//Author(s): Beesham Sarendranauth
include_once('../utils/UserManager.php');
include_once('../utils/HTTPUtils.php');

session_start();

if(array_key_exists('is_admin', $_SESSION) && ($_SESSION['is_admin'] == 'true')) {
    changePassword();
} else {
    changePasswordUser(); 
}

function changePassword() {
    if(array_key_exists('username', $_POST) &&
        array_key_exists('password', $_POST) &&
        count($_POST) == 2) {
        UserManager::changeUserPassword(htmlspecialchars($_POST['username'], ENT_QUOTES),
                                        htmlspecialchars($_POST['password'], ENT_QUOTES));    
        $_SESSION['change_password_success'] = 'true';
        HTTPUtils::redirectPage("/php/settings.php");
    }
}

function changePasswordUser() {
    if(array_key_exists('password', $_POST) &&
        count($_POST) == 1) {
        UserManager::changeUserPassword($_SESSION['username'],
                                        htmlspecialchars($_POST['password'], ENT_QUOTES));    
        $_SESSION['change_password_success'] = 'true';
        HTTPUtils::redirectPage("/php/settings.php");
    }
}
?>
