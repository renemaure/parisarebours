<?php
$file_size = 10 * 1024 * 1024; //  10 MB 
$targetDirectory = 'uploads/';

if (!is_dir($targetDirectory)) {
    mkdir($targetDirectory, 0755, true);
}
// File Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $targetFile = $targetDirectory . basename($_FILES['file']['name']);

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo 'Le fichier existe déjà.';
    } else {
        // Check file size (adjust to your needs)
        if ($_FILES['file']['size'] > $file_size) {
            echo 'Le fichier est trop lourd.';
        } else {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
                echo 'Fichier téléchargé avec succès.';
            } else {
                echo 'Erreur lors du téléchargement du fichier.';
            }
        }
    }
}
// File Download
if (isset($_GET['file'])) {
    $file = 'uploads/' . basename($_GET['file']);

    if (file_exists($file)) {
        // Set appropriate headers for the file download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($file) . '"');
        header('Content-Length: ' . filesize($file));
        readfile($file);
        exit;
    } else {
        echo 'File not found.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload and Download</title>
</head>
<body>
    <!-- File Upload Form -->
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" required>
        <input type="submit" value="Upload File">
    </form>

    <!-- File Download Links -->
    <h2>Files Available for Download:</h2>
    <ul>
        <?php
        $files = glob('uploads/*');
        foreach ($files as $file) {
            echo '<li><a href="?file=' . urlencode(basename($file)) . '">' . basename($file) . '</a></li>';
        }
        ?>
    </ul>
</body>
</html>
