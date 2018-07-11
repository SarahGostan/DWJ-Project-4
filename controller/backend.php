<?php 

	require_once('model/UsersManager.php');
	require_once('model/PostManager.php');
	require_once('model/CommentManager.php');
	require_once('class/sessionUser.php');

/* - - - - - - - - - - - - - - - Gestion Commentaires - - - - - - - - - - - - - - - */

function reportedComment(){
	$moderationManager = new CommentManager();
	$moderComm = $moderationManager->getReportedComments();	
	require('view/admin/moderation.php');
	return $moderComm;
} 


function deleteAllComments($postId){
	$commentManager = new CommentManager();
	$deleteComms = $commentManager->deleteAllComments($postId);
}

function deleteComment($id){
	$moderationManager = new CommentManager();
	$deleteComment = $moderationManager->deleteComment($id);
	if ($deleteComment === false){
			   throw new Exception('Impossible de supprimer ce commentaire');
		}
		else{
			header('Location: http://dwj-projet4-sarahgostan.fr/index.php?action=gestionAdmin');
			exit();
		}
}


function deleteReport($id){
	$moderationManager = new CommentManager();
	$deleteReport = $moderationManager->deleteReport($id);
	if ($deleteReport === false){
			   throw new Exception('Impossible de supprimer ce report');
		}
		else{
			header('Location: http://dwj-projet4-sarahgostan.fr/index.php?action=gestionAdmin');
			exit();
		}
}


/* - - - - - - - - - - - - - - - Gestion Posts - - - - - - - - - - - - - - - */



function listPostsAdmin(){
	$postManager = new PostManager();
	$firstPost = $postManager->premiereEntree();
	$posts = $postManager->getAllPosts($firstPost, 10);
	$page_number = $postManager->pageNumber(10);
	$pageActuelle = $postManager->pageActuelle();
	require('view/admin/administration.php');
}

function deletePost($id){
	$postManager = new PostManager();
	$deletedPost = $postManager->deletePost($id);
	if ($deletedPost === false){
			   throw new Exception('Impossible de supprimer ce billet');
		}
		else{
			header('Location: index.php?action=gestionAdmin');	
		}
}

function openPost($id){
	$postManager = new PostManager();
	$updatePost = $postManager->getPost($id);
	require ('view/admin/updatebillet.php');
}

function updatePost($id, $title, $resume, $content){
	$postManager = new PostManager();
	
	$updatedPost = $postManager->updatePost($id, $title, $resume, $content);

	if ($updatedPost === false){
		  throw new Exception('Impossible de modifier ce billet');
	}
	else{
		header('Location: index.php?action=gestionAdmin');
		echo "Billet modifié";
	}
}


function addPost($title, $resume, $content){	
	$adminManager = new PostManager();		
	$tryNewPost = $adminManager->addPost($title, $resume, $content);
	if ($tryNewPost === false){
		  throw new Exception('Impossible d\'ajouter le billet !');
	}
	else{
		header('location:index.php?action=gestionAdmin');
		exit();
	}
}


/* - - - - - - - - - - - - - - - Gestion Connexion - - - - - - - - - - - - - - - */


function logoff(){
	$userSession = new UserSession();
	$deconnexion = $userSession->logoff();
	header('Location: index.php?action=login');
}

function login(){
	$userSession = new UserSession();
	require('view/login.php');
}

function authenticize($pseudo, $password){
	$adminManager = new UsersManager();
	$login = $adminManager->logAdmin($pseudo, $password);
	if ($login == false){
		throw new Exception('Identifiant ou mot de passe incorrect.');
	}
	else {
		$_SESSION['id'] = $login['id'];
		$_SESSION['pseudo'] = $login['name'];
		header('Location: http://dwj-projet4-sarahgostan.fr/index.php');
		exit();
	}
	
}
	
