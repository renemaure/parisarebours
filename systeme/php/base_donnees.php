<?php
/* 
	fichier g�n�rique collectif 11880 g�rant la connextion � la base de donn�e
	
	version 3.0.0  au 11 aout 2015

	passage en PDO orient� objet et ajout du traitement des erreurs!

	on garde la m�me variable $laison cr�ation de deux comptes: local et internet
*/

/* tableau en local */
$config = array(
	'host'      => 'localhost',
	'username'  => 'root',
	'passeword' => '',
	'database'  => 'collecp11880'
);

/* tableau sur intenet */
/* 	$config = array(
	'host'      => 'collecp11880.mysql.db',
	'username'  => 'collecp11880',
	'passeword' => 'Renemaure008',
	'database'  => 'collecp11880'
); */
try{
	$laison = new PDO('mysql:dbname='.$config['database'].';host='.$config['host'].";charset=utf8",$config['username'],$config['passeword']);	
} 
catch(PDOException $exception){
	 echo($exception->getMessage());  //pas diffusion sur internet qu'en mode local!'
exit('erreur de conexion a la PDO');
}
?>