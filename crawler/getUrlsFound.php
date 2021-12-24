<?php

$currentDir = './';
require_once($currentDir . '../scanner/functions/databaseFunctions.php');

isset($_POST['testId']) ? $testId = $_POST['testId'] : $testId = 0;

connectToDb($db);

$query = "SELECT * FROM tests WHERE id = $testId;"; 
$result = $db->query($query);
$row = $result->fetch_object();
$urls = $row->urls_found;

echo '<b>URLs Found:</b><br>';
echo $urls;

?>
