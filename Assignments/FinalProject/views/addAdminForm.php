<?php
require_once __DIR__ . "/../classes/StickyForm.php";

$sticky = new StickyForm();

/* Default form config */
$formConfig = [
    'masterStatus'=>['error'=>false,'msg'=>''], // ✅ added missing comma
    'name' => [
        'id'=>'name',
        'name'=>'name',
        'label'=>'Name',
        'value'=>'',
        'regex'=>'name',
        'required'=>true,
        'errorMsg'=>'Name can only contain letters, spaces, hyphens, or apostrophes'
    ],
    'email' => [
        'id'=>'email',
        'name'=>'email',
        'label'=>'Email',
        'value'=>'',
        'regex'=>'email',
        'required'=>true,
        'errorMsg'=>'Invalid email address'
    ],
    'password' => [
        'id'=>'password',
        'name'=>'password',
        'label'=>'Password',
        'value'=>'',
        'regex'=>'none',
        'required'=>true,
        'errorMsg'=>'Password cannot be blank'
    ],
    'status' => [
        'id'=>'status',
        'name'=>'status',
        'label'=>'Status',
        'type'=>'select',
        'options'=>['staff'=>'Staff','admin'=>'Admin'],
        'selected'=>'',
        'required'=>true,
        'errorMsg'=>'You must select a status'
    ],
];

/* Preserve sticky data if form was previously submitted */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formConfig = $sticky->validateForm($_POST, $formConfig);
}

include "../includes/navigation.php";
?>

<div class="container mt-4">
    <h2>Add Admin</h2>

    <?php if (!empty($formConfig['masterStatus']['msg'])): ?>
        <div class="alert alert-info"><?= htmlspecialchars($formConfig['masterStatus']['msg']); ?></div>
    <?php endif; ?>

    <!-- ✅ Correct form action to use router -->
    <form method="post" action="index.php?page=addAdmin">
        <?= $sticky->renderInput($formConfig['name'], 'mb-3') ?>
        <?= $sticky->renderInput($formConfig['email'], 'mb-3') ?>
        <?= $sticky->renderPassword($formConfig['password'], 'mb-3') ?>
        <?= $sticky->renderSelect($formConfig['status'], 'mb-3') ?>
        <button type="submit" class="btn btn-primary w-100">Add Admin</button>
    </form>
</div>
