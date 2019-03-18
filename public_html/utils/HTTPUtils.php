<?php

class HTTPUtils {

    static function redirectPage($page) {
        header('Location: '.$page);
        exit;
    }

}

?>
