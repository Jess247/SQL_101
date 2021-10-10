<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel mit Gruppenbezeichnung Ausgeben</title>
</head>
<body>
<?php
class artikel {

private $table = "artikel";

 
public function readData() {
    $sql="SELECT artikel.anr,
                 gruppen.gruppe AS gruppenGruppe,
                 artikel.name, artikel.preis
        FROM ". $this->table 
        . " JOIN gruppen ON
        artikel.gnr = gruppen.gnr";
    
    $this->createTable($sql);
}


private function createTable($sql) {
    
    try {
        $pdo = new PDO(
            'mysql:dbname=bestelldatenbank;host=127.0.0.1;charset=utf8', 
            'root', '');
    } catch(PDOException $e) {
        die($e->getMessage());
    }
    
    if ($stmt = $pdo -> prepare($sql)) {
        $stmt -> execute();
        echo "<table>\n\t";
        echo "<thead>
                <tr>
                    <th>Artikelnummer</th><th>Artikelgruppe</th><th>Artikelbezeichnung</th><th>Preis</th>
                </tr>
            </thead>";
        echo "<tbody>\n\t";
        while ($z = $stmt -> fetch()) {
            
            echo "<tr>\n\t<td>"
            . htmlspecialchars($z['anr'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['gruppenGruppe'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['name'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['preis'])
            ." €</td>\n</tr>";
        }
        echo "</table>";
        }
    }
}
?>
<h1>Artikelliste: </h1>
<div>
<?php
    $artikel = new artikel();
    $artikel->readData();
?>
</div>


    
</body>
</html>