<?php
 /*
    fichier d'intallation des modules utilisés au sein des sites de l'association Collectif 11880
    version 1.0.3 au 09/10/2023. 
    fichier concu au départ pour le site www.parisarebours.org
    
    premièrs ajout au 24/09/2023:
    1) installation du module "blog" dans le head
    2) installation du module "Header" dans le body
    3) lancement du fichier css icons de bootstrap inclu dans le module "header"

*/

/* lancement du fichier css icons de bootstrap inclu dans le module "header" 01/10/2023 */
echo "<link href=\"modules/header/bootstrap-icons.css\" rel=\"stylesheet\">";

/* condition pour lancer le module blog ou non modif du 01/10/2023 */
if ($liens["mod_blog"]) include("modules/blog/installblog.php");

echo $rn."</head>".$rn."<body>".$rn;

/* modif module header 09/10/2023 rajout d'une condition si le module est utilisé */
if ($liens["auto_menu"]) include "modules/header/affiche_menu.php";

?>