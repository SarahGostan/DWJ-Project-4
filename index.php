<?php
ini_set('display_errors', 1);
error_reporting( E_ALL );




	require('controller/frontend.php');
	require('controller/backend.php');

	
try{
	if (isset($_GET['action']))
	{
		if (strstr($_GET['action'], 'Admin'))
		{
		checkAuth();
		}


		switch($_GET['action']) {
			
		/* PAGE ACCUEIL */
			
			case 'listPosts':
				listPosts();
				break;
			
		/* PAGE CHAPITRE */
			
			case 'viewPost':		
				
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					post();
				}
				else
				{
					throw new Exception('Aucun identifiant de billet envoyé');
				}
				break;
				
				case 'nextPost':
				getNextPost($_GET['id']);
				break;
				
			case 'addComment':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					if(!empty($_POST['pseudo']) && !empty($_POST['comment']))
					{
						addComment($_GET['id'], $_POST['pseudo'], $_POST['comment']);
					}
					else
					{
						throw new Exception('Tous les champs ne sont pas remplis !');
					}
				}
				else
				{
					throw new Exception('Aucun identifiant de billet envoyé');
				}
				break;
			
			case 'reportComment':
				if (isset($_GET['id']) && $_GET['id'] > 0) 
		
				{
					reportComment($_GET['post'], $_GET['id']);
				}
					
				else
				{
					throw new Exception('Aucun identifiant de commentaire envoyé');
				}
				break;
				
				
		/* GESTION CONNEXION */
			
			case 'authenticize':
				if (!empty($_POST['identifiant']) && !empty($_POST['password'])){
					authenticize($_POST['identifiant'], $_POST['password']);
				}
				else{
					throw new Exception ('Login ou mot de passe incorrect');
				}
				break;				
					
			case 'login':
				login();
				break;
			
			case 'logoff':	
				logoff();
				break;	
				
				
		/* - - - - - FONCTIONS ADMINISTRATEUR - - - - - - */
					
		/* Vue d'ensemble */

			case 'gestionAdmin':
				listPostsAdmin();
				break;		
				
			
			
		/* Modération commentaires */
			
			case 'moderationAdmin':
				reportedComment();
				break;
			
			case 'deleteCommentAdmin':
				if (isset($_GET['id']) && $_GET['id'] > 0 )
				{
					deleteComment($_GET['id']);
					reportedComment();
				}
				else{
					throw new Exception('Aucun identifiant de commentaire envoyé');
				}
				break;
				
				
			case 'deleteReportAdmin':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					deleteReport($_GET['id']);
					reportedComment();
				}
				else
				{
					throw new Exception('Aucun identifiant de commentaire envoyé');
				}
				break;	
			
		/* Gestion des billets */
			
			case 'newPostAdmin':
				require('view/admin/newPost.php');
				break;
			
			case 'deletePostAdmin':
				if (isset($_GET['id']) && $_GET['id'] > 0)
					{
						deletePost($_GET['id']);
						deleteAllComments($_GET['id']);
					}
					else{
						throw new Exception('Aucun identifiant de billet envoyé');
					}
				break;
			
			case 'updatePostAdmin':
				if (isset($_GET['id']) && $_GET['id'] > 0)
				{
					openPost($_GET['id']);	
				}
				else
				{
					throw new Exception('Aucun identifiant de billet envoyé');
				}
				break;
			
			case 'updatePostValidAdmin':
				if(!empty($_POST['idPost']) && !empty($_POST['title']) && !empty($_POST['resume']) && !empty($_POST['content']))
				{
					updatePost($_POST['idPost'], $_POST['title'], $_POST['resume'], $_POST['content']);	
				}
				else
				{
					throw new Exception('Un paramètre est manquant');
				}
				break;				

			case 'addBilletAdmin':
			if(!empty($_POST['title']) && !empty($_POST['resume']) && !empty($_POST['content'])){
				addPost($_POST['title'], $_POST['resume'], $_POST['content']);
			}
			else{
				throw new Exception ('Un paramètre est manquant');
			}
			break;
			
			
			
		/* Gestion de page inconnue */	
			default:
				throw new Exception('Oups ! La page demandée n\'existe pas.');
				break;
				
		}
		
	}
		/* Page d'index par défaut */
	else
	{
		
		listPosts();
	}
}
		/* Affichage de la page d'erreur */
catch(Exception $e){
	  $errorMessage = $e->getMessage();
	  require("view/erreur.php");
}