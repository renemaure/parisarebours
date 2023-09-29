<?php
$file_size = 10 * 1024 * 1024; //  10 MB
$targetDirectory = 'uploads/';
$fileStatus = '';
$error_state = '';
if(!file_exists($targetDirectory)){
    mkdir($targetDirectory , 0777 , true);
}
if(isset($_POST['folder_name'])) {
    $uploadsDir = 'uploads/';
    $newFolderName = $_POST['folder_name'];
    $newFolderPath =  $uploadsDir .$newFolderName;

    if (!file_exists($newFolderPath)) {
        mkdir($newFolderPath, 0777, true);
        echo "New folder created successfully at " . $newFolderPath;
    } else {
        echo "Folder already exists at " . $newFolderPath;
    }
}
if(isset($_POST['dossier_choisi'])){
    $dossier_choisi = $_POST['dossier_choisi'];
    $targetDirectory = 'uploads/' . $dossier_choisi . '/';
       if(!file_exists($targetDirectory)){
            mkdir($targetDirectory , 0777 , true);
        }
    echo $targetDirectory;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
    $fileStatus = array(); // une array qui contient les messages d'erreur
    
    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        $targetFile = $targetDirectory . basename($_FILES['files']['name'][$key]);

        // cheque si le fichier existe déjà
        if (file_exists($targetFile)) {
            $fileStatus[] = "Le fichier " . $_FILES['files']['name'][$key] . " existe déjà.";
        } else {
            // cheque si le fichier est trop lourd 10Mo max
            if ($_FILES['files']['size'][$key] > $file_size) {
                $fileStatus[] = "Le fichier " . $_FILES['files']['name'][$key] . " est trop lourd. 10Mo max";
            } else {
                if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $targetDirectory . $_FILES['files']['name'][$key])) {
                    $fileStatus[] = "Le fichier " . basename($targetDirectory) . " a été téléchargé avec succès.";
                    // $fileStatus[] = "succès";
                } else {
                    $fileStatus[] = "Erreur lors du téléchargement du fichier " . $_FILES['files']['name'][$key];
                }
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
        exit();
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
    <!-- popup cree dossier -->
    <div id="popup_container">
        <img src="../systeme/img/icon/x.svg" alt="close" id="close">
        <h2>Créer un dossier</h2>
        <input type="text" id="folder_name" placeholder="Nom du dossier">
        <button id="folder_button">Créer</button>
    </div>
    <!-- fin de popup -->
    <!-- File Upload Form --> 
    <form action="" method="post" enctype="multipart/form-data">
        <label for="file" id="drop-container">
            <span id="drop-title">Déposez les fichiers ici</span>ou
            <input type="file" id="file" name="files[]" required multiple>
            <?php 
            if(!empty($fileStatus)){
                foreach($fileStatus as $status){
                    if($status != 'succès'){
                        echo '<span class="success">' . $status . '</span>';
                    }
                }
            }
            ?>
        </label>
        <button type="submit" id="upload-button">Upload Files</button>
    </form>

    
    <ul id="file-container">
    <h2>Fichiers disponibles en téléchargement:</h2>
        <?php
        $files = glob('uploads/*');
        foreach ($files as $file) {
            // si le fichier est inférieur à 1 Mo, il affiche la taille en Ko sinon en Mo
            if (filesize($file) < 1024 * 1024) {
                $size = round(filesize($file) / 1024, 2) . ' KB';
            } else {
                $size = round(filesize($file) / (1024 * 1024), 2) . ' MB';
            }
            // filetime() renvoie la date de la dernière modification du fichier $uploadTimestamp formaté en date et heure
            $uploadTimestamp   = filemtime($file);
            $uploadDateAndTime = date("d/m/Y H:i:s", $uploadTimestamp);
            // si le fichier est un dossier, il affiche le nom du dossier et la date de création si non il affiche le nom du fichier, la date de création et la taille du fichier en Ko ou Mo
            if(is_dir($file)) {
                echo '<li class="folder" data-folder="'. basename($file) . '"><a>' . basename($file) . "</a> <span>". $uploadDateAndTime." </span> <span>Dossier</span> </li>";
            }else{
                echo '<li><a href="test_serveur.php?file=' . basename($file) . '">' . basename($file) . "</a> <span>" . $uploadDateAndTime . " </span>" . "<span>" . $size . "</span>" . "</li>";
            }
        }
        ?>
    </ul>
    <button id="popup_button">cree une dossier</button>
    <script src="../systeme/js/drag-drop.js"></script>
    <script src="../systeme/js/maintenance.js"></script>
</body>
</html>
