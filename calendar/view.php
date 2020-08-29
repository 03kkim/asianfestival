<?php
create_header("<style>
.calendar-row {
    height:13vh;
}
</style>
");
?>
<h1 style="text-align:center"> Practices for <i style="color:#ff0000;cursor:pointer;font-size:2.5rem" onclick='last_month(<?php echo $month ?>)' class="material-icons">chevron_left</i><?php echo $months[$month-1] ?><i style="color:#ff0000;cursor:pointer;font-size:2.5rem" onclick='next_month(<?php echo $month ?>)' class="material-icons">chevron_right</i> <?php echo $year ?> </h1>
<script>
    function last_month(month) {
        location.href = "../calendar/index.php?month=" + (month - 1);
    }
    function next_month(month) {
        location.href = "../calendar/index.php?month=" + (month + 1);
    }

</script>

<?php echo
draw_calendar((int)$month, "2020");
create_footer(); ?>
