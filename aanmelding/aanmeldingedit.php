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

    if(isset($_GET['a_id'])){
        $aanmelding = $db->select("SELECT * FROM aanmelding WHERE a_id=:a_id",['a_id' => $_GET['a_id']]);
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $sql = "UPDATE aanmelding SET a_id=:a_id, t_id=:t_id, s_id=:s_id WHERE a_id=:a_id";
    
        $placeholder = [
            'a_id'=>$_POST['a_id'],
            't_id'=>$_POST['toernooi'],
            's_id'=>$_POST['school']
            
        ];

    $db->update_or_delete($sql, $placeholder, 'aanmeldingoverzicht.php');
    }
    $school = $db->select("SELECT s_id, s_naam FROM speler", []);
    $toernooi = $db->select("SELECT t_id, t_omschrijving FROM toernooi", []);


    ?>

<form action="" method="post">
<input type="hidden" name="a_id" value="<?php echo isset($_GET['a_id']) ? $_GET['a_id'] : '' ?>">
<?php if(is_array($school) && !empty($school)){?>
    <select name="school" required>
        <?php foreach($school as $scholen){?>
            <option value="<?php echo $scholen['s_id'];?>"><?php echo $scholen['s_naam'];?></option>
        <?php } ?>
        </select><br><br>
        <?php }else{ ?>
                <p class='geen'>Voeg eerst een speler toe</p>
        <?php } ?>
        <br>
        <?php if(is_array($toernooi) && !empty($toernooi)){?>
        <!-- name = toernooi moet naar de placeholder. Namen moet je vangen van de post en dit is hoe je dingen moet definen -->
    <select name="toernooi" required>
        <?php foreach($toernooi as $toernooien){?>
        <option value="<?php echo $toernooien['t_id'];?>"><?php echo $toernooien['t_omschrijving'];?></option>
        <?php } ?>
        </select><br><br>
        <?php }else{ ?>
                <p class='geen'>Voeg eerst een toernooi toe</p>
        <?php } ?>
        <br>
            
<input type="submit" value="Edit">
</form>
    
</body>
</html>