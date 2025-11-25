<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../classes/Pdo_methods.php";

$pdo = new PdoMethods();

$sql = "SELECT first_name, last_name FROM names ORDER BY last_name ASC, first_name ASC";
$result = $pdo->selectNotBinded($sql);

if ($result === 'error') {
    echo json_encode([
        "masterstatus" => "error",
        "msg" => "Error retrieving names"
    ]);
    exit;
}

if (count($result) === 0) {
    echo json_encode([
        "masterstatus" => "success",
        "names" => "No names to display"
    ]);
    exit;
}

$output = "";
foreach ($result as $row) {
    $output .= htmlspecialchars($row['last_name']) . ", " .
               htmlspecialchars($row['first_name']) . "<br>";
}

echo json_encode([
    "masterstatus" => "success",
    "names" => $output
]);
?>
