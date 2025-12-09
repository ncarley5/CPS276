<?php
session_start();
require_once __DIR__ . "/../includes/security.php";

/* ------------------------------
   VALID ROUTES
------------------------------ */
$validPages = [
    'login'          => __DIR__ . '/../views/loginForm.php',
    'welcome'        => __DIR__ . '/../views/welcome.php',
    'addContact'     => __DIR__ . '/../views/addContactForm.php',
    'deleteContacts' => __DIR__ . '/../views/deleteContactsTable.php',
    'addAdmin'       => __DIR__ . '/../views/addAdminForm.php',
    'deleteAdmins'   => __DIR__ . '/../views/deleteAdminsTable.php'
];

/* ------------------------------
   GET PAGE PARAMETER
------------------------------ */
$page = $_GET['page'] ?? 'login';

if (!array_key_exists($page, $validPages)) {
    header("Location: /FinalProject/routes/router.php?page=login");
    exit();
}

/* ------------------------------
   SECURITY: BLOCK ACCESS IF NOT LOGGED IN
------------------------------ */
if ($page !== 'login' && !isLoggedIn()) {
    header("Location: /FinalProject/routes/router.php?page=login");
    exit();
}

/* ------------------------------
   ADMIN-ONLY PAGES
------------------------------ */
$adminOnly = ['addAdmin', 'deleteAdmins'];
if (in_array($page, $adminOnly) && $_SESSION['status'] !== 'admin') {
    header("Location: /FinalProject/index.php?page=welcome");
    exit();
}


/* ------------------------------
   PROCESS POST REQUESTS
------------------------------ */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($page) {
        case "login":
            require_once __DIR__ . "/../controllers/loginProc.php";
            exit();

        case "addContact":
            require_once __DIR__ . "/../controllers/addContactProc.php";
            exit();

        case "deleteContacts":
            require_once __DIR__ . "/../controllers/deleteContactProc.php";
            exit();

        case "addAdmin":
            require_once __DIR__ . "/../controllers/addAdminProc.php";
            exit();

        case "deleteAdmins":
            require_once __DIR__ . "/../controllers/deleteAdminProc.php";
            exit();
    }
}

/* ------------------------------
   LOAD VIEW PAGE FILE
------------------------------ */
include $validPages[$page];
