<?php
/* fichier générique collectif 11880
gérant la connextion a la base de donnée
réecrit le 11 aout 2015
version3 
passage en PDO orienté objet
et ajout  traitement erreur!

on garde la même variable $laison

création de deux comptes un local
 et un pour internet*/

/* tableau en local */
$config = array(
	'host'      => 'localhost',
	'username'  => 'root',
	'passeword' => '',
	'database'  => 'databulles'
);

/* tableau sur intenet */

/* 	$config = array(
	'host'      => 'pascalrokdpascal.mysql.db',
	'username'  => 'pascalrokdpascal',
	'passeword' => 'Prunelle007',
	'database'  => 'pascalrokdpascal'
); */

try{
	$laison = new PDO('mysql:dbname='.$config['database'].';host='.$config['host'].";charset=utf8",$config['username'],$config['passeword']);	
} 
catch(PDOException $exception){
	/* echo($exception->getMessage()); */ //pas diffusion sur internet qu'en mode local!'
exit('erreur de conexion a la PDO');
}
?>