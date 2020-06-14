<?php

include '../main.php';

if(!$auth->check()) {

}

if(!isset($_GET["action"])){
    if(!isset($_POST["action"])){
        $action = "show_performances";
    }
}

switch($action) {
    case "show_performances":
        $user_id = $auth->getUserId();
        $user_performances = get_performances_by_user_id($user_id);
        include 'view.php';
        break;
}