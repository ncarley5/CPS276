<?php
session_start();
require_once __DIR__ . "/../includes/security.php";

if (!isLoggedIn()) {
    header("Location: ../index.php?page=login");
    exit();
}

$name = $_SESSION['name'];
$status = $_SESSION['status'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include __DIR__ . "/../includes/navigation.php"; ?>

<div class="container mt-5">
    <div class="jumbotron p-5 bg-light rounded">
        <h1 class="display-5">Welcome, <?= htmlspecialchars($name) ?>!</h1>

        <p class="lead">
            <?= $status === 'admin'
                ? "You have admin access. You can manage contacts and admins."
                : "You have staff access. You can add and delete contacts."
            ?>
        </p>

        <hr class="my-4">
        <p>Use the navigation bar to access your assigned pages.</p>
    </div>
</div>

</body>
</html>
