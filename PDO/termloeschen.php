<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="utf-8" />
	<title>Termin löschen</title>
<?php
    require_once("termine.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>

<?php
    require_once("navigation.inc.php");

    if(isset($_GET["termnr"])) {
    $termin = new termine();
    $termin -> loeschen($_GET["termnr"]);
    echo "<h2>Termin gelöscht</h2>";
    }
    header("refresh:3; url=termine.php");
?>

</body>
</html>
