<?php
create_header("");
?>
<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s3"><a class="active" href="#test1">Create Practice</a></li>
            <li class="tab col s3"><a href="#test2">View Users</a></li>
            <li class="tab col s3"><a href="#test3">Disabled Tab</a></li>
            <li class="tab col s3"><a href="#test4">Test 4</a></li>
        </ul>
    </div>
    <div id="test1" class="col s12">
        <div class="container" style="margin-top:5%">
            <div class="row">
                <form class="col s12" method="post" action="index.php">
                    <input type="hidden" name="action" value="add_practice">
                    <div class="row">
                        <div class="input-field col s12">
                            <select name="performance_id" id="performance_id">
                                <?php foreach ($performances as $performance) { ?>
                                    <option value="<?php echo $performance['performance_id']?>"><?php echo $performance["name"]?></option>
                                <?php } ?>
                            </select>
                            <label for="performance_id">Performance</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <select name="location" id="location">
                                <?php foreach ($locations as $location) { ?>
                                    <option value="<?php echo $location['location_id']?>"><?php echo $location["location_name"]?></option>
                                <?php } ?>
                            </select>
                            <label for="location">Location</label>
                        </div>
                        <div class="input-field col s6">
                            <select onchange="toggle_custom_time()" name="timeslot" id="timeslot">
                                <?php foreach ($timeslots as $timeslot) { ?>
                                    // "time" is a concat within an SQL statement in festival_db
                                    <option value="<?php echo $timeslot['time_id']?>"><?php echo $timeslot["time"]?></option>
                                <?php } ?>
                                <option value="custom">Custom Time</option>
                            </select>
                            <label for="timeslot">Timeslot</label>
                        </div>
                    </div>
                    <div class="row">
                        <div id="start" class="input-field col s6" style="display:none">
                            <input name="start_time" id="start_time" type="text" class="timepicker">
                            <label for="start_time">Start Time</label>
                        </div>
                        <div id="end" class="input-field col s6" style="display:none">
                            <input name="end_time" id="end_time" type="text" class="timepicker">
                            <label for="end_time">End Time</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input name="date" type="text" class="datepicker">
                            <label for="date">Date</label>
                        </div>
                    </div>
                    <div class="row" style="text-align:center">
                        <div class="input-field col s4">
                            <button class="btn waves-effect waves-light" value="continue" type="submit" name="submit">Add Another
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                        <div class="input-field col s4">
                            <button class="btn waves-effect waves-light" value="finish" type="submit" name="submit">Finish
                                <i class="material-icons right">check</i>
                            </button>
                        </div>
                        <div class="input-field col s4">
                            <button class="btn waves-effect waves-light" value="cancel" type="submit" name="submit">Cancel
                                <i class="material-icons right">cancel</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="test2" class="col s12">Test 2</div>
    <div id="test3" class="col s12">Test 3</div>
    <div id="test4" class="col s12">Test 4</div>
</div>
<script>
    $(document).ready(function(){
        $('.tabs').tabs();
    });

    $(document).ready(function(){
        $('select').formSelect();
        $('.datepicker').datepicker({
            format: 'yyyy-m-d'
        });
        $('.timepicker').timepicker();
    });

    function toggle_custom_time() {
        let start = document.getElementById("start");
        let end = document.getElementById("end");

        let select = document.getElementById("timeslot");

        if(select.options[select.selectedIndex].value == "custom"){
            start.style.display = "block";
            end.style.display = "block";
        }
        else {
            start.style.display = "none";
            end.style.display = "none";
        }
    }
</script>

<?php
create_footer();
?>
