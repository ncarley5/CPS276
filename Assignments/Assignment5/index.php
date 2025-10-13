<?php
require_once __DIR__ . '/classes/Directories.php';

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

    <?php if (!empty($fileContent)): ?>
        <h3>Contents of readme.txt:</h3>
        <pre><?= $fileContent ?></pre>
    <?php endif; ?>
</body>
</html>