<?php
require_once __DIR__ . "/../classes/StickyForm.php";

$sticky = new StickyForm();

/* Default formConfig in case controller does not pass it */
if (!isset($formConfig)) {
    $formConfig = [
        "masterStatus" => ["error" => false, "msg" => ""],
        "fname" => ["type"=>"text","value"=>"","label"=>"First Name","name"=>"fname","id"=>"fname","error"=>""],
        "lname" => ["type"=>"text","value"=>"","label"=>"Last Name","name"=>"lname","id"=>"lname","error"=>""],
        "address" => ["type"=>"text","value"=>"","label"=>"Address","name"=>"address","id"=>"address","error"=>""],
        "city" => ["type"=>"text","value"=>"","label"=>"City","name"=>"city","id"=>"city","error"=>""],
        "state" => ["type"=>"select","value"=>"","label"=>"State","name"=>"state","id"=>"state","options"=>["MI","OH","PA","IN","IL"],"error"=>""],
        "phone" => ["type"=>"text","value"=>"","label"=>"Phone","name"=>"phone","id"=>"phone","error"=>""],
        "email" => ["type"=>"text","value"=>"","label"=>"Email","name"=>"email","id"=>"email","error"=>""],
        "dob" => ["type"=>"text","value"=>"","label"=>"DOB","name"=>"dob","id"=>"dob","error"=>""],
        "contacts" => ["type"=>"textarea","value"=>"","label"=>"Contacts","name"=>"contacts","id"=>"contacts","error"=>""],
        "age" => ["type"=>"radio","value"=>"","label"=>"Age","name"=>"age","id"=>"age","options"=>["0-18","19-30","31-50","51+"],"error"=>""],
        "options" => ["type"=>"checkbox","value"=>[],"label"=>"Options","name"=>"options","id"=>"options","options"=>["Option1","Option2","Option3"],"error"=>""]
    ];
}
?>
<?php include __DIR__ . "/../includes/navigation.php"; ?>

<div class="container mt-5" style="max-width: 700px;">
    <h2 class="mb-4">Add Contact</h2>

    <?php if (!empty($formConfig['masterStatus']['msg'])): ?>
        <div class="alert alert-info"><?= htmlspecialchars($formConfig['masterStatus']['msg']); ?></div>
    <?php endif; ?>

    <!-- IMPORTANT: submit back to index.php?page=addContact -->
    <form action="index.php?page=addContact" method="post">
        <?= $sticky->renderInput($formConfig['fname'], 'mb-3') ?>
        <?= $sticky->renderInput($formConfig['lname'], 'mb-3') ?>
        <?= $sticky->renderInput($formConfig['address'], 'mb-3') ?>
        <?= $sticky->renderInput($formConfig['city'], 'mb-3') ?>
        <?= $sticky->renderSelect($formConfig['state'], 'mb-3') ?>
        <?= $sticky->renderInput($formConfig['phone'], 'mb-3') ?>
        <?= $sticky->renderInput($formConfig['email'], 'mb-3') ?>
        <?= $sticky->renderInput($formConfig['dob'], 'mb-3') ?>
        <?= $sticky->renderTextarea($formConfig['contacts'], 'mb-3') ?>
        <?= $sticky->renderRadio($formConfig['age'], 'mb-3', 'vertical') ?>
        <?= $sticky->renderCheckboxGroup($formConfig['options'], 'mb-3', 'horizontal') ?>

        <button type="submit" class="btn btn-success w-100">Add Contact</button>
    </form>
</div>
