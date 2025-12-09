<?php
require_once "../classes/Pdo_methods.php";

$pdo = new PdoMethods();

$sql = "TRUNCATE TABLE names";
$pdo->otherNotBinded($sql);

echo json_encode([
    "masterstatus" => "success",
    "msg" => "No names to display"
]);
?>
