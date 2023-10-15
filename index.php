<?php 
//   session_start();// bug possible
  $json = file_get_contents("donnees_site.json");
  $demar = json_decode($json, true);
  $chem_princ =$demar["chem"]; 
  // $jsonsite = $demar["f_json"];  a definir dans index_deb
  include($chem_princ."/php/index_deb.php");
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="aplication parisarebours.org">
    <meta name="author" content="association Collectif 11880, club CMIT">
    <meta name="generator" content="Collectif 11880">
    <title>Paris à rebours</title>
    <link href="systeme/css/parisarebours.css" rel="stylesheet">
  <?php 
 /*  modif au 08/10/2023 rajout d'un fichier installation des blogs */
    include $chem_princ."/php/instal_module.php";
    /* modification au 09/10/2023 rajout d'un container pour installer une grille*/
    echo "<div id=\"container\">".$rn;
    /* modification de variable utilise celle en json v5 15/10/2023*/
    if ($liens["aside"]){
      echo"<aside id=\"aside\">".$rn; 
      include $affasi; 
      echo "</aside>".$rn;
      echo"<main id=\"main\">".$rn;
    } else echo"<main id=\"main_total\">".$rn; 
    include $affpg; 
    echo "</main>".$rn."</div>".$rn;
    $laison=NULL;
 ?>
 <script src="systeme/js/parisarebours.js"></script>
  </body>
</html>
