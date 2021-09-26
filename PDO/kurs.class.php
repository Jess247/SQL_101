<?php
class kurs {

private $tabelle = "kurs";

 public function lesenDatensatz($id) {
     require("db.inc.php");
     $sql = "SELECT ressort, titel, beschreibung, preis
                FROM " .$this->tabelle ."
                WHERE kursnr=:kursnr";
     if ($stmt = $pdo -> prepare($sql)) {
       	$stmt->bindParam(':kursnr', $id);
        $stmt -> execute();
        return($stmt->fetch(PDO::FETCH_ASSOC));
    }    
     return(false);
 }

public function loeschen($id) {
     require("db.inc.php");
     $sql = "DELETE FROM " 
     		.$this->tabelle 
     		." WHERE kursnr = :kursnr";
     if ($stmt = $pdo -> prepare($sql)) {
		$stmt->bindParam(':kursnr', $id);
        $stmt -> execute();
      }
}
 
public function anlegen() {
     require("db.inc.php");
  	
    $kursnr = NULL;
	$ressort = $_POST["ressort"];
	$titel = $_POST["titel"];
	$beschreibung = $_POST["beschreibung"];
	$preis = $_POST["preis"];
	
	
    $sql = "INSERT INTO " .$this->tabelle ." (
			kursnr, ressort, titel,
			beschreibung, preis)
		VALUES (
			:kursnr, :ressort, :titel,
			:beschreibung, :preis)";
	
	if ($stmt = $pdo -> prepare($sql)) {
		$param = array(
				':kursnr' => $kursnr,
				':ressort' => $ressort,
				':titel'=>$titel,
				':beschreibung'=>$beschreibung,
				':preis'=>$preis);
		
		if($stmt -> execute($param)) {
			echo "<h2>Datensatz erfolgreich gespeichert!</h2>\n";
        }	
		else {
			echo "<h2>Fehler beim Speichern!</h2>\n";
        }
        
     	}
}

public function bearbeiten() {
    require("db.inc.php");
 	
    $kursnr = $_POST["mode"];
	$ressort = $_POST["ressort"];
	$titel = $_POST["titel"];
	$beschreibung = $_POST["beschreibung"];
	$preis = $_POST["preis"];

    $sql = "UPDATE ". $this->tabelle . " SET 
				ressort = :ressort, 
				titel = :titel, 
				beschreibung = :beschreibung, 
				preis = :preis
			WHERE kursnr = :kursnr";
    
    if ($stmt = $pdo -> prepare($sql)) {
    	$param = array(
            ':kursnr' => $kursnr,
            ':ressort' => $ressort,
            ':titel'=>$titel,
            ':beschreibung'=>$beschreibung,
            ':preis'=>$preis);

		if($stmt -> execute($param)) {
			echo "<h2>Datensatz erfolgreich gespeichert!</h2>\n";
        }	
		else {
			echo "<h2>Fehler beim Speichern!</h2>\n";
        }
	}
}

 
public function lesenAlleDaten() {
    $sql = "SELECT kursnr, ressort, titel,
    beschreibung, preis
             FROM " .$this->tabelle ." 
             ORDER BY kursnr";
    $this->baueTeilnehmerTabelle($sql);
}

public function suchen() {
	$sql = "SELECT kursnr, ressort, titel,
        beschreibung, preis
             FROM " .$this->tabelle ."
             WHERE";
    $count = 0;   
    foreach($_POST As $feld => $wert) {
        if(!empty($wert)) {
            if($count > 0) {
                $sql = $sql ." AND ";
            }
            $count += 1;
            $sql = $sql ." " .$feld ." LIKE '%" .$wert ."%'";  
        }
    }
    $sql = $sql ." ORDER BY name";
    
    $this->baueTeilnehmerTabelle($sql);
}

private function baueTeilnehmerTabelle($sql) {
     require_once("db.inc.php");
    if ($stmt = $pdo -> prepare($sql)) {
        $stmt -> execute();
        echo "<table id=\"zebra\">\n\t";
        echo "<thead>
                <tr>
                    <th>Nummer</th><th>Ressort</th><th>Titel</th><th>Bearbeiten</th>
                    <th>Preis</th><th>Bearbeiten</th>
                </tr>
            </thead>";
        echo "<tbody>\n\t";
        $count = 0;
        while ($z = $stmt -> fetch()) {
            $count += 1;
            $zebratyp = "ungerade";
            echo "<tr ";
            if($count % 2 == 0) {
                $zebratyp = "gerade";
            }
            echo "class=\"" .$zebratyp
            ."\">\n\t<td>"
            . htmlspecialchars($z['kursnr'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['ressort'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['titel'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['beschreibung'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['preis'])
            ."</td>\n\t<td>"
            ."<a href=\"kbearbeiten.php?kursnr=" 
            		.htmlspecialchars($z['kursnr']) 
            		."\">bearbeiten</<a>"
            ."</td>\n</tr>";
        }
        echo "</table>";
        }
    }
}
?>