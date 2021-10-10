<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8 (Without BOM)" />
<title>Artikel löschen</title>
</head>
<body>
<?php

   
class artikel {


    function delete($id) {
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

        echo "<select name=\"artikel\">";
        while ($z = $stmt -> fetch()) {
            echo "<option value=\"".$z['anr']."\"";
            if($z["anr"] == $_GET["anr"]){
                echo " selected";
            }
            echo " > ".$z['anr']." | ". $z['name'];
            echo "</option>";
        }
        echo "</select>\n\t
              <input type='submit' value='Artikel löschen' />";
     } 
    }
}
?>
    <form action="" method="post">
    <label for="artikel">Artikel: </label>
        <?php
            $artikel = new artikel();
            $artikel -> createSelect();
            $selected = $_POST["artikel"];
            if($selected) {
                    $artikel -> delete($selected);
                    echo "<h2>Artikel wurde gelöscht</h2>";
                    header("Refresh:3");
                    echo "<p>Die Seite wird in drei Sekunden neu gelanden, ist dies nicht der Fall klicken sie <a href=\"loeschen.php\">hier...</a></p>";
            } 
        ?>
    </form>
</body>
</html>