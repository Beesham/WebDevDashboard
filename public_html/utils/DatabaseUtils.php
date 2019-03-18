<?php
//Author(s): Beesham Sarendranauth

include '../../extras/databaseConfig.php';

class DatabaseUtils {

    static function connectToDb() {
        global $username, $servername, $dbname, $password;
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); //pulls creds from databaseConfig.php
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to database successfully: ".$dbname;
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function login($username, $password) {
        //TODO
        self::connectTodb();
        error_log("username: ".$username, 4);
    }

    static function logout() {
        //TODO
    }

}
?>
