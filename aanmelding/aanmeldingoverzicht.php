<?php
include '../database/database.php';
include '../styles.php';

$db = new database();
$aanmelding = $db->select("SELECT aanmelding.a_id, speler.s_naam, toernooi.t_omschrijving
from aanmelding
inner JOIN speler
ON speler.s_id = aanmelding.s_id
INNER JOIN toernooi
on toernooi.t_id = aanmelding.t_id", []);

if (is_array($aanmelding) && !empty($aanmelding)) {
    $columns = array_keys($aanmelding[0]);
    $row_data = array_values($aanmelding);
?>

    <h1>Aanmeldingen</h1>

    <table>
        <tr>
            <?php
            foreach ($columns as $column) {
                echo "<th> <strong> $column </strong> </th>";
            }
            ?>
            <th colspan="2"> <a href="aanmeldingadd.php">Add</a> </th>
        </tr>
        <?php
        foreach ($row_data as $rows) {
            echo "<tr>";
            foreach ($rows as $poopie) {
                echo "<td>$poopie</td>";
            }
        ?>
            <td>
                <a href="aanmeldingedit.php?a_id=<?php echo $rows['a_id'] ?>">Edit</a>
                <a href="aanmeldingdelete.php?a_id=<?php echo $rows['a_id'] ?>">Delete</a>
            </td>
            </tr>
        <?php } ?>
        <form action='aanmeldingoverzicht.php' method='POST'>
            <!-- <input type='submit' name='export' value='Export to excel file' /> -->
        </form>
    </table>
<?php
} else {
    echo "no data available";
}
?>