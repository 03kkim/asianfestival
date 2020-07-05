<?php

include "setup.php";

function get_daily_practices() {
    global $db;

    $query = "select concat(start_time, ' - ', end_time) as time, location_name, performance.name from practice, location, performance, timeslot
              where practice.location_id = location.location_id
              and practice.performance_id = performance.performance_id
              and practice.time_id = timeslot.time_id
              and date = CURDATE()
              order by start_time";

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        echo $e;
        exit();
    }
}

function get_timeslots() {
    global $db;

    $query = "select concat(start_time, ' - ', end_time) as time, start_time, end_time, time_id 
              from timeslot order by start_time";

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch(PDOException $e) {
        echo $e;
        exit();
    }
}

function get_daily_practices_by_time_id($time_id) {
    global $db;

    $query = "select concat(start_time, ' - ', end_time) as time, location_name, performance.name from practice, location, performance, timeslot
              where practice.location_id = location.location_id
              and practice.performance_id = performance.performance_id
              and practice.time_id = timeslot.time_id
              and date = CURDATE()
              and practice.time_id = :time_id
              order by start_time";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":time_id", $time_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        echo $e;
        exit();
    }
}

function get_practices_by_date($day, $month, $year) {
    global $db;

    $query = "select concat(start_time, ' - ', end_time) as time, location_name, performance.name from practice, location, performance, timeslot
              where practice.location_id = location.location_id
              and practice.performance_id = performance.performance_id
              and practice.time_id = timeslot.time_id
              and day(date) = :day
              and month(date) = :month
              and year(date) = :year
              order by start_time";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":day", $day);
        $statement->bindValue(":month", $month);
        $statement->bindValue(":year", $year);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    }
    catch (PDOException $e) {
        echo $e;
        exit();
    }
}
function get_performances() {
    global $db;

    $query = "select * from performance";

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch(PDOException $e) {
        echo $e;
        exit();
    }
}

function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
}

function add_user($email, $password, $first_name, $last_name, $grade, $performances) {
    global $db;
    global $auth;

    $user_id = $auth->register($email, $password, $first_name . " " . $last_name);

    $query = "insert into performance_user_xref (performance_id, user_id) values ";
    foreach($performances as $performance) {
        $query .= " (" . $performance . ", " . $user_id . "), ";
    }

    $query = str_lreplace(",", "", $query);

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    }

    catch (PDOException $e) {
        echo $e;
        exit();
    }

    $query = "insert into user_info (user_id, grade) values (" . $user_id . ", " . $grade . ")";

    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $statement->closeCursor();
    }

    catch (PDOException $e) {
        echo $e;
        exit();
    }
}

function get_performances_by_user_id($user_id) {
    global $db;

    $query = "select * from performance, performance_user_xref, country
              where user_id = :user_id 
              and performance.performance_id = performance_user_xref.performance_id
              and performance.country_id = country.country_id";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        return $result;
    } catch(PDOException $e) {
        echo $e;
        exit();
    }
}

function get_practices_by_performance_id($performance_id) {
    global $db;

    $query = "select location_name, date_format(date, '%M %D, %Y') as formatted_date, concat(time_format(start_time, '%h:%i %p'), ' - ', time_format(end_time, '%h:%i %p')) as time from practice, location, timeslot 
              where performance_id = :performance_id
              and practice.location_id = location.location_id
              and practice.time_id = timeslot.time_id
              and date >= CURDATE()
              order by date
              limit 3";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":performance_id", $performance_id);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        return $result;
    } catch(PDOException $e) {
        echo $e;
        exit();
    }
}

function change_admin_status($user_id, $performance_id, $status) {
    global $db;

    $query = "update performance_user_xref 
              set is_performance_leader = :status 
              where user_id = :user_id 
              and performance_id = :performance_id";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":user_id", $user_id);
        $statement->bindValue(":performance_id", $performance_id);
        $statement->bindValue(":status", $status);
        $statement->execute();
        $statement->closeCursor();

    } catch(PDOException $e) {
        echo $e;
        exit();
    }
}

function get_user_info($user_id) {
    global $db;

    $query = "select * from user_info where user_id = :user_id";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        $result = $statement->fetch();

        $statement->closeCursor();

        return $result;
    } catch(PDOException $e) {
        echo $e;
        exit();
    }
}

function check_performance_leader($user_id, $performance_id) {
    global $db;

    $query = "select * from performance_user_xref where user_id = :user_id and performance_id = :performance_id";

    try {
        $statement = $db->prepare($query);
        $statement->bindValue(":user_id", $user_id);
        $statement->bindValue(":performance_id", $performance_id);

        $statement->execute();
        $result = $statement->fetch();

        $statement->closeCursor();

        return $result["is_performance_leader"];
    } catch(PDOException $e) {
        echo $e;
        exit();
    }
}

function get_pending_admin_requests() {
    global $db;

    $query = "select * from performance_user_xref, users, performance
              where performance_user_xref.user_id = users.id and performance_user_xref.performance_id = performance.performance_id
              and is_performance_leader = 'P'";

    try{
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();

        return $result;
    } catch(PDOException $e) {
        echo $e;
        exit();
    }
}