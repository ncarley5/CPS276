<?php
require_once "../Assignment7/classes/Pdo_methods.php";

$pdo = new PdoMethods();

$output = '';
$sql = "SELECT file_name, file_path FROM files";

$records = $pdo->selectNotBinded($sql);
$output .= "<ul>"; foreach ($records as $row) {$name = htmlspecialchars($row['file_name']); $path = htmlspecialchars($row['file_path']); "<li><a href='{$path}' target='_blank'>{$name}</a></li>";} "</ul>";
?>