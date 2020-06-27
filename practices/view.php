<?php
create_header("");
?>
<h1>Practices</h1>
<ul class="collapsible expandable">
    <?php foreach($user_performances as $performance) { ?>
        <li>
            <div class="collapsible-header"><i class="material-icons">person</i><?php echo $performance["name"]?></div>
            <div class="collapsible-body">
                <span>Country: <?php echo $performance["country_name"] ?></span>
                <table class="centered">
                    <thead>
                        <tr>
                            <th> Location </th>
                            <th> Date </th>
                            <th> Timeslot </th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach(get_practices_by_performance_id($performance["performance_id"]) as $practice) { ?>
                        <tr>
                            <td> <?php echo $practice["location_name"] ?> </td>
                            <td> <?php echo $practice["date"] ?> </td>
                            <td> <?php echo $practice["time"] ?> </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </li>
    <?php } ?>
</ul>

<script>
    // $(document).ready(function(){
    //     $('.collapsible').collapsible();
    // });

    //Changed so you can expand multiple practice schedules at once
    var elem = document.querySelector('.collapsible.expandable');
    var instance = M.Collapsible.init(elem, {
        accordion: false
    });
</script>