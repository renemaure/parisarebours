 <?php 

    /*
    fichier personalisé d'affichage du menu conçu par l'association collectif 11880.
    version 1.1.2 au 09/10/2023.  
    fichier personalisé au départ pour le site www.reperechoppe89.com.
    remis à jour pour Parisarebours
    dernieres modifs importante au 24/09/2023:
    1) rajout d'une condition true/false avec la variable "panier" définit dans le json peronalisé
    2) corection d'un bug si la variable "auro_menu est false cela provoquais une erreur, car on avait plus accées a la fonction genenu
    modif 09/10/2023 rajout ligne quote html <header> pour parisarebours
    rajout d'une condtiiton pour ecriture pour type de quote html header ou nav
    */
    if ($liens["quote_html"]) echo "\t<header>".$rn;
    else  echo "\t<nav id=\"navbar\">".$rn;
    echo "<div id=\"logo-nav\">".$rn;
    if ($liens["typ_logo"]) {
      echo "<img src=\"".$chem_princ."/".$liens["dirimg"]."/".$liens["img_nav"]."\" alt=\"".$liens["txt_alt"]."\"/>".$rn;
    } else{
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
         /* corection de bug 24/09/2023 2) lance la fonction gérération du menu */
         if ($liens["auto_menu"]){ 
         echo "<ul id=\"menu\">".$rn;
         Genenu($activ, $liens, $rn);     
         echo "</ul>".$rn;
         }
        /*  modif 1) 24/09/2023 rajout logo et lien panier gérer par le javascript */
         if ($liens["panier"]) {
          echo "<article id=\"logo_panier\">".$rn; 
          echo "<a href=\"".$liens["indic14"]["lien_pg"] ."\">".$rn; 
          echo "<img src=\"".$chem_princ."/".$liens["dirimg"]."/".$liens["img_panier"]."\"/>".$rn;
          echo "<span id=\"chif_pan\"></span>";
          echo "</a>";
          echo "</article>".$rn;
         }
         /* nouveau 3) 24/09/2023 rajout de code pour une fonction de recherche pour le site www.parisarebours.org*/
         if ($liens["recherche"]) {
          echo" <input class=\"form-control\" type=\"text\" placeholder=\"".$liens["trt_rech"]."\" aria-label=\"Search\"";
         }
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
    if ($liens["quote_html"]) echo "</header>".$rn;
    else echo "</main>".$rn;
  }  
?>