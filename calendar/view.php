<?php
create_header("<style>
.calendar-row {
    height:13vh;
}
</style>
");
?>
<?php
$month = date("n");
$year = date("Y");
$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September"
, "October", "November", "December");
$calendar = '<h1 style="text-align:center"> Practices for ' . $months[$month-1] . ' ' . $year . '</h1>';
 ?>
<h1 style="text-align:center"> Practices for <i style="color:#ff0000;cursor:pointer;font-size:2.5rem" onclick='last_month()' class="material-icons">chevron_left</i> August <i style="color:#ff0000;cursor:pointer;font-size:2.5rem" onclick='last_month()' class="material-icons">chevron_right</i> <?php echo $year ?> </h1>
<script>
    function next_month()
    function last_month()
</script>
<?php echo
draw_calendar($month, "2020");
create_footer(); ?>
