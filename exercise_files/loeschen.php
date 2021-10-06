<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel löschen</title>
    <?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require("artikel_loeschen.php");
    ?>
</head>
<body>
<?php
    if(isset($_GET['anr'])){
        $deletArt = new artikel;
        $deletArt->delete($_GET["anr"]);
        echo "<h2>Artikel erfolgreich gelöscht!</h2>";
    } else {
        echo "<h2>Artikel konnte gelöscht werden!</h2>";
    }

    echo 'You\'ll be redirected in about 3 secs. If not, click <a href="artikel_loeschen.php">here</a>.'; 
?>
</body>
</html>