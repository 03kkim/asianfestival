<?php
create_header("");
?>
<table>
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
                <td><?php echo $request["performance_name"]?></td>
                <td></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
