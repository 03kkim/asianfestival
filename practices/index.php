<?php

include '../main.php';

// Left unfinished so I wasn't really sure what to do here. I changed it so that loading the page wasn't dependent on whether or not somebody had just submitted a form or not.
if(!$auth->check()) {
    header("Location: /asianfestival/index.php");
}
$action = filter_input(INPUT_GET, "action");
if(!isset($_GET["action"])){
    $action = filter_input(INPUT_POST, "action");
    if(!isset($_POST["action"])){
        $action = "show_practices";
    }
}

switch($action) {
    case "show_practices":
        $user_id = $auth->getUserId();
        $user_info = get_user_info($user_id);
        $user_performances = get_performances_by_user_id($user_id);
        include 'view.php';
        break;

    case "request_admin":
        $user_id = filter_input(INPUT_GET, "user_id");
        $performance_id = filter_input(INPUT_GET, "performance_id");
        $checked = filter_input(INPUT_GET, "checked");
        $status = "N";
        if ($checked == "true") {
            $status = "P";
        }

        change_admin_status($user_id, $performance_id, $status);
        break;

    case "create_practice":
        if(!$auth->hasRole(\Delight\Auth\Role::ADMIN)) {
            header("Location: ../index.php");
        }
        $performance_id = filter_input(INPUT_GET, "performance_id");
        include "create_practice.php";
}