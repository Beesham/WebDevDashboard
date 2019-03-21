<?php
//Author(s): Beesham Sarendranauth
include_once 'User.php';
include_once '../../extras/databaseConfig.php';

class DatabaseUtils {

    private $conn;

    function connectToDb() {
        global $username, $servername, $dbname, $password;
        global $conn;
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); //pulls creds from databaseConfig.php
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connected to database successfully: ".$dbname;

            //return $conn;
        }
        catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function checkLogin($username, $password) {
        global $conn;
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
    
    //Queries for user data
    function queryUser($username) {
        global $conn;
        $stmt = $conn->prepare("Select u.username, u.firstname, u.lastname, u.email, i.bio, i.image
                                    FROM users u, user_info i
                                    WHERE u.username=i.username
                                    AND u.username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();       
        $row = $stmt->fetch();
       
        //Need to check of row count is > 0. This does not 
        if(count($row) > 0) {
            $user = new User();
            $user->firstname = $row['firstname'];
            $user->lastname = $row['lastname'];
            $user->bio = $row['bio'];
            $user->image = $row['image'];
            $user->email = $row['email'];
            $user->username = $row['username'];

            return $user;
        }
    }

    //queries for user todo list. Parses the string into an array
    function queryTodo($username) {
        //TODO
    }

    //queries for user contact list. Parses the string into an array
    function queryContactList($username) {
        //TODO
    }
    
    //query for tile visibility: true/false
    function querySettings($username) {
        //TODO
    }

    //insert new user
    function insertNewUser($user, $password) {
        //TODO
        global $conn;
        
        echo $user->firstname;

        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, username, password)
                                VALUES (:firstname, :lastname,:email, :username, :password)");
        $stmt->bindParam(':firstname', $user->firstname);
        $stmt->bindParam(':lastname', $user->lastname);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':username', $user->username);
        $stmt->bindParam(':password', $password);
        if(!$stmt->execute()) {
            error_log("Unable to insert new user", 0);
        } else return true;
    }

}
?>
