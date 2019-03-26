<?php
include_once("../utils/DatabaseUtils.php");


class ToDoListManager{

    private static function getDb() {
        $db = new DatabaseUtils();
        $db->connectTodb();
        return $db;
    }

    static function addListItem($username, $item) {
        $db = ToDoListManager::getdb();
        return $db->insertToDoListItem($username, $item);
    }

}







?>