<?php

include "../main.php";

function draw_calendar($month,$year){
    /* draw table */
    $months = array("January", "February", "March", "April", "May", "June", "July", "August", "September"
                    , "October", "November", "December");
//    $calendar = '<h1 style="text-align:center"> Practices for ' . $months[$month-1] . ' ' . $year . '</h1>';

    $calendar = '<table style="table-layout:fixed" cellpadding="0" cellspacing="0" class="calendar">';

    /* table headings */
    $headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
    $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

    /* days and weeks vars now ... */
    $running_day = date('w',mktime(0,0,0,$month,1,$year));
    $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
    $days_in_this_week = 1;
    $day_counter = 0;
    $dates_array = array();

    /* row for week one */
    $calendar.= '<tr class="calendar-row">';

    /* print "blank" days until the first of the current week */
    for($x = 0; $x < $running_day; $x++):
        $calendar.= '<td class="calendar-day-np"> </td>';
        $days_in_this_week++;
    endfor;

    /* keep going with days.... */
    for($list_day = 1; $list_day <= $days_in_month; $list_day++):
        $calendar.= '<td style="vertical-align:text-top" class="calendar-day">';
        /* add in the day number */
        $calendar.= '<p class="day-number">'.$list_day.'</p>';

        $practices = get_practices_by_date($list_day, $month, $year);
        if(empty($practices)) {
            $calendar .= "<p> &nbsp&nbsp </p>";
        }

        $practice_name_list = array();
        $performance_list = get_performances();

//      This selects all the practices, but it should be fixed so it selects the practices for only the specific day that is being drawn
        foreach($practices as $practice) {
            $practice_name_list[] = $practice["name"];
        }

        if(count($practice_name_list) == count($performance_list)) {
            $calendar .= "<span style='text-align:center;' class='grey-text'>All performances</span>";
        }
//      If over half the practices are taking place on a certain day, then only the practices that aren't being held will be shown (in red)
        if(count($practice_name_list) > count($performance_list)/2) {
            $calendar .= "<span style='text-align:center;' class='grey-text'>All performances except:</span><br>";
            foreach($performance_list as $performance) {
                if(!in_array($performance["name"], $practice_name_list)) {
                    $calendar .= "<span style='text-align:center;' class='red-text'>" . $performance["name"] . "</span><br>";
                }
            }
        }
//      Else, if less than half the practices are taking place on a certain day, then the practices that are being held on that day will be shown in teal
        else {
            foreach($practices as $practice) {
                $calendar .= "<span style='text-align:center;' class='grey-text'>" . $practice["name"] . "</span><br>";

            }
        }

        $calendar.= '</td>';
        if($running_day == 6):
            $calendar.= '</tr>';
            if(($day_counter+1) != $days_in_month):
                $calendar.= '<tr class="calendar-row">';
            endif;
            $running_day = -1;
            $days_in_this_week = 0;
        endif;
        $days_in_this_week++; $running_day++; $day_counter++;
    endfor;

    /* finish the rest of the days in the week */
    if($days_in_this_week < 8):
        for($x = 1; $x <= (8 - $days_in_this_week); $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
        endfor;
    endif;

    /* final row */
    $calendar.= '</tr>';

    /* end the table */
    $calendar.= '</table>';

    /* all done, return result */
    return $calendar;
}

if (!isset($_GET["month"])) {
//    $_GET["month"] = date("n");
    header("Location: /calendar/index.php?month=" . date("n"));
}

$month = $_GET["month"];
$year = date("Y");
$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September"
, "October", "November", "December");

if(!isset($_GET["action"])){
    if(!isset($_POST["action"])){
        $action = "show_calendar";
    }
}

switch($action) {
    case "show_calendar":
        include 'view.php';
}