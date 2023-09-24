<?php
/*
	fichier d'affichage du menu pour les sites conçu ou gérer par l'association collectif 11880.
	version 1.2.4 au 04/08/2022.
	fichier libre d'utilisation en sitant l'association collectif11880.org.
	modifs importantes:
	rajout condition avec valid pour activer ou non un élémént du menu
	modif variable $activ egale à l'indice du lien dans le menu
*/

function Genenu($activ, $liens, $rn)
{
	$activli = true;
	for ($menu=1; $menu <=$liens["nbr_menu"]; $menu++)
    { 
   		if ($liens["indic".$menu]["valid"])
   		{ 
	  	 	echo "<li";	
			if ($activ==$menu)
			{
    			if ($liens["activ_li"])	echo " class=\"active\"><a";
				else echo "><a class=\"active";		
			
				if ($liens["css_a_menu"]!="")
				{
					echo" ".$liens["css_a_menu"]."\" ";
				}
				else
				{
					if ($liens["activ_li"]== false)
					{
						echo"\" ";
					}
				}
			}
    		else{
    			echo "><a";
    			if ($liens["css_a_menu"]!="")
    			{
    				echo " class=\"".$liens["css_a_menu"]."\"";
    			}
    		}
    	echo " href=\"".$liens["indic".$menu]["lien_pg"]."\">".$liens["indic".$menu]["trt_menu"]."</a>".$rn;
       	echo "</li>".$rn;
   		} 
	}
}
?>	