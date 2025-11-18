<?php
    require_once "classes/StickyForm.php";
    require_once "classes/Pdo_methods.php";
    $state = '';
    $output = 'No records to display';

    $formConfig = [
        'masterStatus' => ['error' => false],
        'first_name' => [
            'type' => 'text',
            'regex' => 'name',
            'label' => 'First Name',
            'name' => 'first_name',
            'id' => 'first_name',
            'errorMsg' => 'You must enter a valid first name.',
            'error' => '',
            'required' => true,
            'value' => 'Neil'
        ],
        'last_name' => [
            'type' => 'text',
            'regex' => 'name',
            'label' => 'Last Name',
            'name' => 'last_name',
            'id' => 'last_name',
            'errorMsg' => 'You must enter a valid last name.',
            'error' => '',
            'required' => true,
            'value' => 'Carley'
        ],
        'email' => [
            'type' => 'text',
            'regex' => 'email',
            'label' => 'Email',
            'name' => 'email',
            'id' => 'email',
            'errorMsg' => 'You must enter a valid email address.',
            'error' => '',
            'required' => true,
            'value' => 'ncarley@wccnet.edu'
        ],
        'password' => [
            'type' => 'text',
            'regex' => 'password',
            'label' => 'Password',
            'name' => 'password',
            'id' => 'password',
            'errorMsg' => 'You must enter a valid password.',
            'error' => '',
            'required' => true,
            'value' => 'Pass$or1'
        ],
        'confirm_password' => [
            'type' => 'text',
            'regex' => 'password',
            'label' => 'Confirm Password',
            'name' => 'confirm_password',
            'id' => 'confirm_password',
            'errorMsg' => 'You must enter a valid password.',
            'error' => '',
            'required' => true,
            'value' => 'Pass$or1'
        ],
    ];

    $stickyForm = new StickyForm();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $formConfig = $stickyForm->validateForm($_POST, $formConfig);
        if (!$stickyForm->hasErrors() && $formConfig['masterStatus']['error'] == false) {
            $pdo = new PdoMethods();
            $email = $_POST['email'];
            $sql = "SELECT email FROM users WHERE email = :email";
            $bindings = [
                [':email', $email, 'str']
            ];
            $result = $pdo->selectBinded($sql, $bindings);
            if (count($result) > 0) {
                $state = "There is already a record with that email";
            } else {
                 $pass = $_POST['password'];
                 $confpass = $_POST['confirm_password'];
                 if ($pass != $confpass) {
                    $formConfig['confirm_password']['error'] = "Passwords do not match";
                    $formConfig['masterStatus']['error'] = true;
                } else{
                    $firstName = $_POST['first_name'];
                    $lastName = $_POST['last_name'];
                    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)";
                    $bindings = [
                        [":first_name", "$firstName", "str"],
                        [":last_name", "$lastName", "str"],
                        [":email", "$email", "str"],
                        [":password", "$pass", "str"]
                    ];
                    $result = $pdo->otherBinded($sql, $bindings);
                    $state = "You have been added to the database";
                    foreach ($formConfig as $key => &$field) {
                        if (isset($field['value'])) {
                            $field['value'] = '';
                        }
                    }
                    $sql = "SELECT * FROM users";
                    $records = $pdo->selectNotBinded($sql);
                    $output = "<table class='table table-bordered mt-2'><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Password</th></tr>";
                    foreach ($records as $row) {
                        $output .= "<tr>";
                        foreach ($row as $value) {
                            $output .= "<td>" . htmlspecialchars($value) . "</td>";
                        }
                        $output .= "</tr>";
                    }
                    $output .= "</tbody></table>";
                 }
            }
        }
    }

//Why does StickyForm extend Validation instead of including validation logic directly? What are the benefits of this design?
//Explain what "sticky form" means. How does it improve user experience compared to a non-sticky form?
//Describe the validation process. When does validation occur, and what happens if validation fails?
//Explain the purpose of the $formConfig array. What information does it store, and how is it used throughout the form lifecycle?
//What is the purpose of masterStatus['error'] in the form configuration? How does it coordinate validation across multiple form fields?
?>


<!DOCTYPE html>
<html>
<head>
    <title>Sticky Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<?php echo $state; ?>
<div class="container mt-5">
<p>&nbsp;</p>    
<form method="post" action="">
        <div class="row">
            <!-- Render first name field -->
            <div class="col-md-6">
            <?php echo $stickyForm->renderInput($formConfig['first_name'], 'mb-3'); ?>
    
        </div>

            <!-- Render last name field -->
            <div class="col-md-6">
            <?php echo $stickyForm->renderInput($formConfig['last_name'], 'mb-3'); ?>
    
    </div>
        </div>

        
        <!-- Render email password password -->
        <div class="row">
           
            <div class="col-md-4">
            <?php echo $stickyForm->renderInput($formConfig['email'], 'mb-3'); ?>
    
</div>
            <div class="col-md-4">
                <?php echo $stickyForm->renderInput($formConfig['password'], 'mb-3'); ?>
    
</div>
            <div class="col-md-4">
                <?php echo $stickyForm->renderInput($formConfig['confirm_password'], 'mb-3'); ?>
        </div>
     <div>
        <button type="submit" name="register" class="btn btn-primary">Register</button>
</div>
    </form>
<?php echo $output; ?>
    </body>
</html>