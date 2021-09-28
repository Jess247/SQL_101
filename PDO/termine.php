<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Termine ausgeben</title>
    <?php
        require_once("termine.class.php");
    ?>
</head>
<body>
    <?php
    // navigation file
        require_once("navigation.inc.php");
    ?>
    <h1>Termine</h1>
    <div class="ausgabe">
    <?php
        $termine = new termine();
        $termine->lesenAlleDaten();
    ?>
    </div>
    <p><a class="button" href="termbearbeiten.php">Neue Termine anlegen</a></p>
</body>
</html>