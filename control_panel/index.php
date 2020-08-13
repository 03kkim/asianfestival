<?php
if(!$auth->check() || !$auth->hasRole(\Delight\Auth\Role::SUPER_ADMIN)) {
    header("Location: /asianfestival/index.php");
}
$action = filter_input(INPUT_GET, "action");
if(!isset($_GET["action"])){
    $action = filter_input(INPUT_POST, "action");
    if(!isset($_POST["action"])){
        $action = "show_users";
    }
}

switch($action) {
    case "show_users":

}