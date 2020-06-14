<?php

$db_host = "localhost";

$db_name = "asianfestival";

$username = "root";

$password = "root";

$dsn = "mysql:host=" . $db_host . ";dbname=" . $db_name;

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

$db = new PDO($dsn, $username, $password, $options);

