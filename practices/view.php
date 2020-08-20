<?php
create_header();
?>
<h1>Practices</h1>
<ul class="collapsible expandable">
    <?php foreach($user_performances as $performance) {
        $status = check_performance_leader($user_id, $performance["performance_id"]) ?>
        <li>
            <div class="collapsible-header"><i class="material-icons">person</i><?php echo $performance["name"]?></div>
            <div class="collapsible-body">
                <span>Country: <?php echo $performance["country_name"] ?></span>
                <p>
                    <label>
                        <input
                                <?php if ($status == "Y") echo " disabled "?>
                                <?php if ($status != "N") echo " checked " ?>
                                onchange="request_admin_status('<?php echo $performance["performance_id"]?>', $(this).is(':checked'))"
                                type="checkbox">
                        <span> <?php if ($status == "Y") echo "You are admin!"; else echo "Request Admin Status?";?> </span>
                    </label>
                </p>
                <?php if($status == "Y") { ?>
                <a href="../practices/index.php?action=create_practice&performance_id=<?php echo $performance['performance_id']?>" class="waves-effect waves-light btn">Create a Practice</a>
                <?php } ?>
                <?php if ($status == "Y") { ?>
                <div style="margin-top: 3%" class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col s6"><a href="#practices<?php echo $performance["performance_id"]?>">Practices</a></li>
                            <li class="tab col s6"><a href="#users<?php echo $performance["performance_id"]?>">Users</a></li>
                        </ul>
                    </div>
                    <div id="practices<?php echo $performance["performance_id"] ?>" class="col s12">
                <?php } ?>
                <table class="centered">
                    <thead>
                        <tr>
                            <th> Location </th>
                            <th> Date </th>
                            <th> Timeslot </th>
                            <?php if ($status == "Y") echo "<th>  </th>" ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $practices = get_practices_by_performance_id($performance["performance_id"]);
                    if(empty($practices)) {?>
                        <tr><td colspan="4">There are no upcoming practices for this performance.</td></tr>
                    <?php }
                    else {
                        foreach($practices as $practice) { ?>
                        <tr>
                            <td> <?php echo $practice["location_name"] ?> </td>
                            <td> <?php echo $practice["formatted_date"] ?> </td>
                            <td> <?php echo $practice["time"] ?> </td>
                            <?php if ($status == "Y") { ?><td><i style="color:#ff0000;cursor:pointer" onclick='delete_practice("<?php echo $practice['practice_id']?>")' class="material-icons">delete</i></td> <?php } ?>
                        </tr>
                    <?php } }?>
                    </tbody>
                </table>
                <?php if($status == "Y") { ?>
                    </div>
                    <div id="users<?php echo $performance["performance_id"]?>" class="col s12">
                        <table class="centered">
                            <thead>
                                <tr>
                                    <th> Name </th>
                                    <th> Email </th>
                                    <th> Paid Status </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach(get_users_by_performance($performance["performance_id"]) as $user) { ?>
                                <tr>
                                    <td> <?php echo $user["username"] ?> </td>
                                    <td> <?php echo $user["email"] ?> </td>
                                    <td>
                                        <p>
                                        <label>
                                            <input
                                                <?php if ($user["is_paid"] == "1") echo " checked "?>
                                                    onchange="change_paid_status('<?php echo $performance["performance_id"]?>', '<?php echo $user["id"]?>', $(this).is(':checked'))"
                                                    type="checkbox">
                                            <span></span>
                                        </label>
                                        </p>
                                    </td>
                                    <td><i style="color:red;cursor:pointer" onclick='remove_user_from_perf("<?php echo $user['id']?>", "<?php echo $performance['performance_id']?>")' class="material-icons">delete</i></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>
            </div>
        </li>
    <?php } ?>
</ul>
<?php
create_footer();
?>
<script>
    // $(document).ready(function(){
    //     $('.collapsible').collapsible();
    // });

    //Changed so you can expand multiple practice schedules at once
    var elem = document.querySelector('.collapsible.expandable');
    var instance = M.Collapsible.init(elem, {
        accordion: false
    });

    $(document).ready(function(){
        $('.tabs').tabs();
    });

    function request_admin_status(performance_id, checked) {
        let user_id = "<?php echo $user_id ?>";
        let url = "../practices/index.php?user_id=" + user_id + "&checked=" + checked + "&action=request_admin&performance_id=" + performance_id;

        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", url);

        xhttp.send();
    }

    function delete_practice(practice_id) {
        if (confirm("Are you sure you want to delete this practice?")) {
            location.href = "../practices/index.php?action=delete_practice&practice_id=" + practice_id;
        }
    }
    function remove_user_from_perf(user_id, performance_id) {
        if (confirm("Are you sure you want to remove this user?")) {
            location.href = "../practices/index.php?action=remove_user_from_perf&user_id=" + user_id + "&performance_id=" + performance_id;
        }
    }

    function change_paid_status(user_id, checked) {
        let c = 0;
        if (checked) {
            c = 1;
        }
        let url = "../control_panel/index.php?user_id=" + user_id + "&is_paid=" + c + "&action=change_paid_status&performance_id_var=" + performance_id;
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", url);

        xhttp.send();
    }
</script>