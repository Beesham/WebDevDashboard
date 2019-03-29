<?php
include_once("../utils/UserManager.php");
include_once("../utils/HTTPUtils.php");
include_once("../utils/User_Settings.php");

session_start();
if(array_key_exists('weather', $_POST) ||
   array_key_exists('todo', $_POST) ||
   array_key_exists('news', $_POST) ||
   array_key_exists('bio', $_POST) ||
   array_key_exists('game', $_POST)||
   count($_POST) >= 0)
   {
	   $user_settings = new User_Settings();
       if(isset($_POST["weather"])) {
           $user_settings->weather = htmlspecialchars($_POST['weather'], ENT_QUOTES);
       } else $user_settings->weather = 0;

       if(isset($_POST["todo"])) {
	       $user_settings->todo = htmlspecialchars($_POST['todo'], ENT_QUOTES);
       } else $user_settings->todo = 0;
       
       if(isset($_POST["news"])) {
	        $user_settings->news = htmlspecialchars($_POST['news'], ENT_QUOTES);
       } else $user_settings->news = 0;
       
       if(isset($_POST["bio"])) {
	        $user_settings->bio = htmlspecialchars($_POST['bio'], ENT_QUOTES);
       } else $user_settings->bio = 0;
       
       if(isset($_POST["game"])) {
	        $user_settings->game = htmlspecialchars($_POST['game'], ENT_QUOTES);
       } else $user_settings->game = 0;

        var_dump($user_settings);
	   	   
	   if(UserManager::updateSettings($_SESSION['username'], $user_settings)) {
            $_SESSION['settings_updated'] = 'true';
			HTTPUtils::redirectPage("/php/settings.php");
	   } else $_SESSION['settings_updated'] = 'false';
    }
?>
