<!Doctype HTML5>
<!--
Author(s): Beesham Sarendranauth
-->

<?php
    include_once('../utils/HTTPUtils.php');
    include_once('../utils/DatabaseUtils.php');
    include_once('../../extras/databaseConfig.php');

    session_start();

    if($db_init) {
        $db = new DatabaseUtils();
        $db->connectToDb();
        $db->initDB();
    }

    //repopulates the forms
    function repopulate($field) {
        if(array_key_exists($field, $_SESSION)) {
            echo $_SESSION[$field];//echos the value to the form
         }           
    }

    if(array_key_exists('logged_in', $_SESSION)) {
        if($_SESSION['logged_in'] == 'true') HTTPUtils::redirectPage('/php/mainpage.php');
    }
?>

<html>
    <head>
        <title>Dashboard</title>
        <link rel="stylesheet" href="/css/homepage.css" type="text/css">
    </head>

    <header>
        <h1 id='homepage_title'>My Dashboard</h1>
        
        <div class="homepage_tab">
            <button class="homepage_tab_links" onclick="location.href='/php/homepage.php'">Home</button>
            <button class="homepage_tab_links" onclick="location.href='/html/aboutus.html'">About Us</button>
            <button class="homepage_tab_links" onclick="location.href='/html/contact.html'">Contact Us</button>
        </div> 
        
    </header>
    <body>
        <div id="content_area">
            <div class="slideshow_container">
                <div class="slides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="/images/image1.jpg">
                </div>
                <div class="slides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="/images/image2.jpg">
                </div>
                 <div class="slides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="/images/image3.png">
                </div>
            </div>
            
            <!--For slideshow-->
            <script src="/javascript/homepage.js"></script>
               
            <div id='homepage_login'>
                <!--User login-->
                <form action="/php/login_user.php" method="POST">
                    <div class="imgcontainer">
                        <img src="/images/avatar.svg" alt="Avatar" class="avatar">
                    </div>

                    <div class="login_container">
                        <label for="username"><b>Username:</b></label>
                        <input type="text" placeholder="Enter Username" name="username" required value="<?php repopulate('username') ?>" >
                        <label for="password"><b>Password:</b></label>
                        <input type="password" placeholder="Enter Password" name="password" required><br>
                        <button type="submit">Login</button>
                        <a href="#" id='signup' onclick="document.getElementById('register').style.display='block'" style="width=auto">Sign up!</a>
                    </div>
                </form>    
             
                 <!--User registration-->
                <div id="register" class="register_modal">
                    <form class="register_content animate" action="/php/register_user.php" method="POST">
                        <span onclick="document.getElementById('register').style.display='none'" class="close" title="Close">&times;</span>
                        <div class="register_container">
                            <h1>Sign Up</h1>
                            <p>Please fill this form to register.</p>
                            <hr>
                            <label for="firstname"><b>Firstname</b></label>
                            <input type="text" id='firstname' placeholder="Firstname" name="firstname" value="<?php repopulate('firstname') ?>" required>
                            
                            <label for="lastname"><b>Lastname</b></label>
                            <input type="text" id='lastname' placeholder="Lastname" name="lastname" value="<?php repopulate('lastname') ?>" required>
                            
                            <label for="email"><b>Email</b></label>
                            <input type="email" id='email' placeholder="example@example.com" name="email" value="<?php repopulate('email') ?>" required>
                            
                            <label for="password"><b>Password</b></label>
                            <input type="password" id='password' placeholder="Password" name="password" required>
                            
                            <button type="submit">Register</button>
                        </div>
                    </form>
                </div>
                <script src="/javascript/homepage_register_modal.js"></script>

<?php
    if(array_key_exists('registration_error', $_SESSION)) {
        echo <<<ZZEOF
            <script>
                document.getElementById('signup').click();
                alert("That email is already in use!");
            </script>
ZZEOF;
        unset($_SESSION['registration_error']);
    } 

    if(array_key_exists('invalid_credentials', $_SESSION)) {
        echo <<<ZZEOF
            <script>alert("Invalid credentials!")</script>
ZZEOF;
    }
        unset($_SESSION['invalid_credentials']);
?> 
                
            </div>
        </div>
    </body>

</html>
