<?php 

 $title= "Administration";
 ob_start();
?>


	<a href="index.php?action=gestionAdmin">Retour au portail d'administration</a><br />
	<a href="index.php?action=moderationAdmin">Modération des commentaires</a>
	
	<p>Voici ou poster un nouveau billet</p>
	
		<form id="newPost" action = "index.php?action=addBilletAdmin" method="post">	
			<label for="title" class="title">Titre</label>
			<input type="text" name="title" id="title"/><br />
			<label for="resume">Résumé</label>
			<textarea type="texte" name="resume" id="resume" style="height:200px";/></textarea><br />
			<label for="content">Contenu</label>
			<textarea type="texte" name="content" id="content" /></textarea><br />
			<input type="submit" value = "Envoyer"/>
		</form>
		
<?php 

 $content = ob_get_clean();
 require('view/template.php'); ?>