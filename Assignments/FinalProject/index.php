<?php
session_start();

if (!isset($_GET['page'])) {
    header("Location: index.php?page=login");
    exit();
}

$page = $_GET['page'];

$allowedPages = [
    'login',
    'welcome',
    'addContact',
    'deleteContacts',
    'addAdmin',
    'deleteAdmins'
];

if (!in_array($page, $allowedPages)) {
    header("Location: index.php?page=login");
    exit();
}

require_once "routes/router.php";
