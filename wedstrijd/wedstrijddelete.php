<?php
    include "../database/database.php";
    $db = new database();

    if(isset($_GET['wedstrijd_id'])){ 
    $db->update_or_delete("DELETE FROM wedstrijden WHERE w_id = :wedstrijd_id", ['wedstrijd_id'=>$_GET['wedstrijd_id']], 'wedstrijdoverzicht.php');
}
?>