<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dozenten bearbeiten</title>
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
    $dozenten = new dozenten();

        if(isset($_POST["mode"])) {
            if($_POST["mode"] == "null") {
                $dozenten->anlegen();
            } else {
                $dozenten->bearbeiten();
            } 

            header( "Refresh:3; url=dozenten.php" );
            echo 'You\'ll be redirected in about 3 secs. If not, click <a href="dozenten.php">here</a>.'; 


        } else {
            ?>
            <div class="ausgabe">
            <?php 
            $tData = array();

            if (isset($_GET["doznr"])) {
                $tData = $dozenten->lesenDatensatz($_GET["doznr"]);
                $doznr = $_GET["doznr"];
            ?>

            <form action="" method="post">
            <!-- hidden fields to check set mode eighter to null or doznr -->
                <input type="hidden" id="mode" name="mode" value="<?php echo $doznr; ?>" />
                <label for="doznr">Dozentennummer: </label>
                <input type="text" id="doznr" name="doznr" value="<?php echo $doznr; ?>" disabled/>
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
            <a href="dloeschen.php?doznr=<?php echo $doznr; ?>">Dozenten löschen</a>
            </p>
            <?php
            } else{
            ?>

<form action="" method="post">
                <input type="hidden" id="mode" name="mode" value="NULL" />
                <label for="doznr">Dozentennummer: </label>
                <input type="text" id="doznr" name="doznr" value="AUTO" disabled/>
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