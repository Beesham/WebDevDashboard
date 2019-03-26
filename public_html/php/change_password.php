<?php
//Author(s): Beesham Sarendranauth
include_once('../utils/UserManager.php');
include_once('../utils/HTTPUtils.php');

changePassword();
function changePassword() {

    if(array_key_exists('username', $_POST) &&
        array_key_exists('password', $_POST) &&
        count($_POST) == 2) {
        UserManager::changeUserPassword(htmlspecialchars($_POST['username'], ENT_QUOTES),
                                        htmlspecialchars($_POST['password'], ENT_QUOTES));    
        HTTPUtils::redirectPage("/php/settings.php");
    }
}
?>
