<?php
include '../database/database.php';
include '../styles.php';

$db = new database();
$wedstrijden = $db->select('SELECT 
wedstrijden.w_id,
CONCAT(speler1.s_naam, " ", speler1.s_tussenvoegsel, "", speler1.s_achternaam) AS "Speler Een", 
CONCAT(speler2.s_naam, " ", speler2.s_tussenvoegsel, "", speler2.s_achternaam) AS "Speler Twee",
CONCAT(winnaar.s_naam, " ", winnaar.s_tussenvoegsel, "", winnaar.s_achternaam) AS "Winnaar",
wedstrijden.w_ronde AS "Ronde", 
toernooi.t_omschrijving AS "Toernooi", 
toernooi.t_datum AS "Toernooi Datum",
wedstrijden.w_score1 AS "Score Speler 1",
wedstrijden.w_score2 AS "Score Speler 2"
FROM wedstrijden
INNER JOIN speler speler1
ON speler1.s_id = wedstrijden.s_speler1id
INNER JOIN speler speler2
ON speler2.s_id = wedstrijden.s_speler2id
LEFT JOIN speler winnaar
ON winnaar.s_id = wedstrijden.s_winnaarid
INNER JOIN toernooi
ON toernooi.t_id = wedstrijden.t_id
', []);

$columns = array_keys($wedstrijden[0]);
$wedstrijdenValues = array_values($wedstrijden);

?>

<h2>Wedstrijden</h2>

<table>
    <tr>
        <?php
        foreach ($columns as $column) {
            echo "<th> <strong> $column </strong> </th>";
        }
        ?>
        <th> <a href="wedstrijdadd.php"> Add wedstrijd </a></th>
    </tr>
    <?php
    foreach ($wedstrijdenValues as $wedstrijdColumns) {
        echo "<tr>";
        foreach ($wedstrijdColumns as $wedstrijdColumn) {
            echo "<td>$wedstrijdColumn</td>";
        }
    ?>
        <td>
            <a href="wedstrijdedit.php?wedstrijd_id=<?php echo $wedstrijdColumns['w_id'] ?>">Edit</a>
            <a href="wedstrijddelete.php?wedstrijd_id=<?php echo $wedstrijdColumns['w_id'] ?>">Delete</a>
        </td>
        </tr>
    <?php } ?>
    <form action='schooloverzicht.php' method='POST'>
        <!-- <input type='submit' name='export' value='Export to excel file' /> -->
    </form>
</table>


