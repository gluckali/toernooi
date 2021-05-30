<?php 
include '../database/database.php';

$db = new database();
$toernooi = $db->select("SELECT * FROM toernooi", []);

$columns = array_keys($toernooi[0]);
$row_data = array_values($toernooi);
?>

<table> 
    <tr>
    <?php 
        foreach($columns as $column){
            echo"<th> <strong> $column </strong> </th>";
        }
    ?>
    <th colspan="2"> action </th>
    <th> <a href="toernooiadd.php"> add toernooi </a></th>
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
                    <a href="toernooiedit.php?toernooi_id=<?php echo $rows['t_id']?>">edit</a>
                    <a href="toernooidelete.php?toernooi_id=<?php echo $rows['t_id']?>">delete</a>
                    </td>
                    </tr>
                <?php } ?>
                <form action='toernooioverzicht.php' method='POST'>
            <!-- <input type='submit' name='export' value='Export to excel file' /> -->
        </form>
        </table>   
    </body>
</html>

<!-- // if(isset($_POST['export'])){
//     $filename = "user_data_export.xls";
//     header("Content-Type: application/vnd.ms-excel");
//     header("Content-Disposition: attachment; filename=\"$filename\"");
//     $print_header = false;
//     // excel
//     $medewerker = $db->excel(NULL);
//     if(!empty($medewerker)){
//         foreach($medewerker as $row){
//             if(!$print_header){
//                 echo implode("\t", array_keys($row)) ."\n";
//                 $print_header=true;

//             }
//             echo implode("\t", array_values($row)) ."\n";
//         }
//     }
//     exit;
// } -->