<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teilnehmer bearbeiten</title>
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
    $teilnehmer = new teilnehmer();

        if(isset($_POST["mode"])) {
            if($_POST["mode"] == "null") {
                $teilnehmer->anlegen();
            } else {
                $teilnehmer->bearbeiten();
            } 

            header( "Refresh:3; url=teilnehmer.php" );
            echo 'You\'ll be redirected in about 3 secs. If not, click <a href="teilnehmer.php">here</a>.'; 


        } else {
            ?>
            <div class="ausgabe">
            <?php 
            $tData = array();

            if (isset($_GET["tnummer"])) {
                $tData = $teilnehmer->lesenDatensatz($_GET["tnummer"]);
                $tnummer = $_GET["tnummer"];
            ?>

            <form action="" method="post">
            <!-- hidden fields to check set mode eighter to null or tnummer -->
                <input type="hidden" id="mode" name="mode" value="<?php echo $tnummer; ?>" />
                <label for="tnummer">Teilnehmernummer: </label>
                <input type="text" id="tnummer" name="tnummer" value="<?php echo $tnummer; ?>" disabled/>
                <br>
                <label for="name">Name: </label>
                <input type="text" id="name" name="name" value="<?php echo $tData['name']; ?>" />
                <br>
                <label for="vname">Vorname: </label>
                <input type="text" id="vname" name="vname" value="<?php echo $tData['vname']; ?>" />
                <br>
                <label for="plz">Postleitzahl: </label>
                <input type="text" id="plz" name="plz" value="<?php echo $tData['plz']; ?>" />
                <br>
                <label for="ort">Ort: </label>
                <input type="text" id="ort" name="ort" value="<?php echo $tData['ort']; ?>" />
                <br>
                <label for="strasse">Straße: </label>
                <input type="text" id="strasse" name="strasse" value="<?php echo $tData['strasse']; ?>" />
                <br>
                <label for="hausnr">Hausnummer: </label>
                <input type="text" id="hausnr" name="hausnr" value="<?php echo $tData['hausnr']; ?>" />
                <br>
                <label for="telefon1">Telefon1: </label>
                <input type="text" id="telefon1" name="telefon1" value="<?php echo $tData['telefon1']; ?>" />
                <br>
                <label for="telefon2">Telefon2: </label>
                <input type="text" id="telefon2" name="telefon2" value="<?php echo $tData['telefon2']; ?>" />
                <br>
                <label for="email">Emailadresse: </label>
                <input type="text" id="email" name="email" value="<?php echo $tData['email']; ?>" />
                <p><input type="submit" value="Änderung speichern"></p>
            </form>
            <p>
            <a href="tloeschen.php?tnummer=<?php echo $tnummer; ?>">Teilnehmer löschen</a>
            </p>
            <?php
            } else{
            ?>

<form action="" method="post">
                <input type="hidden" id="mode" name="mode" value="NULL" />
                <label for="tnummer">Teilnehmernummer: </label>
                <input type="text" id="tnummer" name="tnummer" value="AUTO" disabled/>
                <br>
                <label for="name">Name: </label>
                <input type="text" id="name" name="name" value="" />
                <br>
                <label for="vname">Vorname: </label>
                <input type="text" id="vname" name="vname" value="" />
                <br>
                <label for="plz">Postleitzahl: </label>
                <input type="text" id="plz" name="plz" value="" />
                <br>
                <label for="ort">Ort: </label>
                <input type="text" id="ort" name="ort" value="" />
                <br>
                <label for="strasse">Straße: </label>
                <input type="text" id="strasse" name="strasse" value="" />
                <br>
                <label for="hausnr">Hausnummer: </label>
                <input type="text" id="hausnr" name="hausnr" value="" />
                <br>
                <label for="telefon1">Telefon1: </label>
                <input type="text" id="telefon1" name="telefon1" value="" />
                <br>
                <label for="telefon2">Telefon2: </label>
                <input type="text" id="telefon2" name="telefon2" value="" />
                <br>
                <label for="email">Emailadresse: </label>
                <input type="text" id="email" name="email" value="" />
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