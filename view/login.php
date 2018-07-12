<?php $title= "Lecture";
 ob_start();

if ($flashMessage->messageExist()){
	?>
	<aside><?= $flashMessage->readMessage(); ?></aside>
	<?php }
	

?>
	<form id="formLogin" action = "index.php?action=authenticize" method="post" >
		<h2>Identification</h2>
		<label for="identifiant">Identifiant</label>
		<input type="text" name="identifiant" id="identifiant" /><br />
		<label for="password">Mot de passe</label>
		<input type="password" name="password" id="password" /><br />
		<input type="submit" value = "Envoyer"/>
	</form>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>