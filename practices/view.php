<?php
create_header("");
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
                <table class="centered">
                    <thead>
                        <tr>
                            <th> Location </th>
                            <th> Date </th>
                            <th> Timeslot </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $practices = get_practices_by_performance_id($performance["performance_id"]);
                    if(empty($practices)) {?>
                        <tr><td colspan="3">There are no upcoming practices for this performance.</td></tr>
                    <?php }
                    else {
                        foreach($practices as $practice) { ?>
                        <tr>
                            <td> <?php echo $practice["location_name"] ?> </td>
                            <td> <?php echo $practice["formatted_date"] ?> </td>
                            <td> <?php echo $practice["time"] ?> </td>
                        </tr>
                    <?php } }?>
                    </tbody>
                </table>
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

    function request_admin_status(performance_id, checked) {
        let user_id = "<?php echo $user_id ?>";
        let url = "../practices/index.php?user_id=" + user_id + "&checked=" + checked + "&action=request_admin&performance_id=" + performance_id;

        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", url);

        xhttp.send();
    }
</script>