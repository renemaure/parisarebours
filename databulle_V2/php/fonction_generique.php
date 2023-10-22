<?php

function bdd_databulle($ref_dtb,$dir=''){
	
	include($dir."base_donnees.php");
	
	$query = $laison->query("SELECT * FROM bd_databulles where ref_dtb='".$ref_dtb."'");

	$data_dtb = $query->fetch(PDO::FETCH_ASSOC);
	
	return $data_dtb;
}

function aff_donnee_met($multi_text,$donnee){
	
		$text = $multi_text[1]."Cr&eacute;er le: ".$multi_text[2].$donnee['date_creat'].$multi_text[3];
		$text .= $multi_text[1]."par: ".$multi_text[2].$donnee['nom_creat_dtb'].$multi_text[3];
		$text .= $multi_text[1]."Longitude: ".$multi_text[2].$donnee['long_dtb'].$multi_text[3];
		$text .= $multi_text[1]."Latitude: ".$multi_text[2].$donnee['lat_dtb'].$multi_text[3];
		$text .= $multi_text[1]."Adresse: ".$multi_text[2].$donnee['adresse_longue_dtb'].$multi_text[3];
		return $text;
}

function multi_text($var_tab){
	$multi_text = array();
	$gene_txt = array();
	$multi_text[8] = "<p class=\"";
	$multi_text[9] = "<span class=\"gras\">";
	$multi_text[1] = $multi_text[8]."t".$var_tab[1]."\">".$multi_text[9];
	$multi_text[2] = "</span><span class=\"italique\">";
	$multi_text[11] = " titre_otis";
	$multi_text[4] = "<hr class=\"t".$var_tab[2]."\">\n\r";
	$multi_text[5] = $multi_text[8].$multi_text[11]." t5\">";
	$multi_text[6] = "</p>\n\r";
	$multi_text[7] = "</span>";
	$multi_text[3] = $multi_text[7].$multi_text[6];
	$multi_text[10] = $multi_text[5]."Commentaires".$multi_text[6];
	$multi_text[12]= $multi_text[8].$multi_text[11]."\">";
	return $multi_text;
  }
 function indice_ref($ref_don,$dir=''){
	 
	include($dir."base_donnees.php");
	
	$date_jour = date('d/m/Y');
	
	$query = $laison->query("SELECT * FROM indice_table where type_donnee='".$ref_don."'");

	$data_dtb = $query->fetch(PDO::FETCH_ASSOC);
	
	if($date_jour == $data_dtb['date_creat']){
		$indic_don = $data_dtb['ref_data'];
		$data_dtb['ref_data']++;
	}else{
		$data_dtb['ref_data']= 1;
		$indic_don = 1;
	}
	$laison->query("UPDATE indice_table SET date_creat = '".$date_jour."', ref_data ='".$data_dtb['ref_data']."' WHERE type_donnee = '".$ref_don."'" );	
	
	return $ref_don.date('dmy').sprintf('%04d', $indic_don);
 } 
  
?>