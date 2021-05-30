<?php
    include "../database/database.php";
    $db = new database();

    if(isset($_GET['a_id'])){ 
    $db->update_or_delete("DELETE FROM aanmelding WHERE a_id = :a_id", ['a_id'=>$_GET['a_id']], 'aanmeldingoverzicht.php');
}
?>