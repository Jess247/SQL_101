<?php
class dozenten {

private $tabelle = "dozenten";

 public function lesenDatensatz($id) {
     require("db.inc.php");
     $sql = "SELECT name, vname, plz, ort, strasse,
					hausnr,telefon1, telefon2, email
                FROM " .$this->tabelle ."
                WHERE doznr=:doznr";
     if ($stmt = $pdo -> prepare($sql)) {
       	$stmt->bindParam(':doznr', $id);
        $stmt -> execute();
        return($stmt->fetch(PDO::FETCH_ASSOC));
    }    
     return(false);
 }

public function loeschen($id) {
     require("db.inc.php");
     $sql = "DELETE FROM " 
     		.$this->tabelle 
     		." WHERE doznr = :doznr";
     if ($stmt = $pdo -> prepare($sql)) {
		$stmt->bindParam(':doznr', $id);
        $stmt -> execute();
      }
}
 
public function anlegen() {
     require("db.inc.php");
  	
    $doznr = NULL;
	$name = $_POST["name"];
	$vname = $_POST["vname"];
	$plz = $_POST["plz"];
	$ort = $_POST["ort"];
	$strasse = $_POST["strasse"];
	$hausnr = $_POST["hausnr"];
	$telefon1 = $_POST["telefon1"];
	$telefon2 = $_POST["telefon2"];
	$email = $_POST["email"];
	
    $sql = "INSERT INTO " .$this->tabelle ." (
			doznr, name, vname,
			plz, ort, strasse, hausnr, 
			telefon1, telefon2, email)
		VALUES (
			:doznr, :name, :vname,
			:plz, :ort, :strasse, :hausnr, 
			:telefon1, :telefon2, :email)";
	
	if ($stmt = $pdo -> prepare($sql)) {
		$param = array(
				':doznr' => $doznr,
				':name' => $name,
				':vname'=>$vname,
				':plz'=>$plz,
				':ort'=>$ort,
				':strasse'=>$strasse,
				':hausnr'=>$hausnr,
				':telefon1'=>$telefon1,
				':telefon2'=>$telefon2,
				':email'=> $email);
		
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
 	
    $doznr = $_POST["mode"];
    $name = $_POST["name"];
    $vname = $_POST["vname"];
    $plz = $_POST["plz"];
    $ort = $_POST["ort"];
    $strasse = $_POST["strasse"];
    $hausnr = $_POST["hausnr"];
    $telefon1 = $_POST["telefon1"];
    $telefon2 = $_POST["telefon2"];
    $email = $_POST["email"];

    $sql = "UPDATE ". $this->tabelle . " SET 
				name = :name, 
				vname = :vname, 
				plz = :plz, 
				ort = :ort, 
				strasse = :strasse, 
				hausnr = :hausnr, 
				telefon1 = :telefon1, 
				telefon2 = :telefon2, 
				email = :email 
			WHERE doznr = :doznr";
    
    if ($stmt = $pdo -> prepare($sql)) {
    	$param = array(
    			':doznr' => $doznr,
    			':name' => $name,
    			':vname'=>$vname,
    			':plz'=>$plz,
    			':ort'=>$ort,
    			':strasse'=>$strasse,
    			':hausnr'=>$hausnr,
    			':telefon1'=>$telefon1,
    			':telefon2'=>$telefon2,
    			':email'=> $email);

		if($stmt -> execute($param)) {
			echo "<h2>Datensatz erfolgreich gespeichert!</h2>\n";
        }	
		else {
			echo "<h2>Fehler beim Speichern!</h2>\n";
        }
	}
}

 
public function lesenAlleDaten() {
    $sql = "SELECT doznr, name, vname, plz,
				ort, strasse, hausnr, 
				telefon1, telefon2, email 
             FROM " .$this->tabelle ." 
             ORDER BY name";
    $this->baueTeilnehmerTabelle($sql);
}

public function suchen() {
	$sql = "SELECT doznr, name, vname, plz,
				ort, strasse, hausnr,
				telefon1, telefon2, email
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
                    <th>Nummer</th><th>Name</th><th>Vorname</th><th>Plz</th>
                    <th>Ort</th><th>Straße</th><th>Haus-Nr.</th><th>Telefon 1</th>
                    <th>Telefon 2</th><th>E-Mail</th><th>Bearbeiten</th>
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
            . htmlspecialchars($z['doznr'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['name'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['vname'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['plz'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['ort'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['strasse'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['hausnr'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['telefon1'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['telefon2'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['email'])
            ."</td>\n\t<td>"
            ."<a href=\"dbearbeiten.php?doznr=" 
            		.htmlspecialchars($z['doznr']) 
            		."\">bearbeiten</<a>"
            ."</td>\n</tr>";
        }
        echo "</table>";
        }
    }
}
?>