<?php

class buchung {

private $tabelle = "buchung";

public function loeschen($id) {
     require("db.inc.php");
     $sql = "DELETE FROM " .$this->tabelle ." WHERE bnummer = :bnummer";
     if ($stmt = $pdo -> prepare($sql)) {
		$stmt->bindParam(':bnummer', $id);
        $stmt -> execute();
      }
}
 public function anlegen() {
     require("db.inc.php");
  	
    $bnummer = NULL;
	$termnr = $_POST["termnr"];
	$tnummer = $_POST["tnummer"];
		
    $sql = "INSERT INTO " .$this->tabelle ." (bnummer, 
									termnr,
									tnummer)
			VALUES (:bnummer, :termnr, :tnummer)";
	
	if ($stmt = $pdo -> prepare($sql)) {
		$param = array(':bnummer' => $bnummer,':termnr'=> $termnr, ':tnummer'=> $tnummer);
    
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
   	
    $bnummer = $_POST["mode"];
	$termnr = $_POST["termnr"];
	$tnummer = $_POST["tnummer"];
			
    $sql = "UPDATE " .$this->tabelle ." SET termnr = :termnr, tnummer = :tnummer WHERE bnummer = :bnummer";
	
	if ($stmt = $pdo -> prepare($sql)) {
		$param = array(':bnummer' => $bnummer,':termnr'=> $termnr, ':tnummer'=> $tnummer);
    
    if($stmt -> execute($param)) {
			echo "<h2>Datensatz erfolgreich gespeichert!</h2>\n";
        }	
		else {
			echo "<h2>Fehler beim Speichern!</h2>\n";
        }
	}
}

public function lesenDatensatz($id) {
     require("db.inc.php");
     if ($stmt = $pdo -> prepare("SELECT buchung.bnummer, 
                                        termine.termnr, 
                                        kurs.titel, 
                                        dozenten.name, 
                                        termine.beginn, 
                                        termine.ende, 
                                        teilnehmer.tnummer;
                                        teilnehmer.name,
                                        teilnehmer.vname
                                        FROM buchung 
                                        INNER JOIN termine ON buchung.termnr = termine.termnr  
                                        INNER JOIN teilnehmer ON buchung.tnummer = teilnehmer.tnummer 
                                        INNER JOIN kurs ON termine.kursnr = kurs.kursnr 
                                        INNER JOIN dozenten ON termine.doznr = dozenten.doznr 
                                        WHERE bnummer=:bnummer")) {
         $stmt->bindParam(':bnummer',$id);
         $stmt -> execute();
         return($stmt->fetch(PDO::FETCH_ASSOC));
 }
 else {
 	return false;
 }
 }
 
public function lesenAlleDaten() {
    $sql="SELECT buchung.bnummer,
                kurs.titel As kursTitel, 
                dozenten.name dozentenName, 
                termine.beginn, 
                termine.ende, 
                teilnehmer.name As teilnehmerName,
                teilnehmer.vname As teilnehmerVorname
                FROM buchung 
            JOIN termine ON buchung.termnr = termine.termnr  
            JOIN teilnehmer ON buchung.tnummer = teilnehmer.tnummer 
            JOIN kurs ON termine.kursnr = kurs.kursnr 
            JOIN dozenten ON termine.doznr = dozenten.doznr 
            ORDER BY buchung.bnummer";
    
    $this->baueBuchungTabelle($sql);
}

private function baueBuchungTabelle($sql)
{            
    require_once("db.inc.php");
    if ($stmt = $pdo -> prepare($sql)) {
        $stmt -> execute();
        echo "<table id=\"zebra\">\n\t";
        echo "<thead><tr><th>Nummer</th><th>Kurs</th><th>Dozent</th><th>Beginn</th><th>Ende</th><th>Name</th><th>Vorname</th><th>Bearbeiten</th></tr></thead>";
        echo "<tbody>\n\t";
        $count = 0;
        while ($z = $stmt -> fetch()) {
            $count+= 1;
            $zebratyp = "ungerade";
            echo "<tr ";
            if($count % 2 == 0) {
                $zebratyp = "gerade";
            }
            echo "class=\"" .$zebratyp
            ."\">\n\t<td>"
            . htmlspecialchars($z['bnummer'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['kursTitel'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['dozentenName'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['beginn'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['ende'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['teilnehmerName'])
            ."</td>\n\t<td>"
            . htmlspecialchars($z['teilnehmerVorname'])
            ."</td>\n\t<td>"
            ."<a href=\"bbearbeiten.php?bnummer=" .htmlspecialchars($z['bnummer']) ."\">bearbeiten</<a>"
            ."</td>\n</tr>";
        }
        echo "</table>";
      }
    
}

public function einfuegenSelect($tab, $val, $text, $def)
{
    $s = "<select name=\"" .$val ."\" id=\"" .$val ."\">";
      
    require("db.inc.php");
    $sql = "SELECT " .$val .", " .$text ." FROM " .$tab;
    if ($stmt = $pdo -> prepare($sql)) {
      
        $stmt -> execute();
        while ($z = $stmt -> fetch()) {
            $s = $s ."<option value=\"". $z[0] ."\"";
            if($z[0] == $def){
                $s = $s ." selected";
            }
            $s = $s .">" .$z[0] ." | " .$z[1]."</option>";
        }
        $s = $s ."</select>";
        return $s;      
    }
    else {
        return false;
    }
 }
}
?>
