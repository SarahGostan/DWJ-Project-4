<?php 

 $title= "Administration"; ?>
	
<?php ob_start();


if (isset($_SESSION['id']) AND isset($_SESSION['pseudo'])){

?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Modifier un billet</title>
		<link rel="stylesheet" href="style.css" >
		<script src="public/editeur.js"></script>
    </head>
	
    <body>
	
	<p> Bienvenue sur le portail d'administration </p>
	<a href="index.php?action=gestionAdmin">Retour au portail d'administration</a><br />
	<a href="index.php?action=gestionAdmin">Modération des commentaires</a>
	
	<p>Modifier ce billet :</p>
	
		<form id="newPost" action = "index.php?action=updatePostValidAdmin" method="post">	
			<label for="title" class="title">Titre du chapitre</label>
			<input type="text" name="title" id="title" value="<?=($updatePost['title']);?>"><br />
			<label for="resume">Résumé du chapitre</label>
			<textarea type="texte" name="resume" id="resume" /><?=($updatePost['resume']);?></textarea><br />
			<label for="content">Contenu du chapitre</label>
			<textarea type="texte" name="content" id="content" /><?=($updatePost['content']);?></textarea><br />
			<input type="hidden" name="idPost" id="idPost" value="<?=($updatePost['id']);?>">
			<input type="submit" value = "Envoyer"/>

		</form>
		
		

	
	</body>
	
	</html>
<?php }
else {
	throw new Exception ("Vous n'avez pas l'autorisation d'accéder à cette page");
}
 $content = ob_get_clean();
 require('view/template.php'); ?>