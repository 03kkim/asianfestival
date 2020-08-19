<?php
create_header("<style>
.calendar-row {
    height:13vh;
}
</style>
"); ?>
<?php
$month = date("n");
echo draw_calendar($month, "2020");

create_footer(); ?>
