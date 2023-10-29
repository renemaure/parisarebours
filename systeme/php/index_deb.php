<?php
	/*
		Fichier de gestion pour la navigation des sites conçu ou gérer par l'association collectif 11880 créée le 18/02/2012  
		
		Actuellement à la version 5.0.4 au 29/10/2023.

	 	Ce fichier est libre d'utilisation en citant l'association: www.collectif11880.org.

		modif au 29/10/2023 par pascal:
			ajout d'une variable $pg_court contenant le nom de la page courante pour faire fonctionner les modules
			récuperation d'une condition de la version 4.20.2 pour lancer l'installation du module blog à réecrire pour la version 5 et accecible pour tous les modules
			corction d'un bug vesrsion 2:
			oubli de déclarer la variable $v_tbrd à false par défaut. elle renseige de l'activation ou non du module tabbord
	 	Nouvelle version 5: 
			la nouvelle version permet d'intégrer le mode front-end et back-end avec la gestion des liens du menu par le javascript.

			le code de la version 4 fonctionnant grace au php devient une option definie dans le fichier json : donnees_site.json à la racine du site.

			supression de toutes données en dur, elles sont définie dans le fichier json donnees_site.json
			rajout de [ok_v5] pour les morceaux de codes validés.
			
		Si vous vouyez un bug ou une amélioration contactez le collectif sur infos@collectif11880.com, on sitera votre nom, merci!
	*/
	
	/* extensions utilisées pour le site [ok_v5]*/
	$rn = "\r\n";
	$lp = ".php";
	$lh = ".html";
	$lxt = ".txt";
	$jsn = ".json"; // nouvelle variable pour extention json V5

	$v_tbrd = false; // bug version 5 variable definisant si le tabbord est actvé ou non

	/* condition pour lancer le module tab_bord  et lancer soit le fichier json tabbord ou celui du site [ok_v5]*/
	if ($demar["tabbord"]) 	include ($demar["fich_instal"]); 
	else  $jsonsite = $demar["f_json"];
	/* récupération du fichier json de personalisation du site [ok_v5] */
	$json = file_get_contents($chem_princ."/".$demar["dirdonne"]."/".$jsonsite.$jsn);
	$liens = json_decode($json, true);
	/*  variable permet d'indexer le repertoire contenant les pages du site [ok_v5] */
	$dirlien = $liens["dirlien"]."/";
	/* variables par défaut pour afficher la page en index [ok_v5] */
	$affpg =  $dirlien.$liens["index"].$lp; 
	$pg_court = $dirlien.$liens["index"]; // référence la page en cours d'affichage.
	/* modifier par une variable json possibilité de bug l'ancienne variable était en string!! [ok_v5] */
	$activ = $liens["defactiv"]; 
	/* récuperation du nom du fichier à affiché en aside par défaut */
	if ($liens["aside"]) $affasi =  $dirlien.$liens["fich_aside"].$lp; 
	/* modification pour la version 5 rajout d'une condition optionnelle pour l'utilisation des requetes en get */
	if($demar["liens_get"]){
		if(isset($_GET['pg'])) {
			$pgmain = $_GET['pg'];
			$affpg =  $dirlien.$liens["indic".$pgmain]["lrm"].$lp;
			$pg_court =  $dirlien.$liens["indic".$pgmain]["lrm"];
			if(isset($_GET['act'])) $activ = $_GET['act'];
			else  $activ = $_GET['pg']; 
			/* modification du 08/10/2023 pour les orgues d'auxerre  condition géstion des liens de type inside*/
			if (isset($_GET['sm'])) {
				$sous_menu = $_GET['sm'];
				$affpg = $dirlien.$liens["indic".$pgmain]["sous_menu"]["lrm_".$sous_menu].$lp;
				$pg_court = $dirlien.$liens["indic".$pgmain]["sous_menu"]["lrm_".$sous_menu];
			}
			if (isset($_GET['asi'])) $affasi =  $dirlien.$liens["indic".$_GET['pg']]["arm"].$lp;
			/*condition pour que variable 'aupg' reference le nom d'une table en BDD le 23/09/2023*/
			if(isset($_GET['aupg'])) $autopg = $_GET['aupg'];
		}
	}
        /*  condition pour utiliser le fichier list-elements.json, qui contient des données optionelles à afficher sur le site. entierement réecrit pour la version 5 */
	if($liens["list"]){
		$lstelemt = file_get_contents($chem_princ."/".$demar["dirdonne"]."/".$demar["nom_elmemnt"].$jsn);
		$affichtxt = json_decode($lstelemt, true);
	}
	/* générateur de menu: appel de la fonction dans <ul> avec  <?php Genenu($activ, $liens, $rn); entierement réecrit pour la version 5*/
	if ($liens["auto_menu"]) include ($chem_princ."/".$demar["dirphp"]."/".$demar["instl_automn"].$lp);
	/* nouveau apple du module blog au 01/10/2023 à réecrire pour la version 5*/
	if ($liens["mod_blog"]) include ($chem_princ."/php/instal_module_blog.php");
		

?>	