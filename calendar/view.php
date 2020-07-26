<?php
create_header($extra_style="<style>
.calendar-row {
    height:13vh;
}
</style>
");
$month = date("n");
echo draw_calendar($month, "2020");

create_footer(); ?>
