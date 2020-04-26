<?php

include "setup.php";

function get_daily_practices() {
    global $db;

    $query = "select start_time, end_time, location_name, performance.name from practice, location, performance
              where practice.location_id = location.location_id
              and practice.performance_id = performance.performance_id
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