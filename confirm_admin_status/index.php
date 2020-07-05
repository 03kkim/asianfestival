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

}
