<?php 
$title= "Administration";
ob_start();
if (isset($_SESSION['id']) AND isset($_SESSION['pseudo'])){
$info= "Modifier ce billet :"
?>

<form id="newPost" action = "index.php?action=updatePostValidAdmin" method="post">	
	<label for="title" class="title">Titre du chapitre</label>
	<input type="text" name="title" id="title" value="<?=($updatePost['title']);?>"><br />
	<label for="resume">Résumé du chapitre</label>
	<textarea type="texte" name="resume" id="resume" /><?=($updatePost['resume']);?></textarea><br />
	<label for="content">Contenu du chapitre</label>
	<textarea type="texte" name="content" id="content" /><?=($updatePost['content']);?></textarea><br />
	<input type="hidden" name="idPost" id="idPost" value="<?=($updatePost['id']);?>">
	<input type="submit" class="sendPost" value ="Envoyer"/>
</form>
	
<?php
$content = ob_get_clean();
require('view/template.php'); 
}
?>