<?php
try{
    $pdo = new PDO(
        'mysql:dbname=kursverwaltung;host=127.0.0.1;',
        'root', '');
} catch(PDOException $e){
    echo $e->getMessage();
    echo "<pre>",print_r($e),"</pre>";
}
// this codeblock only runs if $stmt is not == false
$myAttributes = array(
    "PDO::ATTR_CLIENT_VERSION",
    "PDO::ATTR_CONNECTION_STATUS",
    "PDO::ATTR_DRIVER_NAME",
    "PDO::ATTR_ERRMODE",
    "PDO::ATTR_SERVER_INFO",
    "PDO::ATTR_SERVER_VERSION",
);

echo "<ul>\n";
foreach($myAttributes as $attribute) {
    echo "<li>" .$attribute.":"
         .$pdo->getAttribute(constant($attribute))
         ."</li>\n";
}

echo "</ul>\n";
?>