<?php 
	$pointpoint="";
	include("php/generateur_code.php"); /* active les fonctions d'affichage de partie de code html */
	$commun = jsource($pointpoint);
?>
<!DOCTYPE html>
<html> 
<!-- fichier index databulles html5 Date de création: 05/07/2015 -->
<head> 
	<?php generathead($pointpoint)?>
</head>
<body>
	<div data-role="page" data-theme="a" id="liste" data-fullscreen="true">
		
		<div data-role="content" class="corps_index">  
			<img src="images/databulles_icon2.jpg" class="re l9 v-15 box_border coins_rond"/>
			<div class="box_border box_fond coins_rond aff_infos">
				<p class="t15 centrer"><?php echo ucfirst(verifnom());?> Bienvenu sur l'aplication <span class="gras">Databulles</span></p>
				<p class="t15">Cette aplication permet de cr&eacute;&eacute;e une zone de 
				donn&eacute;es géolocalis&eacute;e, et d&apos;y mettre des images ou du texte, pouvant peut &ecirc;tre 
				lu ou  comment&eacute;e par autres utilisateurs pourvu qu&apos;ils soient pr&eacute;sent dans le 
				<span class="gras">Databulle</span> cr&eacute;&eacute;e!</p>
				<div id="zon_bout" class="t20"></div>
			</div>
		</div>
			<?php footer($pointpoint); ?> <!-- génére le footer directement-->
	</div>
	
		<!--page information-->	
	<div data-role="dialog" data-theme="a" id="information">
		<div data-role="header">
			<h1>Information Databulles</h1>
		</div>
		<div data-role="content"> 
			<p class="justifier f9">Pour pouvoir entrer l'application Databulles, vous devez vous logger avec votre pseudo 
			et votre mot de passe. Si vous avez oublié votre mot de passe, cliquez sur Identifiants perdu, 
			si vous n'avez pas encore de pseudo, cliquez sur Enregistrement.</p>
			
			<p class="t5 justifier f9">Pour pouvoir vous suivre tout au long de l'application Databulles, nous utilisons
			des cookies, conserver durant un an. Vous pouvez en allant dans préférence, gérer vous même 
			la durée de conservations de vos cookies ! </p>
		</div>
		
	</div>
	
	<?php 	if (!isset($_COOKIE['nom'])) include("php/enregistrement.php");/* affichage des pages enregistrement */ ?>
	
	<?php credit($pointpoint); ?> 
		
<script><?php jsonjs($pointpoint);?></script>

<script src="bin/js/databulles.js"></script>
<script>gestbout()</script>

</body>
</html>	