<?php
require_once "Calculator.php";

$Calculator = new Calculator();

$result="";
$result .= $Calculator->calc("*", 10, 2);
$result .= $Calculator->calc("*", 4.56, 2);
$result .= $Calculator->calc("/", 10, 2);
$result .= $Calculator->calc("/", 10, 3);
$result .= $Calculator->calc("/", 10, 0);
$result .= $Calculator->calc("/", 0, 10);
$result .= $Calculator->calc("-", 10, 2);
$result .= $Calculator->calc("-", 10, 20);
$result .= $Calculator->calc("+", 10.5, 2);
$result .= $Calculator->calc("+", 10.5, 0);
$result .= $Calculator->calc("*", 10);
$result .= $Calculator->calc("+","a",10);
$result .= $Calculator->calc("+",10,"a");
$result .= $Calculator->calc(10);

//Explain the purpose of require_once "Calculator.php"; in th index.php page. What would be the difference if include or require were used instead of require_once?
//How does the divide method specifically prevent and report an error for division by zero? Why is this a critical consideration in calculator applications?
//If you were tasked with adding a new mathematical operation (e.g., exponentiation ^) to this calculator, what specific modifications would be required in both Calculator.php?
//Explain the difference between the Calculator class and the $Calculator object. Why do we create an instance of the class?
//Why is it important to check that the last two parameters are numbers in our Calculator class?
//Index.php handles the display of the results using HTML, while Calculator.php contains the core calculation logic. Discuss the importance of separating user interface (presentation) concerns from business logic.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Calculator</title>
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <h1>Calculator Output</h1>
 <main>
 <?php echo $result ?>
 </main>
</body>
</html>