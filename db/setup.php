<?php
$db_params = parse_url(getenv("CLEARDB_DATABASE_URL"));
$db_host = $db_params["host"];

$db_name = "asianfestival";

$username = $db_params["user"];

$password = $db_params["pass"];

$dsn = "mysql:host=" . $db_host . ";dbname=" . $db_name;

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

$db = new PDO($dsn, $username, $password, $options);

$auth = new \Delight\Auth\Auth($db);
