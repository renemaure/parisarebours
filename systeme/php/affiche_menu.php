 <?php 

    /*
    fichier personalisé d'affichage du menu conçu par l'association collectif 11880.
    version 1.0.6 au 16/01/2022.  fichier personalisé pour reperechoppe89.com.
    */

           echo "<div id=\"logo-nav\">".$rn;
          if ($liens["typ_logo"]) {
            echo "<img src=\"".$chem_princ."/".$liens["dirimg"]."/".$liens["img_nav"]."\" alt=\"".$liens["txt_alt"]."\"/>".$rn;
          } 
          else{
          echo "<h1 id=\"logo\">".$rn;
          echo $liens["trt_home"].$rn;
          echo "</h1>";
         }
         echo "</div>".$rn;
         if ($liens["sous_trt"]) {
             echo "<div id=\"titre-adresse\">".$rn;
             include $dirlien.$liens["dirtxt"]."/".$affichtxt["trt_nav"].$lp;
            echo "</div>".$rn;
         }
         
         echo "<ul id=\"menu\">".$rn;
         Genenu($activ, $liens, $rn);      /* lance la fonction gérération du menu */
         echo "</ul>".$rn;

         // rajout logo et lien panier gérer par le javascript
         echo "<article id=\"logo_panier\">".$rn; 
         echo "<a href=\"".$liens["indic14"]["lien_pg"] ."\">".$rn; 
         echo "<img src=\"".$chem_princ."/".$liens["dirimg"]."/".$liens["img_panier"]."\"/>".$rn;
         echo "<span id=\"chif_pan\"></span>";
         echo "</a>";
         echo "</article>".$rn;

        if ($liens["lien_social"]) {
        echo "<article id=\"zon_conect\">".$rn; 
        if ($liens["auto_fb"]) {
            echo "<a href=\"".$liens["lien_fb"]."\" target=\"_blank\"><i class=\"bi bi-facebook\"></i></a>".$rn;
        }
        if ($liens["auto_insta"]) {
            echo "<a href=\"".$liens["lien_insta"]."\" target=\"_blank\"><i class=\"bi bi-instagram\"></i></a>".$rn; 
        }
         if ($liens["auto_youtube"]) {
            echo "<a href=\"".$liens["lien_youtube"]."\" target=\"_blank\"><i class=\"bi bi-youtube\"></i></a>".$rn; 
        }
    echo "</article>".$rn; 
  }  
?>