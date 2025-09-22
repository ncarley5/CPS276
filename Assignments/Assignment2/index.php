<?php
$numbers = range(1, 50);
$evenNumbers = "";
foreach ($numbers as $number){
    if($number % 2 == 0){
        $evenNumbers = $evenNumbers . $number . " - ";
    }
}
$form = <<<HTML
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <div class="mb-3">
        <label for="FormControlInput1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="FormControlInput1" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="FormControlTextarea1" class="form-label">Example textarea</label>
        <textarea class="form-control" id="FormControlTextarea1" rows="3"></textarea>
    </div>
HTML;

function createTable($rows, $columns) {
    $table = "<table border='1'>";
    for ($i = 0; $i < $rows; $i++) {
        $table .= "<tr>";
        for ($j = 0; $j < $columns; $j++) {
            $table .= "<td>Row $i, Column $j</td>";
        }
        $table .= "</tr>";
    }
    $table .= "</table>";
    
    return $table;
}

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