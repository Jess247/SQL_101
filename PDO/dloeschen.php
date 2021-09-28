<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dozenten löschen</title>
    <?php
    require_once("dozenten.class.php");
    ?>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php 
    require_once("navigation.inc.php");
?>
<?php
    if(isset($_GET['doznr'])){
        $dozenten = new dozenten();
        $dozenten->loeschen($_GET["doznr"]);
        echo "<h2>dozenten erfolgreich gelöscht!</h2>";
    }

    header( "refresh:3; url=dozenten.php" );
    echo 'You\'ll be redirected in about 3 secs. If not, click <a href="dozenten.php">here</a>.'; 
?>
</body>
</html>