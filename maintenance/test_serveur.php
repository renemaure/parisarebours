

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

            // si c'est un dossier, on affiche son nom et la date de création si non on affiche le nom du fichier, la date de création et la taille du fichier en Ko ou Mo data-folder="'. basename($file) . '
            if(is_dir($file)) {
                echo '<li class="folder" ">'.basename($file)."<span>".$uploadDateAndTime."</span><span>Dossier</span></li>\n\r";
            }else{
                echo '<li><a href="test_serveur.php?file='.basename($file).'">'.basename($file)."</a> <span>".$uploadDateAndTime."</span><span>".$size."</span></li>\r\n";
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
    This is a <span class="tooltip">test</span> of <span class="tooltip">another</span> with apple,
</p>
<!-- tooltip poupup -->
<div id="tooltip-popup">
    
</div>
    <button id="popup_button">cree une dossier</button>
    <script src="../systeme/js/drag-drop.js"></script>
    <script src="../systeme/js/tooltip.js"></script>
    <script src="../systeme/js/maintenance.js"></script>
</body>
</html>
