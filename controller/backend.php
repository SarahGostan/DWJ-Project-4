<?php 

	require_once('model/UsersManager.php');
	require_once('model/PostManager.php');



function reportedComment(){
	$moderationManager = new CommentManager();
	$moderComm = $moderationManager->getReportedComments();	
	require('view/admin/moderation.php');
	return $moderComm;
	
} 

function deletePost($id){
	$postManager = new PostManager();
	$supprPost = $postManager->deletePost($id);
	if ($deletedPost === false){
			   throw new Exception('Impossible de supprimer ce billet');
		}
		else{
			header('Location: index.php?action=gestionAdmin');
			
		}
}

function deleteAllComments($postId){
	$commentManager = new CommentManager();
	$deleteComms = $commentManager->deleteAllComments($postId);
}

function updatePost($id, $title, $resume, $content){
	$postManager = new PostManager();
	
	$updatedPost = $postManager->updatePost($id, $title, $resume, $content);

	if ($editedPost === false){
		  throw new Exception('Impossible de modifier ce billet');
	}
	else{
		header('Location: index.php?action=gestionAdmin');
		echo "Billet modifié";
	}
}

function openPost($id){
	$postManager = new PostManager();
	$updatePost = $postManager->getPost($id);
	require ('view/admin/updatebillet.php');
}

	function listPostsAdmin(){
		$postManager = new PostManager();
		$firstPost = $postManager->premiereEntree();
		$posts = $postManager->getAllPosts($firstPost, 10);
		$page_number = $postManager->pageNumber(10);
		$pageActuelle = $postManager->pageActuelle();
		require('view/admin/administration.php');
	}

function gestionAdmin(){
	require('view/admin/administration.php');
	
}

function deleteComment($id){
	$moderationManager = new CommentManager();
	$supprComm = $moderationManager->deleteComment($id);
	if ($deletedComment === false){
			   throw new Exception('Impossible de supprimer ce commentaire');
		}
		else{
			header('Location: http://dwj-projet4-sarahgostan.fr/index.php?action=gestionAdmin');
			exit();
		}
}

function deleteReport($id){
	$moderationManager = new CommentManager();
	$supprReport = $moderationManager->deleteReport($id);
	if ($deletedReport === false){
			   throw new Exception('Impossible de supprimer ce report');
		}
		else{
			header('Location: index.php?action=gestionAdmin');		
			exit();
		}
}


function addBillet($title, $resume, $content){
	
		$adminManager = new PostManager();	
		
		$tryNewPost = $adminManager->addPost($title, $resume, $content);
		
		if ($tryNewPost === false){
			   throw new Exception('Impossible d\'ajouter le billet !');
		}
		else{
			header('location:index.php?action=gestionAdmin');
		}
	}
	
function authenticize($pseudo, $password){
	$adminManager = new UsersManager();
	$login = $adminManager->logAdmin($pseudo, $password);
	if ($login == false){
		throw new Exception('Identifiant ou mot de passe incorrect.');

	}
	else {
		session_start();
		$_SESSION['id'] = $login['id'];
		$_SESSION['pseudo'] = $login['name'];
	//	var_dump('test');
		header('Location: http://dwj-projet4-sarahgostan.fr/index.php');
		exit();
	}
	
}
	