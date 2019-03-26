<?php

include_once("../utils/ToDoListManager.php");

session_start();

if(array_key_exists('username', $_SESSION)) {
    $username = $_SESSION['username'];
}else{
    $username = 'NullUser';
}

print_r($username);

$item = $_POST['item'];

$status = ToDoListManager::addListItem(
    htmlspecialchars($username, ENT_QUOTES),
    htmlspecialchars($item, ENT_QUOTES)
);


print_r($status);


?>