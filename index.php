<?php

include "main.php";

$daily_practices = get_daily_practices();
$timeslots = get_timeslots();
$userEmail = "03kkim@ridgewood.k12.nj.us";

try {
    $auth->admin()->addRoleForUserByEmail($userEmail, \Delight\Auth\Role::SUPER_ADMIN);
}
catch (\Delight\Auth\InvalidEmailException $e) {
    die('Unknown email address');
}

include "view.php";