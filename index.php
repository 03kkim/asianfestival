<?php

include "main.php";

$daily_practices = get_daily_practices();
$timeslots = get_timeslots();

include "view.php";