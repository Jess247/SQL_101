<?php 
class teilnehmer {

    private $tabelle = "teilnehmer";

    public function lesenAlleDaten() {
        $sql = "SELECT tnummer, name, vname, plz,
         ort, strasse, hausnr,
        telefon1, telefon2, email
        FROM ".$this->tabelle."
        ORDER BY name";
        $this->baueTeilnehmerTabelle($sql);
    }
    
    private function baueTeilnehmerTabelle($sql) {
        require_once("db.inc.php");
        if($stmt = $pdo -> prepare($sql)) {
            $stmt -> execute();
            echo "<table id=\"zebra\">\n\t";
            echo "<thead>
            <tr>
            <th>Nummer</th><th>Name</th><th>Vorname</th><th>PLZ</th>
            <th>Ort</th><th>Straße</th><th>Haus-Nr.</th><th>Telefon1</th>
            <th>telefon2</th><th>E-Mail</th><th>Bearbeiten</th>
            </tr>
            </thead>";

            echo "<tbody>\n\t";
            $count = 0;
            while($z = $stmt -> fetch()){
                $count +=1;
                $zebratyp = "ungerade";
                echo "<tr ";
                if($count % 2 == 0) {
                    $zebratyp = "gerade";
                }
                echo "class=\"". $zebratyp."\">\n\t<td>"
                .htmlspecialchars($z['tnummer'])
                ."</td>\n\t<td>"
                .htmlspecialchars($z['name'])
                ."</td>\n\t<td>"
                .htmlspecialchars($z['vname'])
                ."</td>\n\t<td>"
                .htmlspecialchars($z['plz'])
                ."</td>\n\t<td>"
                .htmlspecialchars($z['ort'])
                ."</td>\n\t<td>"
                .htmlspecialchars($z['strasse'])
                ."</td>\n\t<td>"
                .htmlspecialchars($z['hausnr'])
                ."</td>\n\t<td>"
                .htmlspecialchars($z['telefon1'])
                ."</td>\n\t<td>"
                .htmlspecialchars($z['telefon2'])
                ."</td>\n\t<td>"
                .htmlspecialchars($z['email'])
                ."</td>\n\t<td>"
                ."<a href=\"tbearbeiten.php?tnummer=" // link zur Datei mit tnummer als Parameter
                .htmlspecialchars($z['tnummer'])
                ."\">bearbeiten</a>"
                ."</td> \n\t</tr>";
            }
            echo "</table>";

        }
    }

    // bearbeiten 
    public function lesenDatensatz($id) {
        require_once("db.inc.php");
        $sql = "SELECT name, vname, plz,
        ort, strasse, hausnr,
       telefon1, telefon2, email
       FROM ".$this->tabelle."
       WHERE tnummer=:tnummer";

       if($stmt = $pdo -> prepare($sql)){
        $stmt->bindParam(':tnummer', $id);
        $stmt->execute();
        return($stmt->fetch(PDO::FETCH_ASSOC));
       }
       return(false);
    }

    public function bearbeiten() {
        require("db.inc.php");

        $tnummer = $_POST["mode"];
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
            WHERE tnummer 0 :tnummer";

            if($stmt = $pdo -> prepare($sql)){
                $param = array(
                    'tnummer' => $tnummer,
                    'name' => $name,
                    'vname' => $vname,
                    'plz' => $plz,
                    'ort' => $ort,
                    'strasse' => $strasse,
                    'hausnr' => $hausnr,
                    'telefon1' => $telefon1,
                    'telefon2' => $telefon2,
                    'email' => $email);

                if($stmt -> execute($param)){
                    echo "<h2>Datensatz erfolgreich gespeichert!</h2>\n";
                } else {
                    echo "<h2>Fehler beim Spechern</h2>\n";
                }
            }
    }

    // hinzufügen
    public function anlegen() {
        require("db.inc.php");

        $tnummer = "NULL";
        $name = $_POST["name"];
        $vname = $_POST["vname"];
        $plz = $_POST["plz"];
        $ort = $_POST["ort"];
        $strasse = $_POST["strasse"];
        $hausnr = $_POST["hausnr"];
        $telefon1 = $_POST["telefon1"];
        $telefon2 = $_POST["telefon2"];
        $email = $_POST["email"];

        $sql = "INSERT INTO ". $this->tabelle . " SET
            name = :name,
            vname = :vname,
            plz = :plz,
            ort = :ort,
            strasse = :strasse,
            hausnr = :hausnr,
            telefon1 = :telefon1,
            telefon2 = :telefon2,
            email = :email
            WHERE tnummer 0 :tnummer";

            if($stmt = $pdo -> prepare($sql)){
                $param = array(
                    'tnummer' => $tnummer,
                    'name' => $name,
                    'vname' => $vname,
                    'plz' => $plz,
                    'ort' => $ort,
                    'strasse' => $strasse,
                    'hausnr' => $hausnr,
                    'telefon1' => $telefon1,
                    'telefon2' => $telefon2,
                    'email' => $email);

                if($stmt -> execute($param)){
                    echo "<h2>Datensatz erfolgreich gespeichert!</h2>\n";
                } else {
                    echo "<h2>Fehler beim Spechern</h2>\n";
                }
            }
    }

    // löschen
     public function loeschen($id) {
        require("db.inc.php");
        $sql = "DELETE FROM "
                .$this->tabelle
                ."WHERE tnummer = :tnummer";

        if($stmt = $pdo -> prepare($sql)) {
            $stmt->bindParam(':tnummer', $id);
            $stmt->execute();
        }
     }

}
?>