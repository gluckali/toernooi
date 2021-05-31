<?php
include '../database/database.php';
include '../styles.php';

$db = new database();
$toernooi = $db->select("SELECT t_id, t_omschrijving AS omschrijving, t_datum as datum FROM toernooi", []);

$columns = array_keys($toernooi[0]);
$row_data = array_values($toernooi);
?>

<h1>Toernooien</h1>

<table>
    <tr>
        <?php
        foreach ($columns as $column) {
            echo "<th> <strong> $column </strong> </th>";
        }
        ?>
        <th> <a href="toernooiadd.php">Add toernooi</a></th>
    </tr>
    <?php
    foreach ($row_data as $rows) {
        echo "<tr>";
        foreach ($rows as $poopie) {
            echo "<td>$poopie</td>";
        }
    ?>
        <td>
            <a href="toernooiedit.php?toernooi_id=<?php echo $rows['t_id'] ?>">Edit</a>
            <a href="toernooidelete.php?toernooi_id=<?php echo $rows['t_id'] ?>">Delete</a>
        </td>
        </tr>
    <?php } ?>
    <form action='toernooioverzicht.php' method='POST'>
    </form>
</table>
</body>

</html>