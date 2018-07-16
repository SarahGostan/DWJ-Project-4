<?php 

$title= "Administration";
ob_start();?>


	<?php $info="Bienvenue sur le portail d'administration" ?>


	
		
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
			<a href="index.php?action=deletePostAdmin&id=<?= $data['id']; ?>" onclick="return confirm('La suppression est définitive. Confirmer ?')">Supprimer ce billet</a>
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