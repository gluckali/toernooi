<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toernooi edit</title>
</head>

<body>
    <?php
    include "../database/database.php";
    $db = new database;

    if (isset($_GET['toernooi_id'])) {
        $school = $db->select("SELECT * FROM toernooi WHERE t_id=:toernooi_id", ['toernooi_id' => $_GET['toernooi_id']]);
    }
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $sql = "UPDATE toernooi SET t_omschrijving=:t_omschrijving, t_datum=:t_datum WHERE t_id=:toernooi_id";

        $placeholder = [
            't_omschrijving' => $_POST['t_omschrijving'],
            't_datum' => $_POST['t_datum'],
            'toernooi_id' => $_GET['toernooi_id']
        ];

        $db->update_or_delete($sql, $placeholder, 'toernooioverzicht.php');
    }
    ?>

    <form action="" method="post">
        <div>
            <label>Omschrijving</label>
            <input type="text" name="t_omschrijving" placeholder="t_omschrijving" value="<?php echo isset($school) ? $school[0]['t_omschrijving'] : '' ?>">
        </div>
        <br>
        <div>
            <label>Datum</label>
            <input type="date" name="t_datum" placeholder="t_datum" value="<?php echo isset($school) ? $school[0]['t_datum'] : '' ?>">
        </div>

        <input type="submit" value="Edit">
    </form>

    <?php
        $aanmeldingen = $db->select("SELECT * FROM aanmelding WHERE t_id=:toernooi_id", ['toernooi_id' => $_GET['toernooi_id']]);

        // de hoeveelheid aanmeldingen die nodig is om naar de volgende ronde te gaan 
        //
        $requiredWinnersForNextRound = count($aanmeldingen) / 2;

        // get 

        $wedstrijden = $db->select('SELECT * FROM wedstrijden
        WHERE s_winnaarid IS NOT NULL AND t_id = :toernooi_id
        ', ['toernooi_id' => $_GET['toernooi_id']]);

        $totalPlayedMatches = count($wedstrijden);

        echo $totalPlayedMatches;

        if ($totalPlayedMatches == $requiredWinnersForNextRound ) {
            // Render button that will go to the next round
        } else {
            // Render text that we cannot go to the next round yet
            echo 'Je kan alleen naar de volgende ronde als er ' . $requiredWinnersForNextRound . ' wedstrijden zijn gespeeld.';
        }
    ?>

</body>

</html>