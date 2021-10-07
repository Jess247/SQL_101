<!DOCTYPE HTML>
<html lang="de">
<head>
	<meta charset="utf-8" />
	<title>Artikel Löschen</title>
</head>
<body>
    <?php


class artikel {

    public function lesenDatensatz($id) {

try {
    $pdo = new PDO(
        'mysql:dbname=bestelldatenbank;host=127.0.0.1;charset=utf8', 
        'root', '');
} catch(PDOException $e) {
    die($e->getMessage());
}

        if ($stmt = $pdo -> prepare("SELECT anr, name 
                                            FROM artikel 
                                           WHERE anr=:anr")) {
            $stmt->bindParam(':anr',$id);
            $stmt -> execute();
            return($stmt->fetch(PDO::FETCH_ASSOC));
    }
    else {
        return false;
    }
    }

    public function einfuegenSelect($tab, $val, $text, $def)
{
    $s = "<select name=\"" .$val ."\" id=\"" .$val ."\">";
      

try {
    $pdo = new PDO(
        'mysql:dbname=bestelldatenbank;host=127.0.0.1;charset=utf8', 
        'root', '');
} catch(PDOException $e) {
    die($e->getMessage());
}

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

 public function loeschen($id) {
    try {
        $pdo = new PDO(
            'mysql:dbname=bestelldatenbank;host=127.0.0.1;charset=utf8', 
            'root', '');
    } catch(PDOException $e) {
        die($e->getMessage());
    }


    $sql = "DELETE FROM " .$this->tabelle ." WHERE anr = :anr";
    if ($stmt = $pdo -> prepare($sql)) {
       $stmt->bindParam(':anr', $id);
       $stmt -> execute();
       echo $id ." was deleted";
     }
}


}

if (isset($_POST["mode"])) {
        
    if($_POST["mode"] == "null"){
        echo "mode is NULL";
    }
    else {
        echo "mode is ".$_POST["mode"];
    }

header("refresh:3");
}
else {




        $artikel = new artikel();

        $tData = array();

        if (isset($_GET["anr"])) {
            $tData = $artikel->lesenDatensatz($_GET["anr"]);
            $anr = $_GET["anr"];
            echo $anr;
    ?>

    <form action="" method="POST">
    <input type="hidden" id="mode" name="mode" 
                value="<?php echo $anr; ?>" />
        <label for="anr">Termin: </label>
        <?php echo $artikel->einfuegenSelect("artikel", "anr", "name", $tData['anr']); ?>
        </form>
        
        <p><a class="button" href="loeschen.php?anr=<?php echo $anr; ?>">Artikel löschen</a></p>
    </form>
    <?PHP
    }
            
    else {
    ?> 
     <form action="loeschen.php?anr=<?php echo $anr; ?>" method="POST">
     <input type="hidden" id="mode" name="mode" value="null" />
        <label for="anr">Termin: </label>
        <?php echo $artikel->einfuegenSelect("artikel", "anr", "name", "anr"); ?>
        <br />
        <input type="submit" value="Datensatz löschen">
    </form> 
    <?php
        echo "I think that didnt work!";
    }
}
    ?>
</body>
</html>
