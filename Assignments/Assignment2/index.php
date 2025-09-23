<?php
$numbers = range(1, 50);
$evenNumbers = "Even Numbers: ";
foreach ($numbers as $number){
    if($number % 2 == 0){
        $evenNumbers = $evenNumbers . $number . " - ";
    }
}
$evenNumbers = substr($evenNumbers, 0, -3);
$form = <<<HTML
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <div class="mb-3">
        <label for="FormControlInput1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="FormControlInput1" placeholder="name@example.com">
    </div>
    <div class="mb-3 col">
        <label for="FormControlTextarea1" class="form-label">Example textarea</label>
        <textarea class="form-control" id="FormControlTextarea1" rows="3"></textarea>
    </div>
HTML;

function createTable($rows, $columns) {
    $table = "<table border='1' cellpadding='5' cellspacing='0' style='width: 100%;'>";
    for ($i = 1; $i < $rows + 1; $i++) {
        $table .= "<tr>";
        for ($j = 1; $j < $columns + 1; $j++) {
            $table .= "<td>Row $i, Column $j</td>";
        }
        $table .= "</tr>";
    }
    $table .= "</table>";
    
    return $table;
}

# 1. The assignment specifies that "all PHP written at the top above the HTML Doctype". Explain the implications of this placement on how the server processes the page. What advantage does generating all PHP variables ($evenNumbers, $form, $table) before any HTML output provide in terms of execution flow?

# 2. Beyond simply finding even numbers, describe a scenario where you would use a similar foreach loop with a conditional (if) statement to filter or process elements from an array based on different criteria like finding all numbers divisible by 7

# 3. Discuss the primary benefits of using heredoc for embedding large blocks of HTML or other text within PHP strings, especially when that text contains quotes or multiple lines. How does it improve code readability compared to concatenating strings with double quotes?

# 4. The createTable function uses nested for loops to build the table. Describe the role of each loop: which one is responsible for iterating through the rows, and which for the columns? How does the concatenation (.=) inside these loops incrementally build the complete HTML table string?

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>PHP Basics</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body class="container">
    <?php
        echo $evenNumbers;
        echo $form;
        echo createTable(8, 6);
    ?>
</body>
</html>