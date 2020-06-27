<?php

include '../main.php';

//Left unfinished so I wasn't really sure what to do here. I changed it so that loading the page wasn't dependent on whether or not somebody had just submitted a form or not.
if(!$auth->check()) {
    header("Location: /asianfestival/index.php");
}

else {
    $action = "show_practices";
}
//if(!isset($_GET["action"])){
//    if(!isset($_POST["action"])){
//        $action = "show_performances";
//    }
//}

switch($action) {
    case "show_practices":
        $user_id = $auth->getUserId();
        $user_performances = get_performances_by_user_id($user_id);
        include 'view.php';
        break;
}