<?php 
  // session_start();// bug possible
  $json = file_get_contents("../donnees_site.json");
  $demar = json_decode($json, true);
  $chem_princ = "../".$demar["chem"]; 
  $jsonsite = $demar["f_json"]; 
  include($chem_princ."/php/index_deb.php");
  // include_once ($chem_princ."/php/base_donnees.php");
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="aplication parisarebours.org">
    <meta name="author" content="">
    <meta name="generator" content="Collectif 11880">
    <title>Paris à rebours</title>
    <!--que pour test a virer ensuite -->
    <!-- <link href="systeme/bootstrap/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- fin -->
    <link href="../systeme/css/parisarebours.css" rel="stylesheet">
    <link href="../systeme/css/entrer_securiser.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <?php include($chem_princ."/php/affiche_menu.php");  ?>
       
    </header>
    <aside id="menu-aside">
      encore rien ici <?php echo $chem_princ."/php/affiche_menu.php";  ?>
     </aside>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <?php  include "../pages/entrer_seruriser.php"; ?>
    </main>
  <script src="../systeme/js/parisarebours.js"></script>
  </body>
</html>
