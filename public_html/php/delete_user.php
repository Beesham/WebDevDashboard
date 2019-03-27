<?php
//Author(s): Beesham Sarendranauth
include_once('../utils/UserManager.php');
include_once('../utils/HTTPUtils.php');

deleteUser();
function deleteUser() {
    session_start();
    if(array_key_exists('username', $_POST) &&
        count($_POST) == 1) {
        if (UserManager::deleteUser(htmlspecialchars($_POST['username'], ENT_QUOTES))) {
            $_SESSION['delete_user_success'] = 'true';            
        } else {
            $_SESSION['delete_user_success'] = 'false';            
        }
        HTTPUtils::redirectPage("/php/settings.php");
    }
}
?>
