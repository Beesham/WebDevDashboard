<?php
include_once("../utils/UserManager.php");
session_start();
if(array_key_exists('username', $_SESSION)) {
    $username = $_SESSION['username'];
}else{
    $username = 'NullUser';
}

$item = $_POST['item'];
$status = UserManager::addToDoListItem(
    htmlspecialchars($username, ENT_QUOTES),
    htmlspecialchars($item, ENT_QUOTES)
);

?>