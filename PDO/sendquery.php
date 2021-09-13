<?php
try{
    $pdo = new PDO(
        'mysql:dbname=test;host:127.0.0.1;charset=utf8',
        'root', '');
} catch(PDOException $e){
    echo $e->getMessage();
    die("An error has occurred");
}
// this codeblock only runs if $stmt is not == false
if($stmt = $pdo->query("SELECT * FROM teilnehmer")) {
    $data = $stmt->fetchAll();
    echo "<pre>", print_r($data), "</pre>";
}
?>