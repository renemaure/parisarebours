<!-- page perdu -->	
	<div data-role="dialog" data-theme="a" id="perdu">
		<div data-role="header">
			<h1>Identifiants pardus</h1>
		</div>
		<form data-role="content"> 
			<legend class="f9 italique">Indiquez votre mail pour recevoir votre mot de passe</legend>
			<p class="f9 t5 rouge italique centrer" id="erreur_err"></p>
			<input id="mail_per" size="20" maxlength="40" type="email" required placeholder="Votre mail"  data-clear-btn="true" data-mini="true" data-theme="b"> 
			<div class="centr_bout">
				<input value="validez" id="envoi_err" type="button" data-mini="true"data-inline="true">
				<a href="#info_perdu"  data-role="button" data-mini="true" data-inline="true" >Information</a>
			</div>
		</form>
		<?php footer($pointpoint); ?> <!-- génére le footer directement-->
	</div>
	<!-- page enregistrement -->
	<div data-role=dialog data-theme=a id="enregistrer"  data-add-back-btn=true>
		<div data-role="header">
			<h1>Enregistrement </h1>
		</div> 
		<form data-role="content" > 
			<legend class="f9 italique">Remplissez tous les champs et validez</legend>
			<p class="f9 rouge italique centrer" id="erreur_erg"></p>
			<input id="nom_erg" size="20" maxlength="40" type="text"  required placeholder="Votre pseudo" data-clear-btn="true" data-mini="true" data-theme="b"> 
			<input id="mail_erg" size="20" maxlength="40" type="email" required placeholder="Votre mail"  data-clear-btn="true" data-mini="true" data-theme="b"> 
			<input id="pass_erg" maxlength="20" type="text"  required placeholder="Votre mot de passe" data-clear-btn="true" data-mini="true" data-theme="b">  
			<div class="centr_bout">
				<input value="validez" id="envoi_erg" type="button" data-mini="true"data-inline="true">
				<a href="#info_enregistre"  data-role="button" data-mini="true" data-inline="true" >Information</a>
			</div>
		</form>
		<?php footer($pointpoint); ?> <!-- génére le footer directement-->
	</div>
	
			<!--page information perdu-->	
	<div data-role="dialog" data-theme="a" id="info_perdu">
		<div data-role="header">
			<h1>Information Databulles</h1>
		</div>
		<div data-role="content"> 
			<p class="justifier f9">Pour créer un nouveau mot de passe, vous devez indiquer votre adresse mail enregistrée lors de votre 
			inscription. Vous recevrez ensuite un mail automatique indiquant une adresse web, valide 24 heures, afin 
			de créer un nouveau mot de passe.</p>
		</div>
		<?php footer($pointpoint); ?> <!-- génére le footer directement-->
	</div>
	
		<!--page information enregistrement -->	
	<div data-role="dialog" data-theme="a" id="info_enregistre">
		<div data-role="header">
			<h1>Information Databulles</h1>
		</div>
		<div data-role="content"> 
			<p class="justifier f9">Pour pouvoir utiliser l'application <span class="gras">Databulles</span>, 
			vous devez vous inscrire avec un <span class="gras">speudo</span>, qui sera votre avatar 
			dans l’application, <span class="gras">un mot de passe</span>, pour protéger vos données et 
			une <span class="gras">adresse mail</span>, permettant de changer votre mot 
			de passe en cas d'oubli, ou recevoir des informations sur l'application. </p>
			
			<p class="justifier t5 f9">Les mots de passes sont <span class="gras">codés automatiquement</span> 
			par le système avant tout envoi et enregistrement. Aucune personne gérant l'application de peut contraire votre mot 
			de passe.</p>
		</div>
		<?php footer($pointpoint); ?> 
	</div>