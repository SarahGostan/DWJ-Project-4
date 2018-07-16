<?php

require_once("Database.php");

class PostManager extends Manager{
	
	/* - - - - - - - - - - - - - - - Affichage de données - - - - - - - - - - - - - - - */
	
	public function getAllPosts(){
		$db = $this->dbConnect();
		$req = $db->query("SELECT id, title, resume, content, DATE_FORMAT(date, '%d/%m/%Y') AS date_creation FROM posts ORDER BY id desc");
		return $req;
	}
	
	public function getPosts($firstPost, $nombrePost){
		
		$db = $this->dbConnect();
		$firstPost = $this->premiereEntree();
		$req = $db->prepare("SELECT id, title, resume, content, DATE_FORMAT(date, '%d/%m/%Y') AS date_creation FROM posts ORDER BY id LIMIT :debut, :nombre");
		$req->bindParam(':debut', $firstPost, PDO::PARAM_INT);
		$req->bindParam(':nombre', $nombrePost, PDO::PARAM_INT);
		$req->execute();
		return $req;
		
	}
	
	public function getNextPost($postId){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, resume FROM posts WHERE id > ? LIMIT 1');
		$req->execute(array($postId));
		$nextPost = $req->fetch();
		return $nextPost;
	}
	
	public function getPost($postId){

		$db = $this->dbConnect();
		$req = $db->prepare("SELECT id, title, resume, content, date FROM posts WHERE id = ?");
		$req->execute(array($postId));
		$post = $req->fetch();
		
		return $post;
	
}

	 
	public function pageNumber(){
		$db = $this->dbConnect();
		$postPerPage = 5;
		$post_return = $db->query('SELECT COUNT(*) AS post_number FROM posts');
		
		while ($post_number = $post_return->fetch()){
			$post_number = $post_number['post_number'];
			$page_number =ceil($post_number/$postPerPage);
			
		return $page_number;
		}
	}
	
		
	public function premiereEntree(){
		$pageActuelle = $this->pageActuelle();
		$firstPost=($pageActuelle-1)*5; 
		return $firstPost;
	}
 
	public function pageActuelle(){
		 $page_number = $this->pageNumber();
		if(isset($_GET['page']))
		{
			$_GET['page'] = (int) $_GET['page'];
			$pageActuelle=intval($_GET['page']);
	 
			if($pageActuelle>$page_number) 
			{
				$pageActuelle=$page_number;
			}
		}
		else
		{
			 $pageActuelle=1;
		}
		
		return $pageActuelle;
	 }
 
	
	/* - - - - - - - - - - - - - - - Ajout de données - - - - - - - - - - - - - - - */
	
	public function addPost($title, $resume, $content){
		$db = $this->dbConnect();
		$post = $db->prepare('INSERT INTO posts(title, resume, content, date) VALUES (?, ?, ?, NOW())');
		$newPost = $post->execute(array($title, $resume, $content));
		return $newPost;	
	}
		

	public function updatePost($id, $title, $resume, $content){
		$db = $this->dbConnect();
		$req = $db->prepare('UPDATE posts SET title = :title, resume = :resume, content = :content WHERE id = :id');
		$editedPost = $req->execute(array(
		'title' => $title,
		'resume' => $resume,
		'content' => $content,
		'id' => $id
		));
		return $editedPost;
	}


	public function getLastPost($postId){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, title, resume FROM posts WHERE id < ? ORDER BY id DESC LIMIT 1');
		$req->execute(array($postId));
		$lastPost = $req->fetch();
		return $lastPost;
	}

	
	/* - - - - - - - - - - - - - - - Suppression de données - - - - - - - - - - - - - - - */
	
	public function deletePost($id){
		$db = $this->dbConnect();
		$post = $db->prepare('DELETE FROM posts WHERE id = ?');
		$deletedPost = $post->execute(array($id));
		return $deletedPost;
	} 

}