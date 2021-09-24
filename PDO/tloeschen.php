<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teilnehmer löschen</title>
    <?php
    require_once("teilnehmer.class.php");
    ?>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php 
    require_once("navigation.inc.php");
?>
<?php
    if(isset($_GET['tnummer'])){
        $teilnehmer = new teilnehmer();
        $teilnehmer->loeschen($_GET["tnummer"]);
        echo "<h2>Teilnehmer erfolgreich gelöscht!</h2>";
    }
    header("refresh:3;url=teilnehmer.php");
?>
</body>
</html>