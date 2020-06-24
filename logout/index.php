<?php
include "../main.php";
include "./db/festival_db.php";
$auth->logOut();
header("Location: ../index.php");