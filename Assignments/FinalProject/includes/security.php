<?php
/*
    SECURITY HELPER FUNCTIONS
    These are used by router.php to enforce access protection
*/

function isLoggedIn() {
    return isset($_SESSION['id']);
}


function isAdmin() {
    return (isset($_SESSION['status']) && $_SESSION['status'] === 'admin');
}

/*
    Optional helper: blocks direct access if someone loads a file directly
*/
function blockDirectAccess() {
    if (realpath($_SERVER['SCRIPT_FILENAME']) === realpath(__FILE__)) {
        header("Location: ../index.php");
        exit();
    }
}

// Protect the file if someone tries to load it directly
blockDirectAccess();
?>
