# WebDevDashboard

## Purpose:
The website serves the purpose of having a centralized dashboard with quick links to frequently used/visited applications and websites. It also has tiles/widgets that provide frequently sought data such as weather.

## Database Installation: 

### Assuming a database file is created on your server.

Create 2 files in the extras folder
- adminConfig.php
- databaseConfig.php

Place administractors credentials for the website in the adminConfig.php:
```
<?php
  $admin_password = "XXXXX";
  $admin_username = "XXXXX";
  $admin_email = "XXXXX";
?>
```

Place database credentials in the databaseConfig.php:
```
<?php
  $servername = "YOUR SERVER NAME";
  $dbname = "YOUR DATABASE NAME";
  $username = "YOUR USERNAME";
  $password = "YOUR DB PASSWORD";
  
  $db_init = 0; //1=True, 0=False. Drops and re-creates all tables. Inserts only admin credentials
  $db_init_testdata = 0; //Inserts test data if set to 1 in combination with db_init=1
?>
```

To initialize the databse set `db_init = 1` which will then drop tables if exists and then re-create them. It will also insert
the admin credentials provided in the `adminConfig.php` file.

To insert test data set `db_init_testdata = 1` in combination with `db_init = 1`.

## Website Installation:
//TODO

## Website Walkthrough 
//TODO
*Includes where rubric items are
*Note security checks and where they are included

