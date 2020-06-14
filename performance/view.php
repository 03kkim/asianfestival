<?php
create_header();
?>

<ul class="collapsible">
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
    $(document).ready(function(){
        $('.collapsible').collapsible();
    });
</script>