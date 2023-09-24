<?php 
  session_start();// bug possible
  $json = file_get_contents("donnees_site.json");
  $demar = json_decode($json, true);
  $chem_princ =$demar["chem"]; 
  $jsonsite = $demar["f_json"]; 
  include($chem_princ."/php/index_deb.php");
  include_once ($chem_princ."/php/base_donnees.php");
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
    <link href="systeme/css/parisarebours.css" rel="stylesheet">
  </head>
  <body>
    <header>
        <?php  include $chem_princ."/php/affiche_menu.php"; ?>
    </header>
    <aside id="menu-aside">
      <ul>
          <li>
            <a href="#">Dashboard</a>
          </li><li>
            <a href="#">Orders</a>
          </li><li>
            <a href="#">Products</a>
          </li><li>
            <a href="#">Customers</a>
          </li><li>
            <a href="#">Reports</a>
          </li>
        </ul>

        <!-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li>
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li>
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li>
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li>
            <a class="nav-link" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul> -->
      </aside>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div id="btn_zoom">
            <button type="button" onclick="agrandir()">Zoom +</button>
            <button type="button" onclick="diminuer()">Zoom -</button>
          </div>
      <!-- zone d'affichage de la map -->
      <!-- <canvas class="my-4 w-100" id="map_paris" width="900" height="410"> -->
      <section id="map_paris" width="900" height="410">
        <!-- <img src="images/plans/test_plan-paris.png" id="plan1"> -->
      </section>
    </main>
  <script src="systeme/js/parisarebours.js"></script>
  </body>
</html>
