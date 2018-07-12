<?php 

 $title= "Administration";
 ob_start();
?>

<div id="lienAdmin">
	<a href="index.php?action=gestionAdmin">Retour au portail d'administration</a><br />
	<a href="index.php?action=moderationAdmin">Modération des commentaires</a>
</div>
	<aside class="infoMessage">Poster un nouveau billet :</aside>
	
		<form id="newPost" action = "index.php?action=addBilletAdmin" method="post">	
			<label for="title">Titre</label>
			<input type="text" name="title" id="title"/><br />
			<label for="resume">Résumé</label>
			<textarea type="texte" name="resume" id="resume";/></textarea><br />
			<label for="content">Contenu</label>
			<textarea type="texte" name="content" id="content" /></textarea><br />
			<input type="submit" class="sendPost" value = "Envoyer"/>
		</form>
		
<?php 

 $content = ob_get_clean();
 require('view/template.php'); ?>