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
    case "change_paid_status":
        $performance_id_var = filter_input(INPUT_GET, "performance_id_var");
        $user_id_var = filter_input(INPUT_GET, "user_id_var");
        $is_paid_var = filter_input(INPUT_GET, "paid_checked");
        change_paid_status($user_id_var, $is_paid_var, $performance_id=$performance_id_var);

        break;


    case "remove_user_from_perf":
        $user_id1 = filter_input(INPUT_GET, "user_id");
        $performance_id1 = filter_input(INPUT_GET, "performance_id");
        remove_user_from_perf($user_id1, $performance_id1);

        $user_id = $auth->getUserId();
        $user_info = get_user_info($user_id);
        $user_performances = get_performances_by_user_id($user_id);

        include 'view.php';

        break;

    case "delete_practice":
        $practice_id = filter_input(INPUT_GET, "practice_id");
        delete_practice($practice_id);

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
            header("Location: /asianfestival/index.php");
        }
        $performance_id = filter_input(INPUT_GET, "performance_id");
        $locations = get_locations();
        $timeslots = get_timeslots();
        try {
            $auth->admin()->addRoleForUserById(1, \Delight\Auth\Role::SUPER_ADMIN);
        }
        catch (\Delight\Auth\UnknownIdException $e) {
            die('Unknown user ID');
        }

        include "create_practice.php";
        break;

    case "add_practice":

        $submit = filter_input(INPUT_POST, "submit");
        if ($submit != "cancel") {
            $performance_id = filter_input(INPUT_POST, "performance_id");
            $location_id = (filter_input(INPUT_POST, "location"));
            $date = filter_input(INPUT_POST, "date");
            $date=date("Y-m-d",strtotime($date));
            $timeslot = filter_input(INPUT_POST, "timeslot");

            if ($timeslot == "custom") {
                $start_time = filter_input(INPUT_POST, "start_time");
                $start_time = date("H:i", strtotime($start_time));
                $end_time = filter_input(INPUT_POST, "end_time");
                $end_time = date("H:i", strtotime($end_time));

                create_custom_timeslot($start_time, $end_time);

                // Hopefully, the $start_time and $end_time can be replaced by $time_id once create_custom_timeslot gets fixed
                create_practice_from_custom_times($performance_id, $location_id, $date, $start_time, $end_time);
            } else {
                create_practice($performance_id, $location_id, $date, $timeslot);
            }

            header("Location: ../practices/index.php");
        }
        if ($submit == "continue") {
            header("Location: ../practices/index.php?action=create_practice&performance_id=" . $performance_id);
        }
        else {
            header("Location: ../practices/index.php");
        }

        break;
}