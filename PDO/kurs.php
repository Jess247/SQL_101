<!DOCTYPE HTML>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Teilnehmerliste ausgeben</title>
<?php
    require_once("kurs.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<?php
    require_once("navigation.inc.php");
?>
<h1>Kurs</h1>
<div class="ausgabe">
<?php
    $teilnehmer = new kurs();
    $teilnehmer->lesenAlleDaten();
?>
</div>
<p>
	<a class="button" href="tbearbeiten.php">Neuen Teilnehmer anlegen</a> 
	<a class="button" href="tsuchen.php">Teilnehmer suchen</a>
</p>
</body>
</html>