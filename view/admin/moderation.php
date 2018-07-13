<?php 

 $title= "Modération"; ?>
	
<?php ob_start();



?>



<?php $info="Voici les commentaires signalés :" ?>
<div id="reportedComments">
<?php
		while ($data = $moderComm->fetch()){
			
	?>	<div class="commentaire"><p>
			<div class="descriptifCommentaire">
				<a href="index.php?action=post&id=<?= $data['post_id']?>#comm<?= $data['id'] ?>">Commentaire <?= $data['id']; ?>, billet <?= $data['post_id']?></a><br />		
				Le <?=	$data['date']; ?> <br />
				Par <?=	$data['author']; ?><br />
				Nombre de report : <?= $data['number_report']; ?> <br />
				Dernier report le : <br /><?= $data['last_report_date']; ?></p>
			</div>
			<div class="contenuCommentaire">
		<p><?=	$data['content']; ?></p>
			</div>
			<div class="lienSignal"> 
			<a href="index.php?action=deleteCommentAdmin&amp;id=<?= $data['id']?>">Supprimer commentaire</a><br />
			<a href="index.php?action=deleteReportAdmin&amp;id=<?= $data['id']?>">Supprimer report</a></div>
		</div>
		
			<?php	} ?>

</div>
<?php 

 $content = ob_get_clean();
 require('view/template.php'); ?>