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

    if(isset($_GET['s_id'])){
        $speler = $db->select("SELECT * FROM speler WHERE s_id=:s_id",['s_id' => $_GET['s_id']]);
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $sql = "UPDATE speler SET s_id=:s_id, sch_id=:sch_id, s_naam=:s_naam, s_tussenvoegsel=:s_tussenvoegsel, s_achternaam=:s_achternaam  WHERE s_id=:s_id";
    
        $placeholder = [
            's_naam'=>$_POST['s_naam'],
            's_tussenvoegsel'=>$_POST['s_tussenvoegsel'],
            's_achternaam'=>$_POST['s_achternaam'],
            's_id'=>$_POST['s_id'],
            'sch_id'=>$_POST['sch_id']
        ];

    $db->update_or_delete($sql, $placeholder, 'speleroverzicht.php');
    }
    $scholen = $db->select("SELECT * FROM school", []);
    ?>    

    
<!-- ternary operator: https://www.codementor.io/@sayantinideb/ternary-operator-in-php-how-to-use-the-php-ternary-operator-x0ubd3po6 -->
<!-- 
activiteiten is een array met een index 9 (= Array ( [0] => Array ( [id] => 5 [activiteiten] => bloesem [prijs] => 5.95 ) )). 
value van de index is een array. Daarom moeten we van activiteiten de 0e index nemen ($activiteiten[0]). dat is: Array ( [id] => 5 [activiteiten] => bloesem [prijs] => 5.95 )
Van deze array kunnen wij alleen de values ophalen aan de hand van de keys. daarom doen we bijv $activiteiten[0]['prijs']. -->

<form action="" method="post">
<input type="hidden" name="s_id" value="<?php echo isset($_GET['s_id']) ? $_GET['s_id'] : '' ?>">
<input type="text" name="s_naam" placeholder="s_naam" value="<?php echo isset($speler) ? $speler[0]['s_naam'] : ''?>">
<input type="text" name="s_tussenvoegsel" placeholder="s_tussenvoegsel" value="<?php echo isset($speler) ? $speler[0]['s_tussenvoegsel'] : ''?>">
<input type="text" name="s_achternaam" placeholder="s_achternaam" value="<?php echo isset($speler) ? $speler[0]['s_achternaam'] : ''?>">

<?php if(is_array($scholen) && !empty($scholen)){?>
            <select name="sch_id" required>
                <?php foreach($scholen as $school){?>
                    <option value="<?php echo $school['sch_id'];?>"><?php echo $school['sch_naam'];?></option>
                <?php } ?>
            </select><br><br>
            <?php }else{ ?>
                    <p class='geen'>Voeg eerst een schaakvereniging toe</p>
            <?php } ?>
<input type="submit" value="Edit">
</form>