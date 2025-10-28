<?php
require_once __DIR__ . '/classes/Directories.php'; //learned from AI

$message = '';
$link = '';
$fileContent = '';
$dirnameError = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dirname = $_POST['dirname'] ?? '';
    $content = $_POST['content'] ?? '';

    $dir = new Directories();
    $result = $dir->create($dirname, $content);
    $message = $result['message'];

    if (!$result['success']) {
        if ($result['message'] === 'Directory name must contain only letters.') {
            $dirnameError = $result['message'];
        }
    }  

    $message = $result['message'];
    if ($result['success']) {
        $link = 'directories/' . $dirname . '/readme.txt';
    }
}

//Explain the difference between creating a directory and creating a file in PHP. What PHP functions are used for each operation, and why is it important to check if a directory already exists before attempting to create it?
//Describe the flow of data from an HTML form submission to PHP processing. How does PHP access form data, and what considerations should developers keep in mind when handling user input from forms?
//Why is it important to properly close file handles after writing to files? What problems can occur if file handles are not closed, and how does this relate to system resource management?
//Why did we use 777 permissions and what should we use and why.
//Explain the benefits of organizing file and directory operations into a class structure. How does this approach improve code organization, reusability, and maintainability compared to writing all operations in procedural code?
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>File and Directory</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <div class="container">
      <h1>File and Directory Assignment</h1>

      <p>Enter a folder name and the contents of a file.  Folder names should contain alpha numeric characters only.</p>

    <?php if (!empty($link)): ?>
        <p><a href="<?= htmlspecialchars($link) ?>" target="_blank">Path where the file is located</a></p>
    <?php endif; ?>

    <?php if (!empty($message)): ?>
        <p><strong><?= htmlspecialchars($message) ?></strong></p>
    <?php endif; ?>

    <form method="post">
    <?php if (!empty($dirnameError)): ?>
        <p style="color: red;"><?= htmlspecialchars($dirnameError) ?></p>
    <?php endif; ?>

    <div class="form-group">
          <label for="foldername">Folder Name</label>
          <input type="text" name="dirname" class="form-control" id="dirname" value="<?= isset($_POST['dirname']) ? htmlspecialchars($_POST['dirname']) : '' ?>" required />
    </div>
    <div class="form-group">
        <label for="filecontent">File Content</label>
        <textarea name="content" id="content" class="form-control" rows="6" cols="40" required><?= isset($_POST['content']) ? htmlspecialchars($_POST['content']) : '' ?></textarea><br><br>
    </div>
    <input type="submit" value="Submit" />
    
    </form>
    
</body>
</html>