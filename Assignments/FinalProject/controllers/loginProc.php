<?php
session_start();

require_once __DIR__ . "/../classes/Pdo_methods.php";
require_once __DIR__ . "/../classes/StickyForm.php";

$pdo = new PdoMethods();
$sticky = new StickyForm();

/* -------------------------------------
   FORM CONFIGURATION FOR VALIDATION
-------------------------------------- */
$formConfig = [
    "masterStatus" => ["error" => false, "msg" => ""],

    "email" => [
        "type" => "text",
        "value" => "",
        "regex" => "email",
        "required" => true,
        "error" => "",
        "label" => "Email",
        "name"  => "email",
        "id"    => "email",
        "errorMsg" => "Please enter a valid email."
    ],

    "password" => [
        "type" => "text",
        "value" => "",
        "regex" => "none",
        "required" => true,
        "error" => "",
        "label" => "Password",
        "name"  => "password",
        "id"    => "password",
        "errorMsg" => "Password cannot be blank."
    ]
];

/* --------------------------------------------------
   VALIDATE FORM INPUT WITH StickyForm/Validation
--------------------------------------------------- */
$formConfig = $sticky->validateForm($_POST, $formConfig);

if ($formConfig["masterStatus"]["error"] === true) {
    // Reload login form with sticky values/errors
    $status = "There were errors on the form.";
    include __DIR__ . "/../views/loginForm.php";
    exit();
}

/* --------------------------------------------------
   CHECK DATABASE FOR EMAIL
--------------------------------------------------- */
$sql = "SELECT * FROM admins WHERE email = :email LIMIT 1";
$bindings = [
    [":email", $_POST["email"], "str"]
];

$result = $pdo->selectBinded($sql, $bindings);

if ($result === "error") {
    $formConfig["masterStatus"]["msg"] = "Database error.";
    $status = "Database error.";
    include __DIR__ . "/../views/loginForm.php";
    exit();
}

if (count($result) === 0) {
    $formConfig["masterStatus"]["msg"] = "Email or password is incorrect.";
    $status = "Email or password is incorrect.";
    include __DIR__ . "/../views/loginForm.php";
    exit();
}

$user = $result[0];

/* --------------------------------------------------
   VERIFY PASSWORD (HASHED)
--------------------------------------------------- */
if (!password_verify($_POST["password"], $user["password"])) {
    $formConfig["masterStatus"]["msg"] = "Email or password is incorrect.";
    $status = "Login credentials incorrect";
    include __DIR__ . "/../views/loginForm.php";
    exit();
}

/* --------------------------------------------------
   SUCCESSFUL LOGIN — SET SESSION
--------------------------------------------------- */
$_SESSION["id"]     = $user["id"];   // Needed for admin self-delete check
$_SESSION["name"]   = $user["name"];
$_SESSION["email"]  = $user["email"];
$_SESSION["status"] = $user["status"]; // 'admin' or 'staff'

header("Location: index.php?page=welcome");
exit();


?>
