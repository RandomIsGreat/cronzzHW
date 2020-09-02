<?php
header ("Content-Type: text/html; charset=utf-8");

$jsonContent = file_get_contents('dsn.json');
$decodeAssocJson = json_decode($jsonContent, true);
$dataBase = new PDO($decodeAssocJson["dsn"], $decodeAssocJson["root"]);
/*$getXml = simplexml_load_file("dsn.xml");
$dsn = (string)$getXml->dsn;
$root = (string)$getXml->name;
$dataBase = new PDO($dsn, $root);*/
$result = $dataBase->query('select characters.name, stats.race, stats.str, stats.dex, stats.vit, stats.integ FROM characters INNER JOIN stats ON stats.id = characters.stats_id;');
echo "<table>";
for($i = 0 ; $i <= 9 ; $i++)
{
    echo "<tr>";
    $showSome = $result->fetch(PDO::FETCH_ASSOC);
    foreach ($showSome as $item)
    {
        echo "<td>$item</td>";
    }
    echo "</tr>";
}
echo "</table>";

