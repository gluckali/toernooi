<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedstrijd edit</title>
</head>

<body>
    <?php
    include "../database/database.php";
    $db = new database;

    $wedstrijd_id = $_GET['wedstrijd_id'];

    if (isset($wedstrijd_id)) {
        $wedstrijden = $db->select(
            'SELECT 
            wedstrijden.w_id,
            CONCAT(speler1.s_naam, " ", speler1.s_tussenvoegsel, "", speler1.s_achternaam) AS "SpelerEen", 
            CONCAT(speler2.s_naam, " ", speler2.s_tussenvoegsel, "", speler2.s_achternaam) AS "SpelerTwee",
            wedstrijden.s_speler2id, 
            wedstrijden.s_speler1id,
            wedstrijden.w_ronde AS "Ronde", 
            toernooi.t_omschrijving AS "Toernooi", 
            toernooi.t_datum AS "Toernooi Datum",
            wedstrijden.w_score1 AS "ScoreSpelerEen",
            wedstrijden.w_score2 AS "ScoreSpelerTwee"
            FROM wedstrijden
            INNER JOIN speler speler1
            ON speler1.s_id = wedstrijden.s_speler1id
            INNER JOIN speler speler2
            ON speler2.s_id = wedstrijden.s_speler2id
            INNER JOIN toernooi
            ON toernooi.t_id = wedstrijden.t_id
            WHERE w_id=:wedstrijd_id',
            ['wedstrijd_id' => $wedstrijd_id]
        );

        $wedstrijd = $wedstrijden[0];

        $spelerEenId = $wedstrijd['s_speler1id'];
        $spelerTweeId = $wedstrijd['s_speler2id'];
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $spelerEenScore = $_POST['spelerEenScore'];
        $spelerTweeScore = $_POST['spelerTweeScore'];
        $winnaar_id = $spelerEenId;
        // If score 2 isn't higher than score 1, score 1 wins, if score 1 is below score 2, score 2 wins
        if ($spelerEenScore < $spelerTweeScore) {
            $winnaar_id = $spelerTweeId;
        }

        $sql = "UPDATE `wedstrijden` SET w_score1=:w_score1, w_score2=:w_score2, s_winnaarid=:winnaar_id WHERE w_id=:wedstrijd_id";

        $placeholder = [
            'w_score1'=>$spelerEenScore,
            'w_score2'=>$spelerTweeScore,
            'wedstrijd_id'=>$wedstrijd_id,
            'winnaar_id' => $winnaar_id 
        ];

        $db->update_or_delete($sql, $placeholder, 'wedstrijdoverzicht.php');
    }
    ?>

    <form action="" method="post">

        <div>
            <label>Speler Een:</label>
            <b>
                <?php echo $wedstrijd['SpelerEen'] ?>
            </b>
        </div>
        <div>
            <label>Speler Twee:</label>
            <b>
                <?php echo $wedstrijd['SpelerTwee'] ?>
            </b>
        </div>
        <div>
            <label>Ronde:</label>
            <b>
                <?php echo $wedstrijd['Ronde'] ?>
            </b>
        </div>
        <div>
            <label>Toernooi:</label>
            <b>
                <?php echo $wedstrijd['Toernooi'] ?>
            </b>
        </div>

        <h2>Wedstrijd uitslag</h2>
        <p>Hier kan je de wedstrijd uitslag wijzigen</p>

        <div>
            <label for="speler-een">Speler Een score</label>
            <input type="number" name="spelerEenScore" id="speler-een" min=0 required value=<?php echo $wedstrijd['ScoreSpelerEen'] ?>>
        </div>
        <br>
        <div>
            <label for="speler-twee">Speler Twee score</label>
            <input type="number" name="spelerTweeScore"  id="speler-twee" min=0 required value=<?php echo $wedstrijd['ScoreSpelerTwee'] ?>>
        </div>
        <br>


        <input type="submit" value="Wedstrijd bijwerken">
    </form>
</body>

</html>