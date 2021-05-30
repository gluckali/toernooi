<?php
    include "../database/database.php";
    $db = new database();

    if(isset($_GET['toernooi_id'])){ 
    $db->update_or_delete("DELETE FROM toernooi WHERE t_id = :toernooi_id", ['toernooi_id'=>$_GET['toernooi_id']], 'toernooioverzicht.php');
}
?>