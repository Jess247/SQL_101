<?php
try {
    $pdo = new PDO('mysql:dbname=kursverwaltung;host=127.0.0.1','root', '');
} catch(PDOException $e){
    die("There has been an error building a connection.");
}
?>

<!-- 
    <?php

// try {
//     $pdo = new PDO('mysql:dbname=kursverwaltung;host=localhost','root', '');
// } catch(PDOException $e){
//     echo $e->getMessage();
// }

// try {
//     $pdo = new PDO('mysql:dbname=kursverwaltung;host=localhost','root', '');
// } catch(PDOException $e){
//     echo "<pre>", print_r($e)"</pre>";
// }

?> 
-->

