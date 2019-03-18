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

            return $conn;
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function login($username, $password) {
        //TODO
        $conn = self::connectTodb();
        $stmt = $conn->prepare("SELECT password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();       
        $row = $stmt->fetch();

        if(count($row) > 0) {
            if(strcmp($password, $row['password']) == 0) {
                error_log("username from db: ".$row['password'] ,0);
                return true;
            } else return false;
        }
    }

    static function logout() {
        //TODO
    }

}
?>
