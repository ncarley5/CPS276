<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['addName'])) {
    $name = $_POST["addName"];
    $parts = explode(" ", $name);
    if (count($parts) === 2) {
        $firstName = $parts[0];
        $lastName = $parts[1];
        $format = $lastName . ", " . $firstName;}
    $array[] = $format;
    sort($array);
    $fin = implode($array);
    $_SESSION['result'] = $fin;
    header("Location: index.php");
    exit();}
} elseif (isset($_POST['clearNames'])) {
        header("Location: index.php");
        exit();
}
?>