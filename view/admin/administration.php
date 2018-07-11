<?php 

$title= "Administration";
ob_start();?>

	<div id="presAdmin">
	<p> Bienvenue sur le portail d'administration </p>
	<a href="index.php?action=moderationAdmin">Modération des commentaires</a><br />
	<a href="index.php?action=newPostAdmin">Publier un nouveau billet</a>
	</div>
		
<div id="listPostsAdmin">
		
	<?php while ($data = $posts->fetch())
		{
	?>

	
		<div class="abstract">	<h2>
						<?= ($data['title']); ?><br />
						<em>le <?= $data['date_creation'];
									?></em>
					</h2>
						<a href="index.php?action=viewPost&id=<?= $data['id']; ?>">Voir en entier</a>	
			<a href="index.php?action=updatePostAdmin&id=<?= $data['id']; ?>">Modifier ce billet</a>
			<a href="index.php?action=deletePostAdmin&id=<?= $data['id']; ?>">Supprimer ce billet</a>
					<p>
			<?= nl2br($data['resume']);		
		
			?>
					</p>
				
		
		
			</div>

	<?php } ?>


</div>


<?php 

 $content = ob_get_clean();
 require('view/template.php'); ?>