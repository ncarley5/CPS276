<?php
require_once "../classes/Pdo_methods.php";

$postData = file_get_contents('php://input');
$data = json_decode($postData, true);

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

//In main.js, the addName function uses fetch() to send data to addName.php. Explain the request/response flow: what data format is sent from JavaScript, how does PHP receive it, and what format must PHP return for JavaScript to process it?
//Looking at displayNames.php, it returns different JSON structures for success cases (with names field) versus error cases (with msg field). Explain why maintaining a consistent response structure is important for the JavaScript code that processes these responses.
//In displayNames.php, the code checks if $records === "error" and also checks count($records) > 0. Explain the difference between these two conditions and why both checks are necessary before processing the database results.
//When a user clicks the "Add Name" button, main.js calls names.addName(), which then calls names.displayNames(). Explain why displayNames() is called after adding a name, and describe the sequence of AJAX requests that occur during this process.
//After clearNames.php successfully clears the database, the JavaScript calls names.displayNames() to refresh the list. Explain why this refresh is necessary and what would happen if this call were omitted. How does this demonstrate the stateless nature of HTTP requests?
?>