

<?php 

 $title= "Modération"; ?>
	
<?php ob_start();



?>




<a href="index.php?action=gestionAdmin">Retour au portail d'administration</a>
<p> Bienvenue sur la page des commentaires signalés.<br /> Voici les commentaires à modérer : </p>

<?php
		while ($data = $moderComm->fetch()){
			
	?>	<div class="commentaire"><p>
			<div class="descriptifCommentaire">
				<a href="index.php?action=post&id=<?= $data['post_id']?>#comm<?= $data['id'] ?>">Commentaire <?= $data['id']; ?>, billet <?= $data['post_id']?></a><br />		
				Le <?=	$data['comment_date']; ?> <br />
				Par <?=	$data['pseudo']; ?><br />
				Nombre de report : <?= $data['nombre_report']; ?> <br />
				Dernier report le : <br /><?= $data['report_date']; ?></p>
			</div>
			<div class="contenuCommentaire">
		<p><?=	$data['content']; ?></p>
			</div>
			<div class="lienSignal"> 
			<a href="index.php?action=deleteCommentAdmin&amp;id=<?= $data['id']?>">Supprimer commentaire</a><br />
			<a href="index.php?action=deleteReportAdmin&amp;id=<?= $data['id']?>">Supprimer report</a></div>
		</div>
		
			<?php	} ?>


<?php 

 $content = ob_get_clean();
 require('view/template.php'); ?>