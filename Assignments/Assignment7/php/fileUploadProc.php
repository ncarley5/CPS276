<?php
require_once "../Assignment7/classes/Pdo_methods.php";
//I couldn't figure out why this wouldn't work

$pdo = new PdoMethods();
$output = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES["file"];
    $fileName = preg_replace("/[^a-zA-Z0-9_-]/", "_", $_POST['fileName']); // sanitize file name
    $uploadDir = "Assignments/Assignment7/files/";
    $uploadPath = $uploadDir . $fileName . ".pdf";

    if ($file["size"] > 100000 || $file["error"] == UPLOAD_ERR_INI_SIZE) {
        $output .= "File is too large.";
    } 
    else {
        $fileType = mime_content_type($file["tmp_name"]);

        if ($fileType != "application/pdf") {
            $output .= "Only PDFs are allowed.";
        } 
        else {
            if (move_uploaded_file($file["tmp_name"], $uploadPath)) {
                $sql = "INSERT INTO files (file_name, file_path) VALUES (:file_name, :file_path)";
                $bindings = [
                    [':file_name', $fileName . ".pdf", 'str'],
                    [':file_path', $uploadPath, 'str']
                ];
                
                $result = $pdo->otherBinded($sql, $bindings);

                if ($result === 'noerror') {
                    $output .= "File has been added successfully.";
                } else {
                    $output .= "Database error.";
                }
            } else {
                $output .= "Error moving file.";
            }
        }
    }
}
?>