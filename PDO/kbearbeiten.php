<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teilnehmer bearbeiten</title>
    <?php 
        require_once("kurs.class.php");
    ?>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php 
    require_once("navigation.inc.php");
?>
<?php 
    $kurs = new kurs();

        if(isset($_POST["mode"])) {
            if($_POST["mode"] == "null") {
                $kurs->anlegen();
            } else {
                $kurs->bearbeiten();
            } 

            header( "Refresh:3; url=kurs.php" );
            echo 'You\'ll be redirected in about 3 secs. If not, click <a href="kurs.php">here</a>.'; 


        } else {
            ?>
            <div class="ausgabe">
            <?php 
            $tData = array();

            if (isset($_GET["kursnr"])) {
                $tData = $kurs->lesenDatensatz($_GET["kursnr"]);
                $kursnr = $_GET["kursnr"];
            ?>

            <form action="" method="post">
            <!-- hidden fields to check set mode eighter to null or kursnr -->
                <input type="hidden" id="mode" name="mode" value="<?php echo $kursnr; ?>" />
                <label for="kursnr">Kursnummer: </label>
                <input type="text" id="tnummer" name="kursnr" value="<?php echo $kursnr; ?>" disabled/>
                <br>
                <label for="name">Ressort: </label>
                <input type="text" id="ressort" name="ressort" value="<?php echo $tData['ressort']; ?>" />
                <br>
                <label for="titel">Titel: </label>
                <input type="text" id="titel" name="titel" value="<?php echo $tData['titel']; ?>" />
                <br>
                <label for="beschreibung">Beschreibung: </label>
                <input type="text" id="beschreibung" name="beschreibung" value="<?php echo $tData['beschreibung']; ?>" />
                <br>
                <label for="preis">Preis: </label>
                <input type="text" id="preis" name="preis" value="<?php echo $tData['preis']; ?>" />
                <p><input type="submit" value="Änderung speichern"></p>
            </form>
            <p>
            <a href="kloeschen.php?kursnr=<?php echo $kursnrkursnr; ?>">Kurs löschen</a>
            </p>
            <?php
            } else{
            ?>

<form action="" method="post">
                <input type="hidden" id="mode" name="mode" value="NULL" />
                <label for="kursnr">Kursnummer: </label>
                <input type="text" id="kursnr" name="kursnr" value="AUTO" disabled/>
                <br>
                <label for="ressort">Ressort: </label>
                <input type="text" id="ressort" name="ressort" value="" />
                <br>
                <label for="titel">Titel: </label>
                <input type="text" id="titel" name="titel" value="" />
                <br>
                <label for="beschreibung">Beschreibung: </label>
                <input type="text" id="beschreibung" name="beschreibung" value="" />
                <br>
                <label for="preis">Preis: </label>
                <input type="text" id="preis" name="preis" value="" />
                <p><input type="submit" value="Änderung speichern"></p>
                </form>
                <?php
            }
            ?>
            </div>
            <?php
        }
        ?>
</body>
</html>