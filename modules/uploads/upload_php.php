<?php
$file_size = 10 * 1024 * 1024; //  10 MB taille maximun du fichier données!
$targetDirectory = 'uploads/'; // dossier par enregistrement données
$fileStatus = '';
/* condition si le dossier enregistrement existe pas on le crée */
if(!file_exists($targetDirectory)){
    mkdir($targetDirectory , 0777 , true);
}

/* création d'un nouveau dossier */
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


// téléchargement d'un fichier sur le dossier local
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