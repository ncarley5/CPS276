<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../classes/Pdo_methods.php";

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

// Ensure "name" exists
if (!isset($data['name'])) {
    echo json_encode([
        "masterstatus" => "error",
        "msg" => "Invalid data sent"
    ]);
    exit;
}

$parts = explode(" ", trim($data['name']));
$firstName = $parts[0] ?? "";
$lastName  = $parts[1] ?? "";

if ($firstName === "" || $lastName === "") {
    echo json_encode([
        "masterstatus" => "error",
        "msg" => "You must enter a first and last name"
    ]);
    exit;
}

$pdo = new PdoMethods();

$sql = "INSERT INTO names (first_name, last_name) VALUES (:first_name, :last_name)";
$bindings = [
    [":first_name", $firstName, "str"],
    [":last_name",  $lastName,  "str"]
];

$result = $pdo->otherBinded($sql, $bindings);

if ($result === "noerror") {
    echo json_encode([
        "masterstatus" => "success",
        "msg" => "Name added successfully"
    ]);
} else {
    echo json_encode([
        "masterstatus" => "error",
        "msg" => "Database error adding name"
    ]);
}
