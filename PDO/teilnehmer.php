<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teilnehmerliste ausgeben</title>
    <?php
        require_once("teilnehmer.class.php");
    ?>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
    require_once("navigation.inc.php");
?>
    <h1>Teilnehmer</h1>
    <div class="ausgabe">
    <?php
        // objekt der klasse teilnehemr instanziieren 
        $teilnehmer = new teilnehmer();
        $teilnehmer->lesenAlleDaten();
    ?>
    </div>
    <p>
        <a href="tbearbeiten.php" class="button">Neuen Teilnehmer anlegen</a>
        <a href="tsuchen.php" class="button">Teilnehmer Suchen</a>
    </p>
</body>
</html>