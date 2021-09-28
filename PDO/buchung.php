<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Buchung ausgeben</title>
    <?php
        require_once("buchung.class.php");
    ?>
</head>
<body>
    <?php
    // navigation file
        require_once("navigation.inc.php");
    ?>
    <h1>Buchungen</h1>
    <div class="ausgabe">
    <?php
        $buchung = new buchung();
        $buchung->lesenAlleDaten();
    ?>
    </div>
    <p><a class="button" href="bbearbeiten.php">Neue Buchung anlegen</a></p>
</body>
</html>