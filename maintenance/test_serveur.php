<?php
$file_size = 10 * 1024 * 1024; //  10 MB taille maximun du fichier données!
$targetDirectory = 'uploads/'; // dossier par enregistrement données
$fileStatus = '';
/* condition si le dossier enregistrement existe pas on le crée */
if(!file_exists($targetDirectory)){
    mkdir($targetDirectory , 0777 , true);
}

if(isset($_POST['folder_name'])) {
    $newFolderName = $_POST['folder_name'];
    $newFolderPath =  $targetDirectory . $newFolderName;
    mkdir($newFolderPath, 0777, true);
}

/*  cree un cookie qui contient le nom du dossier choisi par l'utilisateur  */
if(isset($_POST['dossier_choisi'])){
   /* le cookie dur 1 heure donnée /  nom du cookie piratble à codé */
    setcookie('doschoix', $_POST['dossier_choisi'], time() + 3600, '/'); 
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['files'])) {
     /* tableau contenant les messages d'erreur */    
    $fileStatus = array();
    foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        $targetFile = $targetDirectory . basename($_FILES['files']['name'][$key]);

        /* vérifie si le fichier existe déjà */
        if (file_exists($targetFile)) {
            /* donnée en brut  */
            $fileStatus[] = "Le fichier " . $_FILES['files']['name'][$key] . " Le fichier existe déjà.";
        }
        else {
             /* vérifie si le fichier n'est pas trop lourd (10Mo max) */
            if ($_FILES['files']['size'][$key] > $file_size) {
                /* donnée en brut  */
                $fileStatus[] = "Le fichier " . $_FILES['files']['name'][$key] . " Le fichier est trop lourd. 10Mo max";
            }
            else {
                /* si le cookie dossier_choisi existe et s'il n'est pas vide, le fichier sera téléchargé dans le fichier choisi sinon le fichier sera téléchargé dans le fichier uploads */ 
                if (isset($_COOKIE['dossier_choisi']) && !empty($_COOKIE['dossier_choisi'])) {
                    /* la donnée répartoire existe déjà dans une variable */
                    $targetDirectory = 'uploads/' . $_COOKIE['dossier_choisi'] . '/';
                }
                else $targetDirectory = 'uploads/';
                            
                /* la fonction move_uploaded_file() déplace un fichier téléchargé dans le dossier sélectionné */
                if (move_uploaded_file($_FILES['files']['tmp_name'][$key], $targetDirectory . $_FILES['files']['name'][$key])) {
                    // $fileStatus[] = "Le fichier " . $_FILES['files']['name'][$key] . " a été téléchargé avec succès.";
                    $fileStatus[] = "succès";
                    setcookie('dossier_choisi', '', time() - 3600, '/');
                } 
                else $fileStatus[] = "Erreur lors du téléchargement du fichier " . $_FILES['files']['name'][$key];
            }
        }
    }
}


// File Download
if (isset($_GET['file'])) {
    $file = $targetDirectory. basename($_GET['file']);
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
    <link rel="stylesheet" href="../modules/tooltip/tooltip.css">
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
    
    <p>
    This is a test of another with apple,
</p>
<p>
    This is a test of another with apple,
</p> 
<p>
    This is a <span class="tooltip">test</span> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur totam nostrum commodi sint quaerat sit iusto voluptates quasi <span class="tooltip">test</span> illo! Voluptates nostrum doloremque locale_get_region soluta accusamus magnam <span class="tooltip">test</span> praesentium labore nesciunt natus fugiat. of  with apple,
</p>

<!-- <p class="tooltiptext">
    this is another test hope it works
    <img src="../modules/tooltip/icon/book.svg" class="learn_more">
</p> -->
<!-- tooltip poupup -->
<!-- <div id="tooltip-popup">
    
</div> -->
    <button id="popup_button">cree une dossier</button>
    <script src="../systeme/js/jquery3_7_1_min.js"></script>
    <script src="../systeme/js/drag-drop.js"></script>
    <script src="../modules/tooltip/tooltip.js"></script>
    <script src="../systeme/js/maintenance.js"></script>
</body>
</html>
