<?php
$pdo = new PdoMethods();

$output = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES["file"];
    
    if ($file["size"] > 100000 || $file["error"] == UPLOAD_ERR_INI_SIZE) {
        $output .= "File is too large.";
    }else {
            $fileType = mime_content_type($file["tmp_name"]);

            if ($fileType != "application/pdf") {
                $output .= "Only PDFs are allowed.";
            } else {
            move_uploaded_file($file["tmp_name"], "Assignments/Assignment7/files/{$_POST['fileName']}.pdf");
            $output .= "File has been added."
            $result = $pdo->otherBinded("INSERT INTO files (file_name, file_path) VALUES (:file_name, :file_path)", [[':file_name', '{$_POST['fileName']}.pdf', 'str'], [':file_path', 'Assignments/Assignment7/files/{$_POST['fileName']}.pdf', 'str']]);
          }
}
?>