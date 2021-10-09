<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8 (Without BOM)" />
<title>Einsendeaufgabe_Nr. 3 - Artikel löschen</title>
</head>
<body>
<?php

   
class artikel {


    function loeschen($id) {
        try {
            $pdo = new PDO(
                'mysql:dbname=bestelldatenbank;host=127.0.0.1;charset=utf8', 
                'root', '');
        } catch(PDOException $e) {
            die($e->getMessage());
        }
    
    $sql = "DELETE FROM artikel WHERE anr = :anr";
    if ($stmt =$pdo->prepare ($sql)){
        $stmt->bindParam(':anr', $id);
        $stmt->execute ();
        }
    }
    
    public function createSelect(){
        try {
            $pdo = new PDO(
                'mysql:dbname=bestelldatenbank;host=127.0.0.1;charset=utf8', 
                'root', '');
        } catch(PDOException $e) {
            die($e->getMessage());
        }

    $sql = "SELECT anr, name FROM artikel";
    if ($stmt =$pdo->prepare ($sql)){
        $stmt->execute ();
        echo "<form method=\"post\"";
        echo "<label>Artikel: </label>";
        echo "<select name=\"artikel\">";
        while ($z = $stmt -> fetch()) {
            echo "<option value=\"".$z['anr']."\"";
            if($z["anr"] == $_GET["anr"]){
                echo " selected";
            }
            echo " > ".$z['anr']." | ". $z['name'];
            echo "</option>";
        }
        echo "</select>";
        echo " ";
        echo "<input type='submit' value='Datensatz löschen' />";
        echo "</form>";
     } 
    }
}

// Datensatzlesen und in variable speichern (array der ergebnisliste) als Übergabe wert für createSelect()

$artikel = new artikel();
$artikel -> createSelect();
$selected = $_POST["artikel"];
if($selected) {
		$artikel -> loeschen($selected);
		echo "<h2>Artikel wurde gelöscht!</h2>";
        header("Refresh:3");
    }  
?>
</body>
</html>