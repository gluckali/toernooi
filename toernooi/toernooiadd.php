<?php 
include '../database/database.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){
    // request method is POST, daarna roep je alles wat je hebt in database en maak je het post $_post = naam van db
    $t_omschrijving = $_POST["t_omschrijving"]; 
    $t_datum = $_POST["t_datum"]; 

    // hierna ^ doe je een sql statement die je roept uit je database (ADD VAN DE CRUD)
    // ID is null, het is auto increment dus het changet automatically.

    $sql = "INSERT INTO `toernooi` (t_omschrijving, t_datum)
    VALUES 
    (:t_omschrijving, :t_datum)";
    // kijk altijd als je zelfde values hebt met :, same order, same location, 
    // als de code niet werkt haal de values beneden weg en laat het alleen boven zijn, dus de : moet weg.

    $placeholder = [
        't_omschrijving'=>$t_omschrijving,
        't_datum'=>$t_datum,
    ]; 
    // je maakt een new database 
    $db = new database();
    $db -> add($sql, $placeholder, 'toernooioverzicht.php');
}else{
    echo "You Need to Insert a school";
}
    ?>

<form action="" method="post">
<!-- ternary operator: https://www.codementor.io/@sayantinideb/ternary-operator-in-php-how-to-use-the-php-ternary-operator-x0ubd3po6 -->
<!-- 
medewerkers is een array met een index 9 (= Array ( [0] => Array ( [id] => 5 [medewerkers] => bloesem [prijs] => 5.95 ) )). 
value van de index is een array. Daarom moeten we van medewerkers de 0e index nemen ($medewerkers[0]). dat is: Array ( [id] => 5 [medewerkers] => bloesem [prijs] => 5.95 )
Van deze array kunnen wij alleen de values ophalen aan de hand van de keys. daarom doen we bijv $medewerkers[0]['prijs']. -->


<input type="text" name="t_omschrijving" placeholder="t_omschrijving" required> 
<input type="date" name="t_datum" placeholder="t_datum" required> 
<input type="submit" value="Add school">
</form>
    
</body>
</html>