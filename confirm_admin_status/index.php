<?php
include "../main.php";
if(!$auth->check()) {
    header("Location: /asianfestival/index.php");
}
$action = filter_input(INPUT_GET, "action");
if(!isset($_GET["action"])){
    $action = filter_input(INPUT_POST, "action");
    if(!isset($_POST["action"])){
        $action = "show_requests";
    }
}

switch($action) {
    case "show_requests":
        $requests = get_pending_admin_requests();
        include 'view.php';
        break;

    case "confirm_status":
        $user_id = filter_input(INPUT_GET, "user_id");
        $performance_id = filter_input(INPUT_GET,"performance_id");
        $checked = filter_input(INPUT_GET, "checked");

        $status = "N";
        if ($checked == "true") {
            $auth->admin()->addRoleForUserById($user_id, \Delight\Auth\Role::ADMIN);
            $status = "Y";
        }
        else {
            $auth->admin()->removeRoleForUserById($user_id, \Delight\Auth\Role::ADMIN);
        }

        change_admin_status($user_id, $performance_id, $status);
        break;
}
