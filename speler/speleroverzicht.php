<?php 
include '../database/database.php';

$db = new database();
$speler = $db->select("SELECT * FROM speler", []);

$columns = array_keys($speler[0]);
$row_data = array_values($speler);
?>

<table> 
    <tr>
    <?php 
        foreach($columns as $column){
            echo"<th> <strong> $column </strong> </th>";
        }
    ?>
    <th colspan="2"> action </th>
    <th> <a href="speleradd.php"> speler toevoegen </a></th>
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
                <a href="speleredit.php?s_id=<?php echo $rows['s_id']?>">edit</a>
                <a href="spelerdelete.php?s_id=<?php echo $rows['s_id']?>">delete</a>
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