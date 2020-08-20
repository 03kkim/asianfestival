<?php

include '../main.php';

if(!$auth->check() || !$auth->hasRole(\Delight\Auth\Role::SUPER_ADMIN)) {
    header("Location: /asianfestival/index.php");
}
include "view.php";
$action = filter_input(INPUT_GET, "action");
if(!isset($_GET["action"])){
    $action = filter_input(INPUT_POST, "action");
    if(!isset($_POST["action"])){
        $action = "create_practice";
    }
}

switch($action) {
    case "create_practice":
        if(!$auth->hasRole(\Delight\Auth\Role::SUPER_ADMIN)) {
            header("Location: /asianfestival/index.php");
        }
        $performance_id = filter_input(INPUT_GET, "performance_id");
        $locations = get_locations();
        $timeslots = get_timeslots();

        include "view.php";
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

            header("Location: ../control_panel/index.php");
        }
        if ($submit == "continue") {
            header("Location: ../control_panel/index.php");
        }
        else {
            header("Location: ../practices/index.php");
        }

        break;
    case "show_users":

}