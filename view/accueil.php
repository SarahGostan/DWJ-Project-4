<?php $title= "Accueil";
 ob_start(); ?>
 <section id="accueil">
		<p>Bonjour ! Voici la liste des derniers billets</p>
	</section>
	<section id="chapitres">
	<?php

			
	while ($data = $posts->fetch())
	{
		?>	
			<div class="abstract">	<h2>
						<?= ($data['title']); ?><br />
						<em>le <?= $data['date_creation'];
									?></em>
					</h2>
					<p>
			<?= nl2br($data['resume']);		
		
			?>
					</p>
					<a href="index.php?action=viewPost&id=<?= $data['id']; ?>">Voir en entier</a>
				</div>
				
		<br />
		

<?php
	 } 
	
	$posts->closeCursor();
	?>
	</section>

	<p id="pages">Page :
	
	<?php
	
	for($i=1; $i<=$page_number; $i++)
	{
		if($i==$pageActuelle) 
		{
			echo ' [ '.$i.' ] '; 
		}	
		else
		{
			echo ' <a href= '. $page_index . '?page='.$i.'>'.$i.'</a> ';
		}
}
				
			?> 
			</p>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
