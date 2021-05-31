<?php
include '../database/database.php';
// Make new database instance to add a 'wedstrijd' row
$db = new database();

// We will only run this code if the form has been submitted, which will cause REQUEST_METHOD to equal 'POST'
//
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    error_log("post..");
    // We will take the following 3 values from the form
    // 1 - 'toernooi' id, this will be an existing toernooi that the user can select
    // 2- 'speler_een_id' this will be a player which the user will select.
    // 3- 'speler_twee_id' this will be a player which the user will select.
    // we will make sure the user can only select unique players to ensure a player cannot play against themselves.
    //  
    $toernooi_id = $_POST['toernooi_id'];
    $speler_een_id = $_POST['speler_een_id'];
    $speler_twee_id = $_POST['speler_twee_id'];

    // SQL statement with the fields obtained from the form
    $sql = "INSERT INTO 
        `wedstrijden`
        (t_id, s_speler1id, s_speler2id, w_ronde, s_winnaarid, w_score1, w_score2 )
        VALUES (:toernooi_id, :speler_een_id, :speler_twee_id, :ronde_nummer, NULL, 0, 0 )
    ";

    // We will use this in the SQL prepare statement in the database class
    $placeholder = [
        'toernooi_id' => $toernooi_id,
        'speler_een_id' => $speler_een_id,
        'speler_twee_id' => $speler_twee_id,
        'ronde_nummer' => 1
    ];

    // Finally combine the SQL query with the placeholders obtained from the form and redirect to the 'wedstrijdoverzicht' page
    $db->add($sql, $placeholder, 'wedstrijdoverzicht.php');
}

$spelers = $db->select("SELECT s_id, s_naam FROM speler", []);
$toernooien = $db->select("SELECT t_id, t_omschrijving FROM toernooi", []);

$spelersEenDropDown = [];
$spelerTweeDropDown = [];

foreach ($spelers as $key => $speler) {
    if ($key % 2 == 0) {
        array_push($spelersEenDropDown, $speler);
    } else {
        array_push($spelerTweeDropDown, $speler);
    }
}

?>

<h1>Wedstrijd toevoegen</h1>

<form action="" method="post">
    <label for="speler_een_id">Speler #1</label>
    <select name="speler_een_id">
        <?php foreach ($spelersEenDropDown as $speler) { ?>
            <option value="<?php echo $speler['s_id'] ?>">
                <?php echo $speler['s_naam'] ?>
            </option>
        <?php } ?>
    </select>
    <br>
    <br>
    <label for="speler_twee_id">Speler #2</label>
    <select name="speler_twee_id">
        <?php foreach ($spelerTweeDropDown as $speler) { ?>
            <option value="<?php echo $speler['s_id'] ?>">
                <?php echo $speler['s_naam'] ?>
            </option>
        <?php } ?>
    </select>
    <br>
    <br>
    <label for="toernooi_id">Toernooi</label>
    <select name="toernooi_id">
        <?php foreach ($toernooien as $toernooi) { ?>
            <option value="<?php echo $toernooi['t_id'] ?>">
                <?php echo $toernooi['t_omschrijving'] ?>
            </option>
        <?php } ?>
    </select>
    <br>
    <br>
    <input type="submit" value="Voeg wedstrijd toe">
</form>