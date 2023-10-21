<?php /* Date de création: 08/11/2013 */

	include("php/base_donnees.php");
	
	$erreur = array("erreur"=>"ok");
	
	$timestamp_expire = time() + (3600*24*365); // Le cookie expirera dans 1 an
	
	$result_compt = $laison->query("SELECT * FROM mon_compte");
	
	/* verification pour logger */
	
	if (isset($_POST['nom_log']){
		$pass = md5($_POST['pass_log']) ;  
		while ($data = $result_compt->fetch(PDO::FETCH_ASSOC)){ 
        	if ($pass == $data['passe'] and  $_POST['nom_log'] == $data['nom'])	{
				setcookie('nom',$_POST['nom_log'], $timestamp_expire, '/'); // On écrit un cookie en rajout '/ ' lisible par tout le site 
				echo json_encode($erreur);
				break;
			}
		$erreur["erreur"]='logger_err';
		echo json_encode($erreur);
		}
	}
	
	
 ?>
