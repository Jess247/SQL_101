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
                ."<a href=\"tbearbeiten.php?tnummer="
                .htmlspecialchars($z['tnummer'])
                ."\">bearbeiten</a>"
                ."</td> \n\t</tr>";
            }
            echo "</table>";

        }
    }
}
?>