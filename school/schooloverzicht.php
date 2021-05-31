<?php
include '../database/database.php';
include '../styles.php';

$db = new database();
$activiteit = $db->select("SELECT * FROM school", []);

$columns = array_keys($activiteit[0]);
$row_data = array_values($activiteit);
?>

<h1>Scholen</h1>

<table>
    <tr>
        <?php
        foreach ($columns as $column) {
            echo "<th> <strong> $column </strong> </th>";
        }
        ?>
        <th> <a href="schooladd.php"> Add School </a></th>
    </tr>

    <?php
    foreach ($row_data as $rows) {
        echo "<tr>";
        foreach ($rows as $poopie) {
            echo "<td>$poopie</td>";
        }
    ?>
        <td>
            <a href="schooledit.php?school_id=<?php echo $rows['sch_id'] ?>">edit</a>
            <a href="schooldelete.php?school_id=<?php echo $rows['sch_id'] ?>">delete</a>
        </td>
        </tr>
    <?php } ?>
    <form action='schooloverzicht.php' method='POST'>
        <!-- <input type='submit' name='export' value='Export to excel file' /> -->
    </form>
</table>