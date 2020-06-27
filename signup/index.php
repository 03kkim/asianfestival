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
        break;

    case "add_user":
        $button_value = filter_input(INPUT_POST, "submit");
        if($button_value == "Submit") {
            $email = filter_input(INPUT_POST, "email");
            $first_name = filter_input(INPUT_POST, "first_name");
            $last_name = filter_input(INPUT_POST, "last_name");
            $grade = filter_input(INPUT_POST, "grade");
            $password = filter_input(INPUT_POST, "password");
            $performance1 = filter_input(INPUT_POST, "performance1");
            $performance2 = filter_input(INPUT_POST, "performance2");
            $performance3 = filter_input(INPUT_POST, "performance3");

            if($grade < 11) {
                $performances = array($performance1, $performance2);
            }
            else {
                $performances = array($performance1, $performance2, $performance3);
            }

            $performances = array_unique($performances);

            add_user($email, $password, $first_name, $last_name, $grade, $performances);
            $auth->login($email, $password);
        }
        header("Location: ../practices/index.php");
        break;
}