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
			
			if (!isset($_SESSION['id']) || !isset($_SESSION['pseudo']))
			{	
			throw new Exception ("Cette action est réservée aux administrateurs");
			exit();
			}
		}


		switch($_GET['action']) {
			
			case 'nextPost':
				getNextPost($_GET['id']);
				break;
			
			
			case 'listPosts':

				listPosts();
				break;
			
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
				
				
				
				/* FONCTIONS ADMINISTRATEUR */
					
					
			case 'moderationAdmin':
				reportedComment();
				break;
				
			case 'newPostAdmin':
				require('view/admin/newPost.php');
				break;
			
			case 'gestionAdmin':
				listPostsAdmin();
				break;
			
			case 'deleteCommentAdmin':
				if ((isset($_GET['id']) ))
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
					else{
						throw new Exception('Aucun identifiant de commentaire envoyé');
					}
					break;		
			
			case 'deletePostAdmin':
				if ((isset($_GET['id'])))
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
				else{
					throw new Exception('Un paramètre est manquant');
				}
				break;				
			
			
				
				
			case 'addBilletAdmin':
			if(!empty($_POST['title']) && !empty($_POST['resume']) && !empty($_POST['content'])){
				addBillet($_POST['title'], $_POST['resume'], $_POST['content']);
			}
			else{
				throw new Exception ('Un paramètre est manquant');
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
				require('view/login.php');
				break;
			
			
			case 'logoff':	
				logoff();
				break;	

				
				

			default:
				throw new Exception('Oups ! La page demandée n\'existe pas.');
				break;
				
		}
		
	}
	
	else
	{
		listPosts();
	}
}

catch(Exception $e){
	  $errorMessage = $e->getMessage();
	  require("view/erreur.php");
}