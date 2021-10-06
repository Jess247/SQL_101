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

    public function buildSelect($tab, $anr, $name, $def)
{
    $s = "<select name=\"" .$anr ."\" id=\"" .$anr ."\">";
      
    try {
        $pdo = new PDO(
            'mysql:dbname=bestelldatenbank;host=127.0.0.1;charset=utf8', 
            'root', '');
    } catch(PDOException $e) {
        die($e->getMessage());
    }
    $sql = "SELECT " .$anr .", " .$name ." FROM " .$tab;
    if ($stmt = $pdo -> prepare($sql)) {
      
        $stmt -> execute();
        while ($z = $stmt -> fetch()) {
            $s = $s ."<option value=\"". $z[0] ."\"";
            if($z[0] == $def){
                $s = $s ." selected";
                echo "you selected" .$z;
            }
            $s = $s .">" .$z[0] ." | " .$z[1]."</option>";
        }
        $s = $s ."</select>";
        echo $s;      
    }
    else {
        return false;
    }
 }


 public function delete($id) {
    try {
        $pdo = new PDO(
            'mysql:dbname=bestelldatenbank;host=127.0.0.1;charset=utf8', 
            'root', '');
    } catch(PDOException $e) {
        die($e->getMessage());
    }

    $sql = "DELETE FROM " 
            .$this->tabelle 
            ." WHERE anr = :anr";
    if ($stmt = $pdo -> prepare($sql)) {
       $stmt->bindParam(':anr', $id);
       $stmt -> execute();
     }
}


}


?>


<form action="" method="post">
    <label for="anr">Artikel: </label>
    <?php
        $datensatz = array();
        
        $artikel = new artikel;
        $anr = $_GET["anr"];
        $artikel->buildSelect("artikel", "anr","name", $_GET["anr"]);
    ?>
    <a href="loeschen.php?anr=<?php echo $anr; ?>">Teilnehmer löschen</a>

</form>
</body>
</html>