<?php
include '../database/database.php';
$db = new database();
// je maakt een new database 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // request method is POST, daarna roep je alles wat je hebt in database en maak je het post $_post = naam van db
    $t_omschrijving = $_POST["t_omschrijving"];
    $s_naam = $_POST["s_naam"];

    // hierna ^ doe je een sql statement die je roept uit je database (ADD VAN DE CRUD)
    // ID is null, het is auto increment dus het changet automatically.

    $sql = "INSERT INTO `aanmelding` 
    VALUES 
    (NULL,:t_omschrijving, :s_naam)";
    // kijk altijd als je zelfde values hebt met :, same order, same location, 
    // als de code niet werkt haal de values beneden weg en laat het alleen boven zijn, dus de : moet weg.

    $placeholder = [
        't_omschrijving' => $t_omschrijving,
        's_naam' => $s_naam
    ];

    $db->add($sql, $placeholder, 'aanmeldingoverzicht.php');
} else {
    // echo "Request method not POST";
}

$speler = $db->select("SELECT s_id, s_naam FROM speler", []);
$toernooi = $db->select("SELECT t_id, t_omschrijving FROM toernooi", []);

?>

<h1>Aanmelding toevoegen</h1>

<form action="" method="post">
    <!-- ternary operator: https://www.codementor.io/@sayantinideb/ternary-operator-in-php-how-to-use-the-php-ternary-operator-x0ubd3po6 -->
    <!-- 
medewerkers is een array met een index 9 (= Array ( [0] => Array ( [id] => 5 [medewerkers] => bloesem [prijs] => 5.95 ) )). 
value van de index is een array. Daarom moeten we van medewerkers de 0e index nemen ($medewerkers[0]). dat is: Array ( [id] => 5 [medewerkers] => bloesem [prijs] => 5.95 )
Van deze array kunnen wij alleen de values ophalen aan de hand van de keys. daarom doen we bijv $medewerkers[0]['prijs']. -->


    <select name="s_naam">
        <?php foreach ($speler as $data) { ?>
            <option value="<?php echo $data['s_id'] ?>">
                <?php echo $data['s_naam'] ?>
            </option>
        <?php } ?>
    </select>
    <select name="t_omschrijving">
        <?php foreach ($toernooi as $data) { ?>
            <option value="<?php echo $data['t_id'] ?>">
                <?php echo $data['t_omschrijving'] ?>
            </option>
        <?php } ?>
    </select>
    <input type="submit" value="Add Aanmelding">
</form>

</body>

</html>