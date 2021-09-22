<?php
try {
    $pdo = new PDO(
        'mysql:dbname=kursverwaltung;host=127.0.0.1;charset=utf8', 
        'root', '');
} catch(PDOException $e) {
    die($e->getMessage());
}
?>