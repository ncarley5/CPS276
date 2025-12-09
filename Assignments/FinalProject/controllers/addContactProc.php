<?php
session_start();
require_once __DIR__ . "/../classes/StickyForm.php";
require_once __DIR__ . "/../classes/Pdo_methods.php";
require_once __DIR__ . "/../includes/security.php";

// Only logged-in users can access
if (!isLoggedIn()) {
    header("Location: ../index.php");
    exit();
}

$sticky = new StickyForm();
$pdo = new PdoMethods();

$formConfig = [
    "masterStatus" => ["error" => false, "msg" => ""],
    "fname" => ["type"=>"text","value"=>"","label"=>"First Name","name"=>"fname","id"=>"fname","error"=>""],
    "lname" => ["type"=>"text","value"=>"","label"=>"Last Name","name"=>"lname","id"=>"lname","error"=>""],
    "address" => ["type"=>"text","value"=>"","label"=>"Address","name"=>"address","id"=>"address","error"=>""],
    "city" => ["type"=>"text","value"=>"","label"=>"City","name"=>"city","id"=>"city","error"=>""],
    "state" => ["type"=>"select","value"=>"","label"=>"State","name"=>"state","id"=>"state","options"=>["MI","OH","PA","IN","IL"],"error"=>""],
    "phone" => ["type"=>"text","value"=>"","label"=>"Phone","name"=>"phone","id"=>"phone","error"=>""],
    "email" => ["type"=>"text","value"=>"","label"=>"Email","name"=>"email","id"=>"email","error"=>""],
    "dob" => ["type"=>"text","value"=>"","label"=>"DOB","name"=>"dob","id"=>"dob","error"=>""],
    "contacts" => ["type"=>"textarea","value"=>"","label"=>"Contacts","name"=>"contacts","id"=>"contacts","error"=>""],
    "age" => ["type"=>"radio","value"=>"","label"=>"Age","name"=>"age","id"=>"age","options"=>["0-18","19-30","31-50","51+"],"error"=>""],
    "options" => ["type"=>"checkbox","value"=>[],"label"=>"Options","name"=>"options","id"=>"options","options"=>["Option1","Option2","Option3"],"error"=>""]
];


// Validate POST data
$formConfig = $sticky->validateForm($_POST, $formConfig);

// Check if validation passed
if (!$formConfig['masterStatus']['error']) {

    // Prepare contact data
    $fname    = $_POST['fname'];
    $lname    = $_POST['lname'];
    $address  = $_POST['address'];
    $city     = $_POST['city'];
    $state    = $_POST['state'];
    $phone    = $_POST['phone'];
    $email    = $_POST['email'];
    $dob      = $_POST['dob'];
    $contacts = $_POST['contacts'] ?? '';
    $age      = $_POST['age'];
    $options  = isset($_POST['options']) ? implode(",", $_POST['options']) : '';

    // SQL Insert
    $sql = "INSERT INTO contacts 
            (fname, lname, address, city, state, phone, email, dob, contacts, age) 
            VALUES (:fname, :lname, :address, :city, :state, :phone, :email, :dob, :contacts, :age)";
    
    $bindings = [
        [":fname", $fname, "str"],
        [":lname", $lname, "str"],
        [":address", $address, "str"],
        [":city", $city, "str"],
        [":state", $state, "str"],
        [":phone", $phone, "str"],
        [":email", $email, "str"],
        [":dob", $dob, "str"],
        [":contacts", $contacts, "str"],
        [":age", $age, "str"]
    ];

    $result = $pdo->otherBinded($sql, $bindings);

    if ($result === "noerror") {
    // Clear form values
    foreach ($formConfig as $key => &$field) {
        if (isset($field['value'])) $field['value'] = "";
        if (isset($field['options'])) {
            foreach ($field['options'] as &$opt) $opt['checked'] = false;
        }
    }
    $formConfig['masterStatus']['msg'] = "Contact Information Added";

    // Optional: redirect to avoid form resubmission
    // header("Location: ../index.php?page=addContact&msg=success");
    // exit();
}
}

// Include the form view to display again with sticky values & messages
include __DIR__ . "/../views/addContactForm.php";
?>
