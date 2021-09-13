<?php
try{
    $pdo = new PDO(
        'mysql:dbname=kursverwaltung;host:localhost;charset=utf-8',
        'root', '');
} catch(PDOException $e){
    die("An error has occurred");
}
// this codeblock only runs if $stmt is not == false
$myAttibutesd = array(
    "PDO::ATTR_CLIENT_VERSION",
    "PDO::ATTR_CONNECTION_STATUS",
    "PDO::ATTR_DRIVER_NAME",
    "PDO::ATTR_ERRMODE",
    "PDO::ATTR_SERVER_INFO",
    "PDO::ATTR_SERVER_VERSION",
);

echo "<ul>\n";
foreach($mzAttributes as $attribute) {
    echo "<li>" .$attribute.":"
         .$pdo->getAttribute(constant($attribute))
         ."</li>\n";
}

echo "</ul>\n";
?>