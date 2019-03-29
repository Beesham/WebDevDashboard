<!DOCTYPE HTML5>
<!-- Author(s): Beesham Sarendranauth | Billy Le -->
<?php
    include_once('../utils/HTTPUtils.php');
	include_once('../utils/UserManager.php');
	include_once('../utils/User_Settings.php');

    session_start();
    if(!array_key_exists('logged_in', $_SESSION)) {
        HTTPUtils::redirectPage('/php/homepage.php');
    }
	
	$user_settings = UserManager::getUserSettings($_SESSION['username']);
	
	$bioValue = $user_settings->bio;
	$todoValue = $user_settings->todo;
	$weatherValue = $user_settings->weather;
    $gameValue = $user_settings->game;
    $newsValue = $user_settings->news;
	
?>
<html>

<head>

    <title>Settings</title>

	<link rel="stylesheet" type="text/css" href="/css/settings.css">
	<script src="/javascript/settings.js" type="application/javascript"></script>
</head>

<header class="header">
    <h1 class="logo"><a href="#">MY DASHBOARD-SETTINGS</a></h1>
	<form action="/php/mainpage.php">
    <input type="submit" value="Mainpage"/>
	</form>
	<form action="/php/logout_user.php">
    <input type="submit" value="Logout and return to Homepage"/>
	</form>
</header>

<body>

<h1>Settings</h1>

<!-- Registered user to change their current password -->
<div id='changePassword'>

    <form action="/php/change_password.php" method="POST">
        <div class="changePassword">
            <label for="username"><b>Reset Password:</b></label>
            <input type="password" placeholder="Enter New Password" name="password" required>
            <button type="submit">Change Password</button>
        </div>
    </form>    

<!-- Toggle switches to update registed users settings -->
<ul class="toggleMenu"><b>
<form method="POST" action="/php/update_UserSettings.php" id="mysettings" name="mysettings">

	<li>User Greeting</li>
	<div class="bio">
		<label class="switch">
		<input id="checkBox1" type="checkbox" name="bio"  onclick="toggleCheckBoxVal('checkBox1')" <?php if ($bioValue=='1') echo 'value="1" checked' ; else echo 'value="0"' ?>>
		<div class="slider round"><!--ADDED HTML -->
		<span class="on">ON</span>
		<span class="off">OFF</span><!--END-->
		</div>
		</label>
	</div>
	
	<li>To Do List</li>
	<div class="todo">
		<label class="switch">
		<input id="checkBox2" type="checkbox" name="todo" onclick="toggleCheckBoxVal('checkBox2')" <?php if ($todoValue=='1') echo 'value="1" checked'; else echo 'value="0"'  ?>>
		<div class="slider round"><!--ADDED HTML -->
		<span class="on">ON</span>
		<span class="off">OFF</span><!--END-->
		</div>
		</label>
	</div>
	
	<li>Weather</li>
	<div class="weather">
		<label class="switch">
		<input id="checkBox3" type="checkbox" name="weather" onclick="toggleCheckBoxVal('checkBox3')" <?php if ($weatherValue=='1') echo 'value="1" checked'; else echo 'value="0"' ?>>
		<div class="slider round"><!--ADDED HTML -->
		<span class="on">ON</span>
		<span class="off">OFF</span><!--END-->
		</div>
		</label>
	</div>
	
	<li>Game</li>
	<div class="game">
		<label class="switch">
		<input id="checkBox4" type="checkbox" name="game"  onclick="toggleCheckBoxVal('checkBox4')" <?php if ($gameValue=='1') echo "value='1' checked"; else echo 'value="0"' ?>>
		<div class="slider round"><!--ADDED HTML -->
		<span class="on">ON</span>
		<span class="off">OFF</span><!--END-->
		</div>
		</label>

	</div>
    
  
    	
	<li>News</li>
	<div class="news">
		<label class="switch">
		<input id="checkBox5" type="checkbox" name="news"  onclick="toggleCheckBoxVal('checkBox5')" <?php if ($newsValue=='1') echo "value='1' checked"; else echo 'value="0"'?>>
		<div class="slider round"><!--ADDED HTML -->
		<span class="on">ON</span>
		<span class="off">OFF</span><!--END-->
		</div>
		</label>
	</div>
	<script type="text/javascript" src="/javascript/settings_switches.js"></script>	
	<button id="mysettingsbutton" type="submit">Save Tile Settings</button>
</form>
</ul>
	
<!-- Admin Panel -->
<?php
if(array_key_exists('is_admin', $_SESSION) && ($_SESSION['is_admin'] == 'true')) {
    echo <<<ZZEOF
    <main>
    <h2>ADMIN CONTROLS</h2>

    <!-- Admin control to change any registered users password -->
    <div class="changeuserpassword">
        <br>
        <form action="/php/change_password.php" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" maxlength="100"> 
            <label for="password">Change User Password</label>
            <input type="password" name="password" id="password" maxlength="100"> 
            <input type="submit" value="Change"> 
        </form>
    </div>

    <!-- Admin control to delete a registered user -->
    <div class="deleteuser">
        <form action="/php/delete_user.php" method="POST">
            <label for="username">Delete User</label>
            <input type="text" placeholder="user@example.com" name="username" id="username" maxlength="100"> 
            <input type="submit" value="Delete"> 
        </form>
    </div>

    <!-- Display all registered users -->
    <div class="displayUsers">
    <p>Number of Users registered: <p>
    </div>
    </main>
ZZEOF;
}
    if(array_key_exists('delete_user_success', $_SESSION) &&
        ($_SESSION['delete_user_success'] == 'true')) {
        echo <<<ZZEOF
            <script>
                alert("Successfully deleted user!");
            </script>
ZZEOF;
        unset($_SESSION['delete_user_success']);
    }
    
    if(array_key_exists('change_password_success', $_SESSION) &&
        ($_SESSION['change_password_success'] == 'true')) {
        echo <<<ZZEOF
            <script>
                alert("Successfully changed password!");
            </script>
ZZEOF;
        unset($_SESSION['change_password_success']);
    }
    
    if(array_key_exists('settings_updated', $_SESSION) &&
        ($_SESSION['settings_updated'] == 'true')) {
        echo <<<ZZEOF
            <script>
                alert("Successfully changed settings!");
            </script>
ZZEOF;
        unset($_SESSION['settings_updated']);
    }

?>

</body>
</html>
