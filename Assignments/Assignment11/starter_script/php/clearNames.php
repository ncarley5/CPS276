<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../classes/Pdo_methods.php";

$pdo = new PdoMethods();

$sql = "TRUNCATE TABLE names";
$pdo->otherNotBinded($sql);

echo json_encode([
    "masterstatus" => "success",
    "msg" => "No names to display"
]);

