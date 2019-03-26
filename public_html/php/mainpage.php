<?php
    include_once('../utils/HTTPUtils.php');

    session_start();
    if(!array_key_exists('logged_in', $_SESSION)) {
        HTTPUtils::redirectPage('/php/homepage.php');
    }
?>

<html>
<head>
    <title>My Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/css/mainpage.css"/>
    <script src="/javascript/mainpage.js" type="application/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
<!--Navigation-->
<header class="header">
    <h1 class="logo"><a href="#">MY DASHBOARD</a></h1>
    <ul class="main-nav">
        <li><a href="#">SETTINGS</a></li>
        <li><a href="/php/logout_user.php">LOGOUT</a></li>
    </ul>
</header>

<div class="container">

    <!--User greeting tile-->
    <div class="item greeting">
        <div id="time"></div>
        <div id="greeting"></div>
        <div id="userName">
            <?php
            session_start();
            if(array_key_exists('username', $_SESSION)) {
                echo  $_SESSION['username'];
            }
            ?>
        </div>
        <div id="quote"></div>
    </div>

    <!--To do list tile-->
    <div id="todolist" class="item">
        <input id="input" placeholder="What needs to be done?">
        <button id="inputBttn">Add</button>
        <ul id="list"></ul>
    </div>

    <!--Weather tile-->
    <div id="weather-container" class="item">
        <div class="weather" id="weather"></div>
        <img class="weather" id="myImg">
        <div class="weather" id="temp"></div>
        <div class="weather" id="weatherDisc"></div>
        <div class="weather" id="minTemp"></div>
        <div class="weather" id="maxTemp"></div>
    </div>

    <!--Game-->
    <div id="game" class="item">
        <div id="game-menu">
            <h2>Drag & Drop</h2>
            <p>Drag the city on top of their residing country</p>
            <button id="game-reset-button">RESET</button>
        </div>
        <div id="cities"></div>
        <div id="country"></div>

    </div>

    <!--News-->
    <div id="news-container" class="item">
        <h2> Todays Top 5 headlines </h2>
        <div id=news-articles></div>
    </div>

</div>
</body>
<footer id="mainPgFooter">

    <p>About us | Contact us</p>

</footer>