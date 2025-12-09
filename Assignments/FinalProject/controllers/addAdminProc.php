<?php
session_start();
require_once "../classes/StickyForm.php";
require_once "../classes/Pdo_methods.php";
require_once "../includes/security.php";

if (!isLoggedIn() || $_SESSION['status'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$sticky = new StickyForm();
$pdo = new PdoMethods();

// Define form configuration (same as in the form)
$formConfig = [
    'name' => ['id'=>'name','name'=>'name','label'=>'Name','regex'=>'name','required'=>true,'errorMsg'=>'Name can only contain letters, spaces, hyphens, or apostrophes','value'=>''],
    'email' => ['id'=>'email','name'=>'email','label'=>'Email','regex'=>'email','required'=>true,'errorMsg'=>'Invalid email address','value'=>''],
    'password' => ['id'=>'password','name'=>'password','label'=>'Password','regex'=>'none','required'=>true,'errorMsg'=>'Password cannot be blank','value'=>''],
    'status' => ['id'=>'status','name'=>'status','label'=>'Status','type'=>'select','options'=>['staff'=>'Staff','admin'=>'Admin'],'selected'=>'','required'=>true,'errorMsg'=>'You must select a status'],
    'masterStatus'=>['error'=>false,'msg'=>'']
];

// Validate submitted form
$formConfig = $sticky->validateForm($_POST, $formConfig);

// If no validation errors
if (!$formConfig['masterStatus']['error']) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $status = $_POST['status'];

    // Check for duplicate email
    $check = $pdo->selectBinded("SELECT * FROM admins WHERE email=:email", [
        [":email",$email,"str"]
    ]);

    if ($check) {
        $formConfig['masterStatus']['msg'] = "An admin with this email already exists";
    } else {
        $sql = "INSERT INTO admins (name, email, password, status) VALUES (:name, :email, :password, :status)";
        $bindings = [
            [":name",$name,"str"],
            [":email",$email,"str"],
            [":password",$password,"str"],
            [":status",$status,"str"]
        ];
        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === "noerror") {
            // Clear form after successful insert
            foreach ($formConfig as $key => &$field) {
                if (isset($field['value'])) $field['value'] = "";
                if (isset($field['options'])) $field['selected'] = '';
            }
            $formConfig['masterStatus']['msg'] = "Admin added successfully";
        } else {
            $formConfig['masterStatus']['msg'] = "There was an error adding the admin";
        }
    }
}

// Reload the form with messages and sticky values
include "../views/addAdminForm.php";
?>
