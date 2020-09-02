<?php
create_header("");
?>
<div class="row">
    <div class="col s12">
        <ul class="tabs">
            <li class="tab col s3"><a class="active" href="#test1">Create Practice</a></li>
            <li class="tab col s3"><a href="#test2">View Users</a></li>
            <li class="tab col s3"><a href="#test3">Country Leader</a></li>
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
    <div id="test2" class="col s12">
        <table class="centered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Email</th>
                    <th>Has paid? (All Perfs)</th>
                    <th>Delete (All Perfs) </th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user["username"] ?></td>
                    <td><?php echo $user["grade"] ?></td>
                    <td><?php echo $user["email"] ?></td>
                    <td>
                        <p>
                            <label>
                                <input
                                    <?php if ($user["is_paid"] == "1") echo " checked "?>
                                        onchange="change_paid_status('<?php echo $user["id"]?>', $(this).is(':checked'))" type="checkbox">
                                <span></span>
                            </label>
                        </p>
                    </td>
                    <td><i style="color:red;cursor:pointer" onclick='remove_user_from_festival("<?php echo $user['id']?>")' class="material-icons">delete</i></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div id="test3" class="col s12">
        <table class="centered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Grade</th>
                <th>Email</th>
                <th>Country Leader</th>
                <th>Performance Leader</th>
            </tr>
            </thead>

            <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo $user["username"] ?></td>
                    <td><?php echo $user["grade"] ?></td>
                    <td><?php echo $user["email"] ?></td>
                    <td>
                        <div class="input-field col s12">
                            <select name="country_id" id="country_id" onchange="change_country_leader_status(<?php echo $user["id"] ?>, <?php echo $country?>)">
                                <?php
                                $country_leader_statuses = array();
                                foreach ($countries as $country) {
                                    $style = "";
                                    $country_leader_statuses[] = check_country_leader($user["id"], $country["country_id"])["is_country_leader"];
                                    if (check_country_leader($user["id"], $country["country_id"])["is_country_leader"] == 1) {
                                        $style = "selected";
                                    }?>
                                <option value="<?php echo $country["country_id"] ?>" <?php echo $style ?>><?php echo $country["country_name"]?></option>
                                <?php }

                                $style = "selected";
                                if (in_array(1, $country_leader_statuses)) {
                                    $style = "";
                                }
                                ?>
                                <option value="6" <?php echo $style ?>>Not a Country Leader</option>
                            </select>
                            <label for="country_id"></label>
                        </div>
                    </td>
                    <td><i style="color:red;cursor:pointer" onclick='remove_user_from_festival("<?php echo $user['id']?>")' class="material-icons">delete</i></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
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
    function change_paid_status(user_id, checked) {
        let c = 0;
        if (checked) {
            c = 1;
        }
        let url = "../control_panel/index.php?user_id=" + user_id + "&is_paid=" + c + "&action=change_paid_status";
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", url);

        xhttp.send();
    }
    function change_country_leader_status(user_id, country_id) {
            let url = "../control_panel/index.php?user_id=" + user_id + "&country_id=" + country_id + "&action=change_country_leader_status";
     }
    function remove_user_from_festival(user_id) {
        if (confirm("Are you sure you want to remove this user?")) {
            location.href = "../control_panel/index.php?action=remove_user_from_festival&user_id=" + user_id;
        }
    }
</script>

<?php
create_footer();
?>
