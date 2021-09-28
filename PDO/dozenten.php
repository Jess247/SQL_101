<!DOCTYPE HTML>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Dozentenliste ausgeben</title>
<?php
    require_once("dozenten.class.php");
?>
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<?php
    require_once("navigation.inc.php");
?>
<h1>Teilnehmer</h1>
<div class="ausgabe">
<?php
    $teilnehmer = new dozenten();
    $teilnehmer->lesenAlleDaten();
?>
</div>
<p>
	<a class="button" href="dbearbeiten.php">Neuen Dozenten anlegen</a> 
	<a class="button" href="dsuchen.php">Dozenten suchen</a>
</p>
</body>
</html>