<?php
$file_size = 10 * 1024 * 1024; //  10 MB
$targetDirectory = 'uploads/';
$fileStatus = '';
if (!is_dir($targetDirectory)) {
    mkdir($targetDirectory, 0755, true);
}
// File Upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $targetFile = $targetDirectory . basename($_FILES['file']['name']);

    // cheque si le fichier existe déjà
    if (file_exists($targetFile)) {
        $fileStatus = '<div class="error-message">Le fichier existe déjà.</div>';
    } else {
        // cheque si le fichier est trop lourd (10 Mo)
        if ($_FILES['file']['size'] > $file_size) {
            $fileStatus = '<div class="error-message">Le fichier est trop lourd. 10Mo max</div>';
        } else {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFile)) {
                $fileStatus = 'Fichier téléchargé avec succès.';
            } else {
                $fileStatus = '<div class="error-message">Erreur lors du téléchargement du fichier.</div>';
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
    <title>maintenance</title>
    <link rel="stylesheet" href="../systeme/css/parisarebours.css">
</head>
<body>
    <!-- File Upload Form -->
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file" id="drop-container">
            <span id="drop-title">Déposez les fichiers ici</span>ou
            <input type="file" id="file" name="file" required>
            <?php echo $fileStatus;?>
        </label>
        <input type="submit" value="Upload File">
    </form>
    
    <h2>Fichiers disponibles en téléchargement:</h2>
    <ul>
        <?php
        $files = glob('uploads/*');
        foreach ($files as $file) {
            if (filesize($file) < 1024 * 1024) {
                $size = round(filesize($file) / 1024, 2) . ' KB';
            } else {
                $size = round(filesize($file) / (1024 * 1024), 2) . ' MB';
            }
            echo '<li><a href="test_serveur.php?file='. basename($file) .'">' .basename($file) .' </a> ' .$size .'</li>';
        }
        ?>
    </ul>
    <script src="../systeme/js/drag-drop.js"></script>
</body>
</html>
