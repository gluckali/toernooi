<?php
    include "../database/database.php";
    $db = new database();

    if(isset($_GET['school_id'])){ 
    $db->update_or_delete("DELETE FROM school WHERE sch_id = :school_id", ['school_id'=>$_GET['school_id']], 'schooloverzicht.php');
}
?>