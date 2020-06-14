<?php

include "../main.php";

if(!isset($_GET["action"])){
    if(!isset($_POST["action"])){
        $action = "show_form";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = "add_user";
}


switch($action) {
    case "show_form":
        $performances = get_performances();
        include 'view.php';

    case "add_user":
        $button_value = filter_input(INPUT_POST, "submit");
        if($button_value == "Submit") {
            $email = filter_input(INPUT_POST, "email");
            $first_name = filter_input(INPUT_POST, "first_name");
            $last_name = filter_input(INPUT_POST, "last_name");
            $grade = filter_input(INPUT_POST, "grade");
            $password = filter_input(INPUT_POST, "password");

            add_user($email, $password, $first_name, $last_name, $grade);
        }
        break;
}