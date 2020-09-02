<?php
header ("Content-Type: text/html; charset=utf-8");
$jsonContent = file_get_contents('dsn.json');
$decodeAssocJson = json_decode($jsonContent, true);
$dataBase = new PDO($decodeAssocJson["dsn"], $decodeAssocJson["root"]);
$result = $dataBase->query('select characters.name, stats.race, stats.str, stats.dex, stats.vit, stats.integ FROM characters INNER JOIN stats ON stats.id = characters.stats_id;');
$file = fopen("table.csv", "w");
$showSome = $result->fetchAll(PDO::FETCH_ASSOC);
foreach($showSome as $item)
{
    fputcsv($file, $item);
}
fclose($file);