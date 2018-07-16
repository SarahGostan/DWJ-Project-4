<?php 
 $title= "Modération";
 ob_start();
$info="Voici les commentaires signalés :" 
?>

<div id="reportedComments">
<?php
	while ($data = $moderComm->fetch()){		
?>	

	<div class="comments">
		
			<div class="descriptifCommentaire">
				<a href="index.php?action=post&id=<?= $data['post_id']?>#comm<?= $data['id'] ?>">Commentaire <?= $data['id']; ?>, billet <?= $data['post_id']?></a><br />
				<p>
					Le <?=	$data['date']; ?> <br />
					Par <?=	$data['author']; ?><br />
					Nombre de report : <?= $data['number_report']; ?> <br />
					Dernier report le : <br /><?= $data['last_report_date']; ?>
				</p>
			</div>
			
			<div class="commentContent">
				<p><?=	$data['content']; ?></p>
			</div>
			<div class="reportLink"> 
				<a href="index.php?action=deleteCommentAdmin&amp;id=<?= $data['id']?>">Supprimer commentaire</a><br />
				<a href="index.php?action=deleteReportAdmin&amp;id=<?= $data['id']?>">Supprimer report</a>
			</div>
	</div>
<?php	} ?>
</div>

<?php 
 $content = ob_get_clean();
 require('view/template.php'); 
 ?>