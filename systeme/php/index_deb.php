<?php
	/*
		Fichier de gestion pour la navigation des sites conçu ou gérer par l'association collectif 11880 

	 	Date de création: 18/02/2012  / version 5.0.0 alpha au 15/10/2023.

	 	Ce fichier est libre d'utilisation en citant l'association: www.collectif11880.org.

	 	Nouvelle version 5: 

			la nouvelle version permet d'intégrer le mode front-end et back-end avec la gestion des liens du menu par le javascript.
			le code de la version 4 fonctionnant grace au php devient une option definie dans le fichier json : donnees_site.json à la racine du site.

	 	Si vous vouyez un bug ou une amélioration contactez le collectif sur infos@collectif11880.com, on sitera votre nom, merci!
	*/
	
	/* extensions utilisées pour le site */
	$rn = "\r\n";
	$lp = ".php";
	$lh = ".html";
	$lxt = ".txt";
	
	//verifier à quoi correspondent ses deux variables!
	$aside = false; 
	$v_tbrd = true;
	
	if ($demar["tabbord"]) 	include ("tabbord_deb.php"); 

	$json = file_get_contents($chem_princ."/donnees/".$jsonsite.".json");
	$liens = json_decode($json, true);

	$dirlien = $liens["dirlien"]."/";// permet d'indexer le repertoire

	/* version 5: cette variable n'a rien a faire ici elle doit etre dans le dossier blog */
	$fich_blog = $liens["index"]; // variable lance le blog sur une page unique 
	

	/* variables par défaut pour afficher la page en index */
	$affpg =  $dirlien.$liens["index"].$lp; 

	$activ = "1"; //à modifier, faire une variable json
	if ($liens["aside"]){
		$affasi =  $dirlien.$liens["fich_aside"].$lp; 
		$aside = true;
	}
	/* requetes en get */
	if(isset($_GET['pg'])) {
		$pgmain = $_GET['pg'];// rajout d'une variable 23/09/2023
		$affpg =  $dirlien.$liens["indic".$pgmain]["lrm"].$lp;
		if(isset($_GET['act'])) $activ = $_GET['act'];
		else  $activ = $_GET['pg']; 
		/* modification du 08/10/2023 pour les orgues d'auxerre */
		if (isset($_GET['sm'])) {
			$sous_menu = $_GET['sm'];
			$affpg = $dirlien.$liens["indic".$pgmain]["sous_menu"]["lrm_".$sous_menu].$lp;
			// echo $liens["indic".$pgmain]["sous_menu"]["lrm_".$sous_menu];
		}
		if (isset($_GET['asi'])) {
			$affasi =  $dirlien.$liens["indic".$_GET['pg']]["arm"].$lp;
			$aside = true;
		}
		/*si la variable 'aupg' existe elle reference en BDD une table produit le 23/09/2023*/
		if(isset($_GET['aupg'])){
			$autopg = $_GET['aupg'];
		}
	}
        /*  en option fichier list-elements.json. contient tous les nons des éléments à afficher sur le site 	 */
	if($liens["list"]){
		$lstelemt = file_get_contents($chem_princ."/donnees/list-elements.json");
		$affichtxt = json_decode($lstelemt, true);
	}
	/* générateur de menu: appel de la fonction dans <ul> avec  <?php Genenu($activ, $liens, $rn);  */
	if ($liens["auto_menu"]) include ($chem_princ."/php/menu_deb.php");
?>	