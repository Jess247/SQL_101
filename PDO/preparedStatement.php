<?php
try{
    $pdo = new PDO(
        'mysql:dbname=kursverwaltung;host=127.0.0.1;charset=utf8',
        'root', '');
} catch(PDOException $e){
    echo $e->getMessage();
    echo "<pre>",print_r($e),"</pre>";
}


$tnummer = 5;

// Prepared statement with known parameter and parameter binding
$sql = "SELECT * FROM teilnehmer WHERE tnummer= :tnummer";
if($stmt = $pdo->prepare($sql)) {
    $stmt->bindParam(':tnummer', $tnummer);
    $stmt->execute();
    while($zeile = $stmt->fetch()){
        echo "Teilnehmernummer: ".$zeile['tnummer']."<br/>";
        echo "Name: ".$zeile['name']."<br/>";
        echo "Vorname: ".$zeile['vname']."<br/>";
        echo "Ort: ".$zeile['ort']."<br/>";
    }
}

// unknown Placeholder uncomment below
// $sql = "SELECT * FROM teilnehmer WHERE tnummer= ?";
// if($stmt = $pdo->prepare($sql)) {
//     $stmt->bindParam(1, $tnummer);
//     $stmt->execute();
    
// }

// binding with PDOStatement::execute() uncomment below
// $sql = "SELECT * FROM teilnehmer WHERE tnummer= :tnummer";
// if($stmt = $pdo->prepare($sql)) {
//     $stmt->execute(array(':tnummer'=>$tnummer));
// }

$sql = "SELECT * FROM teilnehmer WHERE tnummer= ?";
if($stmt = $pdo->prepare($sql)) {
    $stmt->execute(array($tnummer));
}
?>