<?php
require_once "PdoMethods.php";

$pdo = new PdoMethods();

$output = '';
$sql = "SELECT file_name, file_path FROM files";

$records = $pdo->selectNotBinded($sql) {
}
$output .= echo "<ul>";
    foreach ($records as $row) {
        $name = htmlspecialchars($row['file_name']);
        $path = htmlspecialchars($row['file_path']);

        echo "<li><a href='{$path}' target='_blank'>{$name}</a></li>";
    }
    echo "</ul>";
?>