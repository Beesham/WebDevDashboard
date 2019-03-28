<?php
//Author(s): Beesham Sarendranauth
include_once 'User.php';
include_once ('User_Settings.php');
include_once '../../extras/databaseConfig.php';
include_once ('../../extras/adminConfig.php');

class DatabaseUtils {

    private $conn;

    function connectToDb() {
        global $dbusername, $servername, $dbname, $password;
        global $conn;
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $password); //pulls creds from databaseConfig.php
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            error_log($e->getMessage(), 0);
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
                return true;
            } else {
                return false;
            }
        }
    }
    
    //Queries for user data
    function queryForUser($username) {
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
    
    //queries the Users table for basic info, not password
    function queryUsers($username) {
        global $conn;
        $stmt = $conn->prepare("Select username, firstname, lastname, email
                                    FROM users
                                    WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();       
        $row = $stmt->fetch();
       
        //Need to check of row count is > 0. This does not 
        if(count($row) > 0) {
            $user = new User();
            $user->firstname = $row['firstname'];
            $user->lastname = $row['lastname'];
            $user->email = $row['email'];
            $user->username = $row['username'];
            return $user;
        }
    }
    
    function queryAllUsers() {
        global $conn;
        $stmt = $conn->prepare("Select username, firstname, lastname, email
                                    FROM users");
        $stmt->execute();       
        
        $userList = array();
              
        //Need to check of row count is > 0. This does not 
        while($row = $stmt->fetch()) {
            $user = new User();
            $user->firstname = $row['firstname'];
            $user->lastname = $row['lastname'];
            $user->email = $row['email'];
            $user->username = $row['username'];
            $userList[] = $user;
        }
        return $userList;
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
        global $conn;
        
        $stmt = $conn->prepare("SELECT calendar, todo, weather, bio, news, game
                                FROM user_settings
                                WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $row = $stmt->fetch();

        if(count($row) > 0) {
            $user_settings = new User_Settings();
            $user_settings->calendar = $row['calendar']; 
            $user_settings->news = $row['news']; 
            $user_settings->todo = $row['todo']; 
            $user_settings->weather = $row['weather']; 
            $user_settings->bio = $row['bio']; 
            $user_settings->game = $row['game']; 
            return $user_settings; 
        }
    }

    //updates user password
    function updatePassword($username, $password) {
        global $conn;
         
        $stmt = $conn->prepare("UPDATE users
                                SET password = :password
                                WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        if(!$stmt->execute()) {
            return false;
        } else return true;
    }

    function updateUserSettings($username, $user_settings) {
        global $conn;
         
        $stmt = $conn->prepare("UPDATE user_settings
                                SET calendar = :calendar,
                                    todo = :todo,
                                    weather = :weather,
                                    bio = :bio,
                                    news = :news,
                                    game = :game
                                WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':calendar', $user_settings->calendar);
        $stmt->bindParam(':todo', $user_settings->todo);
        $stmt->bindParam(':weather', $user_settings->weather);
        $stmt->bindParam(':bio', $user_settings->bio);
        $stmt->bindParam(':news', $user_settings->news);
        $stmt->bindParam(':game', $user_settings->game);
        if(!$stmt->execute()) {
            return false;
        } else return true;
    }

    function deleteUser($username) {
        global $conn;
        
        $stmt = $conn->prepare("DELETE from users 
                                WHERE  username = :username");
        $stmt->bindParam(':username', $username);
        if(!$stmt->execute()) {
            return false;
        } else return true;

    }

    //insert new user
    function insertNewUser($user, $password) {
        global $conn;
        
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, username, password)
                                VALUES (:firstname, :lastname,:email, :username, :password)");
        $stmt->bindParam(':firstname', $user->firstname);
        $stmt->bindParam(':lastname', $user->lastname);
        $stmt->bindParam(':email', $user->email);
        $stmt->bindParam(':username', $user->username);
        $stmt->bindParam(':password', $password);

        $stmt2 = $conn->prepare("INSERT INTO user_settings (username, bio, calendar, contact_list, news, todo, weather, game)
                                VALUES (:username, 1, 1, 1, 1, 1, 1, 1)");

        $stmt2->bindParam(':username', $user->username);

        if(!$stmt->execute() || !$stmt2->execute()) {
            return false;
        } else return true;
    }

    function dropAllTables() {
        global $db_init;
        global $conn;
        
        if($db_init) { 
            $conn->exec("DROP TABLE if exists user_todo");
            $conn->exec("DROP TABLE if exists user_info");
            $conn->exec("DROP TABLE if exists user_contactList");
            $conn->exec("DROP TABLE if exists user_settings");
            $conn->exec("DROP TABLE if exists users");
        }

    }

    function createTables() {
        global $db_init;
        global $conn;

        if($db_init) {
            $conn->exec("CREATE TABLE users (uid int not null AUTO_INCREMENT PRIMARY KEY, 
                            firstname varchar(50) not null, 
                            lastname varchar(50) not null, 
                            username varchar(50) not null unique, 
                            email varchar(50) not null UNIQUE, 
                            password varchar(50) not null);");
            $conn->exec("CREATE TABLE user_settings (username varchar(50) not null PRIMARY KEY, 
                        calendar boolean DEFAULT 1, 
                        todo boolean DEFAULT 1, 
                        weather boolean DEFAULT 1, 
                        bio boolean DEFAULT 1, 
                        news boolean DEFAULT 1, 
                        contact_list boolean DEFAULT 1,
                        game boolean DEFAULT 1, 
                        FOREIGN KEY (username) REFERENCES users(username)
                        ON DELETE CASCADE);");
            $conn->exec("CREATE TABLE user_todo (username varchar(50) not null PRIMARY KEY,
                        items varchar(1024) not null,
                        FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE);");
            $conn->exec("CREATE TABLE user_contactList (username varchar(50) not null PRIMARY KEY,
                        contactList varchar(1024) not null,
                        FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE);");
            $conn->exec("CREATE TABLE user_info (username varchar(50) not null PRIMARY KEY,
                        bio varchar(500) not null, image varchar(100) not null,
                        FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE);");
        }
    }

    function insertAdmin() {
        global $db_init;
        global $conn;

        global $admin_username;
        global $admin_email;
        global $admin_password;

        if($db_init) {
            $stmt = $conn->prepare("
            INSERT INTO `users` (firstname, lastname, username, email, password) VALUES (:firstname , :lastname, :username, :email, :password);
            ");
            $stmt->bindParam(':firstname', $admin_username);
            $stmt->bindParam(':lastname', $admin_username);
            $stmt->bindParam(':username', $admin_username);
            $stmt->bindParam(':email', $admin_email);
            $stmt->bindParam(':password', $admin_password);

            $stmt->execute();
        }
    }

    function insertTestData() {
        global $conn;
        global $db_init_testdata;

        if($db_init_testdata) {
            $conn->exec("
            INSERT INTO users (firstname, lastname, username, email, password) VALUES ('John' , 'Doe', 'user1@gmail.com', 'user1@gmail.com', 'password1');
            INSERT INTO users (firstname, lastname, username, email, password) VALUES ('Jill' , 'Hill', 'user2@gmail.com', 'user2@gmail.com', 'password2');
            INSERT INTO users (firstname, lastname, username, email, password) VALUES ('Bill' , 'Stone', 'user3@gmail.com', 'user3@gmail.com', 'password3');
            INSERT INTO users (firstname, lastname, username, email, password) VALUES ('Juliet' , 'Woodstock', 'user4@gmail.com', 'user4@gmail.com', 'password4');
            INSERT INTO users (firstname, lastname, username, email, password) VALUES ('Kelly' , 'Ryan', 'user5@gmail.com', 'user5@gmail.com', 'password5');
            
            INSERT INTO `user_settings`(`username`, `calendar`, `todo`, `weather`, `bio`, `news`, `contact_list`,`game`) VALUES ('user1@gmail.com', 0, 1, 1, 1, 0, 0, 0);
            INSERT INTO `user_settings`(`username`, `calendar`, `todo`, `weather`, `bio`, `news`, `contact_list`,`game`) VALUES ('user2@gmail.com', 0, 1, 0, 1, 1, 0, 0);
            INSERT INTO `user_settings`(`username`, `calendar`, `todo`, `weather`, `bio`, `news`, `contact_list`,`game`) VALUES ('user3@gmail.com', 0, 0, 1, 0, 0, 0, 0);
            INSERT INTO `user_settings`(`username`, `calendar`, `todo`, `weather`, `bio`, `news`, `contact_list`,`game`) VALUES ('user4@gmail.com', 1, 1, 1, 1, 1, 1, 1);
            INSERT INTO `user_settings`(`username`, `calendar`, `todo`, `weather`, `bio`, `news`, `contact_list`,`game`) VALUES ('user5@gmail.com', 1, 1, 1, 0, 1, 0, 1);
            
            INSERT INTO `user_info`(`username`, `bio`,`image`) VALUES ('user1@gmail.com', 'Likes cats','');
            INSERT INTO `user_info`(`username`, `bio`,`image`) VALUES ('user2@gmail.com', 'Likes dogs','');
            INSERT INTO `user_info`(`username`, `bio`,`image`) VALUES ('user3@gmail.com', 'Likes cows','');
            INSERT INTO `user_info`(`username`, `bio`,`image`) VALUES ('user4@gmail.com', 'Likes birds','');
            INSERT INTO `user_info`(`username`, `bio`,`image`) VALUES ('user5@gmail.com', 'Likes fishes','');
            
            INSERT INTO `user_todo`(`username`, `items`) VALUES ('user1@gmail.com', 'groceries;rob candy store');
            INSERT INTO `user_todo`(`username`, `items`) VALUES ('user2@gmail.com', 'dentist;phone home');
            INSERT INTO `user_todo`(`username`, `items`) VALUES ('user3@gmail.com', 'fix car;guard candy store');
            INSERT INTO `user_todo`(`username`, `items`) VALUES ('user4@gmail.com', 'build tent;live in tent');");
        }
    }

    function initDB() {
        $this->dropAllTables();
        $this->createTables();
        $this->insertAdmin();
        $this->insertTestData();
    }
 
}
?>
