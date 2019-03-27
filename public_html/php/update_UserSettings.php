<?php
include_once("../utils/UserManager.php");
include_once("../utils/HTTPUtils.php");
include_once("../utils/User_Settings.php");

session_start();
if(array_key_exists('weather', $_POST) &&
   array_key_exists('todo', $_POST) &&
   array_key_exists('news', $_POST) &&
   array_key_exists('bio', $_POST) &&
   array_key_exists('game', $_POST) &&
   count($_POST) == 5 ) 
   {
	   $user_settings = new User_Settings();
	   $user_settings->weather = htmlspecialchars($_POST['weather'], ENT_QUOTES);
	   $user_settings->todo = htmlspecialchars($_POST['todo'], ENT_QUOTES);
	   $user_settings->news = htmlspecialchars($_POST['news'], ENT_QUOTES);
	   $user_settings->bio = htmlspecialchars($_POST['bio'], ENT_QUOTES);
	   $user_settings->game = htmlspecialchars($_POST['game'], ENT_QUOTES);
	   	   
	   if(UserManager::updateSettings($_SESSION['username'], $user_settings) {
			HTTPUtils::redirectPage("/php/settings.php");
		}
   }
?>