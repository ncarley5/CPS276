<?php
session_start();
require_once "../includes/security.php";
require_once "../classes/Pdo_methods.php";

// Only logged-in users can access
if (!isLoggedIn()) {
    header("Location: ../index.php");
    exit();
}

// Check if any checkboxes were selected
if (!empty($_POST['delete_ids'])) {
    $ids = $_POST['delete_ids'];
    $placeholders = implode(',', array_fill(0, count($ids), '?'));

    $sql = "DELETE FROM contacts WHERE id IN ($placeholders)";
    $bindings = [];
    foreach ($ids as $id) {
        $bindings[] = [$id, "int"]; // Correct binding for Pdo_methods
    }

    $pdo = new PdoMethods();
    $result = $pdo->otherBinded($sql, $bindings);

    if ($result === "noerror") {
        $_SESSION['msg'] = "Contact(s) deleted";
    } else {
        $_SESSION['msg'] = "Could not delete the contacts";
    }
}

header("Location: index.php?page=deleteContacts");
exit();


?>
