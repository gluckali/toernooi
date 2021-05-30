<?php 
include '../database/database.php';

$db = new database();
$aanmelding = $db->select("SELECT aanmelding.a_id, speler.s_naam, toernooi.t_omschrijving
from aanmelding
inner JOIN speler
ON speler.s_id = aanmelding.s_id
INNER JOIN toernooi
on toernooi.t_id = aanmelding.t_id", []);

if(is_array($aanmelding) && !empty($aanmelding)){ 
$columns = array_keys($aanmelding[0]);
$row_data = array_values($aanmelding);
?>

<table> 
    <tr>
    <?php 
        foreach($columns as $column){
            echo"<th> <strong> $column </strong> </th>";
        }
    ?>
    <th colspan="2"> action </th>
    </tr>
    <th colspan="3"> </th>
    <?php 
        foreach($row_data as $rows){ 
            echo "<tr>";
                foreach($rows as $poopie){ 
                    echo "<td>$poopie</td>";
                }       
    ?>
            <td>
            <a href="aanmeldingedit.php?a_id=<?php echo $rows['a_id']?>">edit</a>
            <a href="aanmeldingdelete.php?a_id=<?php echo $rows['a_id']?>">delete</a>
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
    } // add button
    
    ?>
    <button>
    <a href="aanmeldingadd.php">add</a>
    </button>
    
<!-- 
SELECT aanmelding.s_id, aanmelding.t_id, speler.s_id, speler.s_naam, speler.s_achternaam, toernooi.t_datum, toernooi.t_id 
FROM aanmelding
INNER JOIN speler
ON aanmelding.s_id = speler.s_id
INNER JOIN toernooi
ON toernooi.t_id = aanmelding.t_id 
-->