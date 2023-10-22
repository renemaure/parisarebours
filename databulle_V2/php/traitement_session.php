<?php /* Date de cr�ation: 08/11/2013 */

	include("php/base_donnees.php");
	
	include ("php/fonction_generique.php");
	
	$erreur = array("erreur"=>"", "test"=>"");
	
	$timestamp_expire = time() + (3600*24*365); // Le cookie expirera dans 1 an
	
	$result_compt = $laison->query("SELECT * FROM mon_compte");
	
	$date_creat = date("d m Y");
	
	/* verification pour logger */
	
	if (isset($_POST['nom_log'])){
		$pass = md5($_POST['pass_log']) ;  
		while ($data = $result_compt->fetch(PDO::FETCH_ASSOC)){ 
        	if ($pass == $data['passe'] and  $_POST['nom_log'] == $data['nom'])	{
				setcookie('nom',$_POST['nom_log'], $timestamp_expire, '/'); // On �crit un cookie en rajout '/ ' lisible par tout le site 
				$erreur["erreur"]='ok';
				break;
			}
		}
		if($erreur["erreur"]!='ok') $erreur["erreur"]='logger_err';
	}
	
	/* -----   traiterment pour enregistrement ------*/

	if (isset($_POST['nom_erg'])){
		$nom_erg = $_POST['nom_erg'];
		$pass_erg = $_POST['pass_erg'];
		$mail_erg = $_POST['mail_erg'];
	
		if(strlen($nom_erg)>=4 and strlen($nom_erg)<=20) // variable nom_erg entre 4 et 20 caracteres
		{
			while ($data = $result_compt->fetch(PDO::FETCH_ASSOC)){ /*requette sur les noms pour eviter les doublons*/
				if (trim($_POST['nom_erg']) == $data['nom'] ) {
					$erreur["erreur"]= "speudo_err"; // pseudo d�j� prit
					break;
				}
			}	
		}else $erreur["erreur"]="nom_err"; // nom trop court ou trop long
			
		if($erreur["erreur"]==""){ //test s'il n'y a pas d'erreur 
			if(strlen($pass_erg)>=5 and strlen($pass_erg)<=12) // variable passe_erg entre 6 et 12 caracteres
			{
				$pass = md5($pass_erg); // codage md5
				if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',str_replace('&amp;','&',$mail_erg))){
					$ref_uti = indice_ref('uti','php/');
					/* Ex�cution d'une requ�te pr�par�e en liant des variables PHP */
					$sth = $laison->prepare("INSERT INTO mon_compte (nom, ref_utilisateur, mail, passe, date) VALUES(:nom , :refuti , :mail , :passe , :date)");
					$sth->bindParam(':nom', $nom_erg, PDO::PARAM_STR, 20);
					$sth->bindParam(':mail', $mail_erg, PDO::PARAM_STR, 12);
					$sth->bindParam(':passe', $pass, PDO::PARAM_STR, 12);
					$sth->bindParam(':date', $date_creat, PDO::PARAM_STR, 12);
					$sth->bindParam(':refuti', $ref_uti, PDO::PARAM_STR, 12);
					$sth->execute();
					setcookie('nom',trim($_POST['nom_erg']), $timestamp_expire, '/'); // On �crit un cookie en rajout '/ ' lisible par tout le site 
					$erreur["erreur"]= "ok";
					
				}else $erreur["erreur"]="mail_err" ; // mail invalide
					
			}else 	$erreur["erreur"]="pass_err"; //mot de passe trop court ou trop long
		}
	}	
	
		/* -----   traiterment pour perdu ------*/
		
	if (isset($_POST['mail_per'])){
		$characts    = 'abcdefghijklmnopqrstuvwxyz';
		$characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';	
		$characts   .= '1234567890'; 
		$code_aleatoire = ''; 
		while ($data = $result_compt->fetch(PDO::FETCH_ASSOC)){ 
        	if (trim($_POST['mail_per']) == trim($data['mail'])){
				$mail_per = $data['mail'];
				$erreur["erreur"]='ok';
				break;
			}
		}
		if($erreur["erreur"]=='ok'){
				for($i=0;$i < 10;$i++)    //10 est le nombre de caract�res
					{ 
						$code_aleatoire .= $characts[rand()%strlen($characts)];  
					}
				$temp_reponse = time()*(60*60*24); //timestamp +24 heures!
				
				$adr_retour = "http://www.collectif11880.com?cde=".$code_aleatoire; //fabrication de l'adresse de mofofoication
				
				$contenu_mail = ""; // texte du mail
				
				$contenu_mail .= "Vous avez demand&eacute; &agrave; changer votre mot de passe. Cliquez sur le lien ou copier l&aposadresse suivante�:\r\n\r\n";
				
				$contenu_mail .= "<a href=\"".$adr_retour."\">".$adr_retour."</a>\r\n\r\n";

				$contenu_mail .= "Ce lien est valable pendant 24 heures, &agrave; compter de l&apos;envoie de ce mail, au del&agrave;, il vous faudra redemander un nouveau mail�!\r\n\r\n";
				
				$contenu_mail .= "Le webmaster.";
				
				//envoi du mail
				if (mail($mail_per, 'mot de passe perdu sur Databulles', $contenu_mail)) {
					$erreur["erreur"]='ok';
					// remplir la table gestion mail
					$sth = $laison->prepare("INSERT INTO identifiant (timestamp, mail,cleverif) VALUES(:timestamp , :mail , :cleverif)");
					$sth->bindParam(':timestamp', $temp_reponse, PDO::PARAM_STR, 20);
					$sth->bindParam(':mail', $mail_per, PDO::PARAM_STR, 12);
					$sth->bindParam(':cleverif', $code_aleatoire, PDO::PARAM_STR, 12);
					$sth->execute();
				} else {
					$erreur["erreur"]='envoi_err';
				}
		}
		else $erreur["erreur"]='perdu_err';
	}
echo json_encode($erreur);
 ?>
