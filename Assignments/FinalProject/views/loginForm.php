<?php
require_once __DIR__ . "/../classes/StickyForm.php";

$sticky = new StickyForm();

/* If controller did NOT pass formConfig, use this default */
if (!isset($formConfig)) {
    $formConfig = [
        "masterStatus" => ["error" => false, "msg" => ""],
        "email" => [
            "type" => "text",
            "value" => "",
            "error" => "",
            "label" => "Email",
            "name" => "email",
            "id" => "email"
        ],
        "password" => [
            "type" => "password",
            "value" => "",
            "error" => "",
            "label" => "Password",
            "name" => "password",
            "id" => "password"
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5" style="max-width: 500px;">
    <h2 class="text-center mb-4">Login</h2>

    <?php if ($formConfig["masterStatus"]["error"]): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($formConfig["masterStatus"]["msg"]) ?>
        </div>
    <?php endif; ?>

    <!-- IMPORTANT: Must submit back to index.php?page=login -->
    <form action="index.php?page=login" method="post">

        <?= $sticky->renderInput($formConfig['email'], 'mb-3') ?>
        <?= $sticky->renderPassword($formConfig['password'], 'mb-3') ?>

        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
</div>
</body>
</html>
