<?php
try{
    $pdo = new PDO(
        'mysql:dbname=kursverwaltung;host:localhost;charset=utf-8',
        'root', '');
} catch(PDOException $e){
    die("An error has occurred");
}
// this codeblock only runs if $stmt is not == false
if($stmt = $pdo->query("SELECT * FROM teilnehmer")) {
    $data = $stmt->fetchAll();
    echo "<pre>", print_r($data), "</pre>";
}
?>