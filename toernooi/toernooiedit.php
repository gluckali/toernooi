<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include "../database/database.php";
    $db = new database;

    if(isset($_GET['toernooi_id'])){
        $school = $db->select("SELECT * FROM toernooi WHERE t_id=:toernooi_id",['toernooi_id' => $_GET['toernooi_id']]);
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $sql = "UPDATE toernooi SET t_omschrijving=:t_omschrijving, t_datum=:t_datum WHERE t_id=:toernooi_id";
    
        $placeholder = [
            't_omschrijving'=>$_POST['t_omschrijving'],
            't_datum'=>$_POST['t_datum'],
            'toernooi_id'=>$_POST['toernooi_id']
        ];

    $db->update_or_delete($sql, $placeholder, 'toernooioverzicht.php');
    }
    ?>

<form action="" method="post">
<input type="hidden" name="toernooi_id" value="<?php echo isset($_GET['toernooi_id']) ? $_GET['toernooi_id'] : '' ?>">

<input type="text" name="t_omschrijving" placeholder="t_omschrijving" value="<?php echo isset($school) ? $school[0]['t_omschrijving'] : ''?>">
<input type="date" name="t_datum" placeholder="t_datum" value="<?php echo isset($school) ? $school[0]['t_datum'] : ''?>">
<input type="submit" value="Edit">
</form>
    
</body>
</html>