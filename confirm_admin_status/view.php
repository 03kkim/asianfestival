<?php
create_header("");
?>
<div class="center-align container">
<table class="centered striped" style="">
    <thead>
        <tr>
            <th>
                Name
            </th>
            <th>
                Email
            </th>
            <th>
                Performance
            </th>
            <th>
                Confirm
            </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($requests as $request) { ?>
            <tr>
                <td><?php echo $request["username"]?></td>
                <td><?php echo $request["email"]?></td>
                <td><?php echo $request["name"]?></td>
                <td>
                    <p>
                        <label>
                            <input type="checkbox" onchange="confirm_admin_status('<?php echo $request["id"] ?>', '<?php echo $request["performance_id"]?>', $(this).is(':checked'))" >
                            <span></span>
                        </label>
                    </p>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
</div>
<?php

create_footer();
?>
<script>
    function confirm_admin_status(user_id, performance_id, checked) {
        let url = "../confirm_admin_status/index.php?action=confirm_status&user_id=" + user_id + "&performance_id=" + performance_id + "&checked=" + checked;

        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", url);

        xhttp.send();
    }

</script>