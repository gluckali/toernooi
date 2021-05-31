<?php 
include '../database/database.php';
include '../styles.php';

$db = new database();
$speler = $db->select("SELECT * FROM speler", []);

$columns = array_keys($speler[0]);
$row_data = array_values($speler);
?>

<h1>Spelers overzicht</h1>

<table> 
    <tr>
    <?php 
        foreach($columns as $column){
            echo"<th> <strong> $column </strong> </th>";
        }
    ?>
    <th> <a href="speleradd.php"> Speler Toevoegen </a></th>
    </tr>
    <?php 
        foreach($row_data as $rows){ 
            echo "<tr>";
                foreach($rows as $poopie){ 
                    echo "<td>$poopie</td>";
                }       
                ?>
                <td>
                <a href="speleredit.php?s_id=<?php echo $rows['s_id']?>">Edit</a>
                <a href="spelerdelete.php?s_id=<?php echo $rows['s_id']?>">Delete</a>
                </td>
                </tr>
            <?php } ?>
            <form action='speleroverzicht.php' method='POST'>
        <!-- <input type='submit' name='export' value='Export to excel file' /> -->
    </form>
    </table>   

    <!-- SELECT speler.s_id, speler.sch_id, speler.s_naam, speler.s_tussenvoegsel, school.sch_naam
from speler
inner join school
ON school.sch_id = speler.sch_id

 -->