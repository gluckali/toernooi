<?php
    include "../database/database.php";
    $db = new database();

    if(isset($_GET['s_id'])){ 
    $db->update_or_delete("DELETE FROM speler WHERE s_id = :s_id", ['s_id'=>$_GET['s_id']], 'speleroverzicht.php');
}
?>