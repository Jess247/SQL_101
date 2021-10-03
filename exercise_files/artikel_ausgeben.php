<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel Ausgeben</title>
</head>
<body>
<?php
class artikel {

private $tabelle = "artikel";

 
public function lesenAlleDaten() {
    $sql = "SELECT anr, gnr, name, preis 
             FROM " .$this->tabelle ." 
             ORDER BY anr";
    $this->baueTeilnehmerTabelle($sql);
}


private function baueTeilnehmerTabelle($sql) {
    
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
        $count = 0;
        while ($z = $stmt -> fetch()) {
            $count += 1;
            
            echo "<tr>\n\t<td>"
            . htmlspecialchars($z['anr'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['gnr'])
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
    $artikel->lesenAlleDaten();
?>
</div>


    
</body>
</html>