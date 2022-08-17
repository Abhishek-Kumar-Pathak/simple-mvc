
<?php
    
    echo "<a href='/?action=add-data'>Add New</a>";

    $db = new database();
    $res = $db->getAllData();

?>

<table cellpadding="10px" cellspacing="10px">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Languages</th>
        <th>Profession</th>
        <th>Date</th>
        <th>Image</th>
        <th>Action</th>
    </tr>

    
    <?php 
        foreach($res as $r){
            echo "<tr>";

            echo "<td>" . $r['id'] . "</td>";
            echo "<td>" . $r['name'] . "</td>";
            echo "<td>" . $r['email'] . "</td>";
            echo "<td>" . $r['gender'] . "</td>";
            echo "<td>" . $r['language'] . "</td>";
            echo "<td>" . $r['status'] . "</td>";
            echo "<td>" . $r['date'] . "</td>";
            echo "<td>" . "<img src='profiles/". $r['profile']."' style='width:100px;height:100px'>". "</td>";
            echo "<td>" . 
            "<a href='/?action=update-data&id=".$r['id']."'>Edit</a>
            <a href='/?action=delete-data&id=".$r['id']."'>Delete</a>".
            "</td>";

            echo "</tr>";
        }
    ?>
    </tr>
</table>