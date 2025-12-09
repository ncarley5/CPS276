<?php
session_start();
require_once "../includes/security.php";
require_once "../classes/Pdo_methods.php";

// Only admins can access
if (!isLoggedIn() || $_SESSION['status'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

$pdo = new PdoMethods();

if (!empty($_POST['delete_ids'])) {
    $ids = $_POST['delete_ids'];

    // Prevent deleting self
    $ids = array_filter($ids, function($id) {
        return $id != $_SESSION['id'];
    });

    if (!empty($ids)) {
        $placeholders = implode(',', array_fill(0, count($ids), '?'));
        $sql = "DELETE FROM admins WHERE id IN ($placeholders)";
        $bindings = [];
        foreach ($ids as $id) {
            $bindings[] = [$id, "int"];
        }

        $result = $pdo->otherBinded($sql, $bindings);
        $_SESSION['msg'] = ($result === "noerror") ? "Admin(s) deleted" : "Could not delete the admins";
    } else {
        $_SESSION['msg'] = "You cannot delete yourself";
    }
}

// ✅ Redirect via router, not directly to views
header("Location: ../index.php?page=deleteAdmins");
exit();
?>
