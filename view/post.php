<?php 
$checkAuth = new UserSession();
$title= "Lecture"; 
$info=null;
ob_start(); 
?>

<section id="postContent">

	<div id="actualAbstract">
		<h3><?= (strip_tags($post['title']));?></h3>
	</div>
	
	<div id="post">
			<p><?= strip_tags($post['content'], '<strong>, <span>, <em>, <sup>, <img>, <br />, <a>, <h1>, <h2>, <h3>, <h4>, <h5>, <sub>, <sup>'); ?></p>
	</div>
	
<?php if ($checkAuth->isAuthenticated()){
?>
	<div>
		<a href="index.php?action=updatePostAdmin&id=<?= $post['id']; ?>">Modifier ce billet</a><br />
		<a href="index.php?action=deletePostAdmin&id=<?= $data['id']; ?>" onclick="return confirm('La suppression est définitive. Confirmer ?')">Supprimer ce billet</a>
	</div>
<?php } ?>
	<div id="footband">
	
<?= ($lienPostPrecedent);  ?>

		<div id="previousAbstract">
			
			<h4><?= (strip_tags($lastPost['title']));?></h4>
			<p><?= (strip_tags($lastPost['resume']));?></p>
			
		</div>
		
		<div>
		<hr class="separation" />
		</div>
		
		<div id="nextAbstract">
		
			<h4><?= (strip_tags($nextPost['title']));?></h4>
			<p><?= (strip_tags($nextPost['resume']));?></p>
			
		</div>
		
<?= ($lienPostSuivant);	?>

	</div>
</section>

<section id="commentaires">

	<form id="formCommentaire" action = "index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
		<h2>Commentaires</h2>
		<label for="pseudo">Votre pseudo</label>
		<input type="text" name="pseudo" id="pseudo" /><br />
		<label for="comment">Ecrivez votre commentaire</label><br />
		<textarea type="text" name="comment" id="comment"></textarea><br />
		<input type="submit" value = "Envoyer"/>
	</form>
	
	<br />
	
<?php
while ($comment = $comments->fetch()){
?>

	<div class="commentaire" id="<?php echo "comm" . $comment['id']?>">
		<div class="commentDescription">
			<p>
				Auteur :  <span class="auteur"><?= htmlspecialchars($comment['author']);?></span><br />
				le <?= (htmlspecialchars($comment['date']));?>
			</p>
		</div>
		
		<div class="commentContent">
			<p><?= nl2br(htmlspecialchars($comment['content']));?></p>
		</div>
		
		<div class="reportLink"> 
			<a href="index.php?action=reportComment&amp;post=<?= $post['id']?>&amp;id=<?= $comment['id'] ?>">Signaler</a>
		</div>
	</div>
	
<?php } ?>
				
</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>