<?php
    include "../database/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ADD</title>
</head>
<body>
    <?php
        $db = new database();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $s_naam = $_POST['s_naam'];
            $s_tussenvoegsel = $_POST['s_tussenvoegsel'];
            $s_achternaam = $_POST['s_achternaam'];
            $naam = $_POST['naam'];

            $sql = "INSERT INTO speler VALUES(NULL,:naam, :s_naam , :s_tussenvoegsel, :s_achternaam)";
            $placeholder = [
                's_naam'=>$s_naam,
                's_tussenvoegsel'=>$s_tussenvoegsel,
                's_achternaam'=>$s_achternaam,
                'naam'=>$naam,
            ];
            // inserts the data you submitted to the database and the speleroverzicht (location) shows it.
            $db->add($sql,$placeholder,"speleroverzicht.php");
        }
        $school = $db->select("SELECT sch_id, sch_naam FROM school", []);
    ?>
    <form action="" method="post">
    
        <input type="text" name="s_naam" placeholder="s_naam" required> 
        <input type="text" name="s_tussenvoegsel" placeholder="s_tussenvoegsel" > 
        <input type="text" name="s_achternaam" placeholder="s_achternaam" required> 
        <label for="school">school</label>
        <select name="naam">
            <?php foreach($school as $data){ ?>
                <option value="<?php echo $data['sch_id']?>">
                    <?php echo $data['sch_naam'] ?>
                </option>
            <?php } ?>
        </select> 
        <input type="submit" value="Add speler">
    </form>
</body>
</html>