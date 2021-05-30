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

    if(isset($_GET['school_id'])){
        $school = $db->select("SELECT * FROM school WHERE sch_id=:school_id",['school_id' => $_GET['school_id']]);
    }
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $sql = "UPDATE school SET sch_naam=:sch_naam WHERE sch_id=:school_id";
    
        $placeholder = [
            'sch_naam'=>$_POST['sch_naam'],
            'school_id'=>$_POST['school_id']
        ];

    $db->update_or_delete($sql, $placeholder, 'schooloverzicht.php');
    }
    ?>
    

<form action="" method="post">
<input type="hidden" name="school_id" value="<?php echo isset($_GET['school_id']) ? $_GET['school_id'] : '' ?>">
<!-- ternary operator: https://www.codementor.io/@sayantinideb/ternary-operator-in-php-how-to-use-the-php-ternary-operator-x0ubd3po6 -->
<!-- 
activiteiten is een array met een index 9 (= Array ( [0] => Array ( [id] => 5 [activiteiten] => bloesem [prijs] => 5.95 ) )). 
value van de index is een array. Daarom moeten we van activiteiten de 0e index nemen ($activiteiten[0]). dat is: Array ( [id] => 5 [activiteiten] => bloesem [prijs] => 5.95 )
Van deze array kunnen wij alleen de values ophalen aan de hand van de keys. daarom doen we bijv $activiteiten[0]['prijs']. -->

<input type="text" name="sch_naam" placeholder="sch_naam" value="<?php echo isset($school) ? $school[0]['sch_naam'] : ''?>">
<input type="submit" value="Edit">
</form>
    
</body>
</html>