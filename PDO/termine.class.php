<?php
class termine {
	private $tabelle = "termine";
	public function loeschen($id) {
		require ("db.inc.php");
		$sql = "DELETE FROM " . $this->tabelle . " WHERE termnr = :termnr";
		if ($stmt = $pdo->prepare ( $sql )) {
			$stmt->bindParam ( ':termnr', $id );
			$stmt->execute ();
		}
	}
	public function anlegen($felder) {
		require ("db.inc.php");
		
		$termnr = NULL;
		$kursnr = $felder ["kursnr"];
		$doznr = $felder ["doznr"];
		$beginn = $felder ["beginn"];
		$ende = $felder ["ende"];
		$dauer = $felder ["dauer"];
		$minanzahl = $felder ["minanzahl"];
		$maxanzahl = $felder ["maxanzahl"];
		$vort = $felder ["vort"];
		
		$sql = "INSERT INTO " . $this->tabelle . " (termnr, 
									kursnr,
									doznr,
									beginn, 
									ende,
                                    dauer,
                                    minanzahl,
                                    maxanzahl,
                                    vort)
					VALUES (:termnr, 
							:kursnr, 
							:doznr, 
							:beginn,  
							:ende, 
                            :dauer, 
                            :minanzahl, 
                            :maxanzahl, 
                            :vort)";
		
		if ($stmt = $pdo->prepare ( $sql )) {
			$param = array (
					':termnr' => $termnr,
					':kursnr' => $kursnr,
					':doznr' => $doznr,
					':beginn' => $beginn,
					':ende' => $ende,
					':dauer' => $dauer,
					':minanzahl' => $minanzahl,
					':maxanzahl' => $maxanzahl,
					':vort' => $vort 
			);
			
			if ($stmt->execute ( $param )) {
				echo "<h2>Datensatz erfolgreich gespeichert!</h2>\n";
			} else {
				echo "<h2>Fehler beim Speichern!</h2>\n";
			}
		}
	}
	
	public function bearbeiten($felder) {
		require ("db.inc.php");
		
		$termnr = $felder ["mode"];
		$kursnr = $felder ["kursnr"];
		$doznr = $felder ["doznr"];
		$beginn = $felder ["beginn"];
		$ende = $felder ["ende"];
		$dauer = $felder ["dauer"];
		$minanzahl = $felder ["minanzahl"];
		$maxanzahl = $felder ["maxanzahl"];
		$vort = $felder ["vort"];
		
		$sql = "UPDATE " . $this->tabelle . " SET  
									kursnr = :kursnr,
									doznr = :doznr,
									beginn = :beginn, 
									ende = :ende,
                                    dauer = :dauer,
                                    minanzahl = :minanzahl,
                                    maxanzahl = :maxanzahl,
                                    vort = :vort 
                                    WHERE termnr = :termnr";
		
		if ($stmt = $pdo->prepare ( $sql )) {
			$param = array (
					':termnr' => $termnr,
					':kursnr' => $kursnr,
					':doznr' => $doznr,
					':beginn' => $beginn,
					':ende' => $ende,
					':dauer' => $dauer,
					':minanzahl' => $minanzahl,
					':maxanzahl' => $maxanzahl,
					':vort' => $vort);
			
			if ($stmt->execute ($param)) {
				echo "<h2>Datensatz erfolgreich gespeichert!</h2>\n";
			} else {
				echo "<h2>Fehler beim Speichern!</h2>\n";
			}
		}
	}

	public function lesenDatensatz($id) {
		require ("db.inc.php");
		if ($stmt = $pdo->prepare ( "SELECT termine.termnr,
                                        termine.kursnr,
                                        kurs.titel,
                                        termine.doznr, 
                                        dozenten.name,
                                        dozenten.vname, 
                                        termine.beginn, 
                                        termine.ende, 
                                        termine.dauer, 
                                        termine.minanzahl, 
                                        termine.maxanzahl, 
                                        termine.vort 
                                        FROM termine 
                                        INNER JOIN kurs ON termine.kursnr = kurs.kursnr 
                                        INNER JOIN dozenten ON termine.doznr = dozenten.doznr 
                                        WHERE termnr=:termnr" )) {
			$stmt->bindParam ( ':termnr', $id );
			$stmt->execute ();
			return ($stmt->fetch(PDO::FETCH_ASSOC));
		}
		else {
			return false;
		}
	}
	public function lesenAlleDaten() {
		$sql = "SELECT termine.termnr,
                      kurs.titel As kursTitel, 
                      dozenten.name As dozentenName, 
                      termine.beginn, 
                      termine.ende, 
                      termine.dauer, 
                      termine.minanzahl, 
                      termine.maxanzahl, 
                      termine.vort 
                      FROM termine 
                      JOIN kurs ON termine.kursnr = kurs.kursnr 
                      JOIN dozenten ON termine.doznr = dozenten.doznr
                      ORDER BY termine.beginn";
		$this->baueTerminTabelle ( $sql );
	}
	
	private function baueTerminTabelle($sql) {
		require_once ("db.inc.php");
		if ($stmt = $pdo->prepare ( $sql )) {
			$stmt->execute ();
			echo "<table id=\"zebra\">\n\t";
			echo "<thead><tr><th>Nummer</th><th>Kurs</th><th>Dozent</th><th>Beginn</th><th>Ende</th><th>Dauer</th><th>Min-Teiln</th><th>Max-Teiln</th><th>Raum</th><th>Bearbeiten</th></tr></thead>";
			echo "<tbody>\n\t";
			$count = 0;
			while ($z=$stmt->fetch () ) {
				$count += 1;
				$zebratyp = "ungerade";
				echo "<tr ";
				if ($count % 2 == 0) {
					$zebratyp = "gerade";
				}
				echo "class=\"" . $zebratyp 
				. "\">\n\t<td>" . htmlspecialchars ( $z['termnr']) 
				. "</td>\n\t<td>" . htmlspecialchars ( $z['kursTitel'] ) 
				. "</td>\n\t<td>" . htmlspecialchars ( $z['dozentenName']) 
				. "</td>\n\t<td>" . htmlspecialchars ( $z['beginn'] ) 
				. "</td>\n\t<td>" . htmlspecialchars ( $z['ende']) 
				. "</td>\n\t<td>" . htmlspecialchars ( $z['dauer'] ) 
				. "</td>\n\t<td>" . htmlspecialchars ( $z['minanzahl']) 
				. "</td>\n\t<td>" . htmlspecialchars ( $z['maxanzahl'] ) 
				. "</td>\n\t<td>" . htmlspecialchars ( $z['vort']) 
				. "</td>\n\t<td>" . "<a href=\"termbearbeiten.php?termnr=" 
				. htmlspecialchars ( $z['termnr'] ) . "\">bearbeiten</<a>" . "</td>\n</tr>";
			}
			echo "</table>";
		}
		
		}
		
	public function einfSelect($tab, $val, $text, $def) {
		$s = "<select name=\"" . $val . "\" id=\"" . $val . "\">";
		
		require ("db.inc.php");
		$sql = "SELECT " . $val . ", " . $text . " FROM " . $tab;
		if ($stmt = $pdo->prepare ( $sql )) {
			$stmt->execute ();
			while ( $z = $stmt->fetch () ) {
				$s = $s . "<option value=\"" . $z[0] . "\"";
				if ($z[0] == $def) {
					$s = $s . " selected";
				}
				$s = $s . ">" . $z[0] . " | " . $z[1] . "</option>";
			}
			$s = $s . "</select>";
			
			return $s;
		} else {
			return false;
		}
	}
}
?>
