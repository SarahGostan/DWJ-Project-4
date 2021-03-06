<?php
	require_once('model/PostManager.php');
	require_once('model/CommentManager.php');
	require_once('class/FlashMessage.php');

/* - - - - - - - - - - - - - - - Affichage des chapitres - - - - - - - - - - - - - - - */

	function listPosts(){
		
		$postManager = new PostManager();
		$firstPost = $postManager->premiereEntree();
		$posts = $postManager->getPosts($firstPost, 5);	
		$pageActuelle = $postManager->pageActuelle();
		$page_number = $postManager->pageNumber(5);
		require('view/accueil.php');
	}
	
	function post(){
		
		$postManager = new PostManager();
		$commentManager = new CommentManager();
		$id = $_GET['id'];
		$page_chapitres = "index.php?action=viewPost";
			
			$post = $postManager->getPost($id);
			$lastPost = $postManager->getLastPost($id);
			$nextPost = $postManager->getNextPost($id);
			$comments =	$commentManager->getComments($id);
			
			if ($lastPost != array())
			{
				$lienPostPrecedent = " <a href=' " . $page_chapitres . "&id=" . $lastPost['id'] . "'><i class='fa fa-arrow-left'></i></a>";
				
			}
			else 
			{
				
				$lienPostPrecedent = "";
			}	
			if ($nextPost != array())
			{
				$lienPostSuivant = " <a href=' " . $page_chapitres . "&id=" . $nextPost['id'] . "'><i class='fa fa-arrow-right'></i></a>";
			
			}
			else
			{
				
				$lienPostSuivant = "";
			}
				 
			$comments =	$commentManager->getComments($id);
			
			require('view/post.php');
	}
	
/* - - - - - - - - - - - - - - - Actions de commentaires - - - - - - - - - - - - - - - */
	
	function addComment($postId, $pseudo, $comment){
		$commentManager = new CommentManager();
		$affectedLines = $commentManager->postComment($postId, $pseudo, $comment);
		
		if ($affectedLines === false)
		{
			   throw new Exception('Impossible d\'ajouter le commentaire !');
		}
		else
		{
			header('Location: index.php?action=viewPost&id=' . $postId);
			exit();
		}
	}
	
	function reportComment($postId, $commentId){
		$commentManager = new CommentManager();
		$deletedComment = $commentManager->reportComment($commentId);

		if ($deletedComment === false)
		{
			throw new Exception('Impossible de signaler le commentaire');	
		}
		else
		{
			$flashMessage = new FlashMessage();
			$flashMessage->addMessage("Commentaire signalé !");
			header('Location: index.php?action=viewPost&id=' . $postId);
			echo '<script language="javascript">alert("Commentaire signalé !");</script>';
			exit();
		}
			
			
	}
	
	
	