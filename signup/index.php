<?php

include "../main.php";

if(!isset($_GET["action"])){
    if(!isset($_POST["action"])){
        $action = "show_form";
    }
}

switch($action) {
    case "show_form":
        $performances = get_performances();
        include 'view.php';

    case "add_user":
        $email = $_POST["email"];
}