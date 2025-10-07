<?php
session_start();

$output = $_SESSION['result'] ?? null;

//unset($_SESSION['result']);

//What is the purpose of separating the functionality between index.php and processNames.php in this assignment?
//How does the $_SERVER["REQUEST_METHOD"] variable help determine when to process form submissions in PHP?
//How does PHP handle string-to-array conversion using the explode function, and why is this useful in this application?
//What role does the implode function play in formatting the output for the textarea?
//How does the use of "\n" inside a double-quoted string affect how names are displayed in the textarea? Why not use <br>?
//How does processNames.php determine whether to add a new name or clear all names based on which button was clicked?
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>add names</title>
  </head>
  <body>
    <div class="container">
    <h1>Add Names</h1>
    <form method="post" action="processNames.php">
    <input type="submit" name="addName" class="btn btn-primary" value="Add Name">
    <input type="submit" name="clearNames" class="btn btn-primary" value="Clear Names">
    <div class="form-group">
      <label for="name">Enter Name</label>
      <input type="text" class="form-control" id="name" name="name" >
    </div>
    <div class="form-group">
      <label for="namelist">List of Names</label>
      <textarea style="height: 500px;" class="form-control" id="namelist" name="namelist"><?php echo $output ?></textarea>
    </div>
    
  </form>
</div>

    
  </body>
</html>