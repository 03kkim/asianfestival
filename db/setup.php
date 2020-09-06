<?php
$db_params = parse_url(getenv("CLEARDB_DATABASE_URL"));

$db_host = "us-cdbr-east-02.cleardb.com";

$db_name = "heroku_92a229cd5108a6f";

$username = "b4ef310d25c5cf";

$password = "f4fe106e";

$dsn = "mysql:host=" . $db_host . ";dbname=" . $db_name;

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

$db = new PDO($dsn, $username, $password, $options);

$auth = new \Delight\Auth\Auth($db);
