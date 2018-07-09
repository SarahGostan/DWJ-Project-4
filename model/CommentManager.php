<?php
require_once("Database.php");
class CommentManager extends Manager{

	public function getComments($postId){
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, content, date, author FROM comments WHERE post_id = ?');
		$comments->execute(array($postId));
		return $comments;
	}


	public function postComment($postId, $pseudo, $comment){
		$db = $this->dbConnect();
		$comments = $db->prepare('INSERT INTO comments(post_id, author, content) VALUES (?, ?, ?)');
		$affectedLines = $comments->execute(array($postId, $pseudo, $comment));
		return $affectedLines;
		
	}

	public function reportComment($commentId){
		$db = $this->dbConnect();
		

			
			$req = $db->prepare('UPDATE comments SET number_report = number_report+1, last_report_date = NOW() WHERE id = ?');
			$deletedComment = $req->execute(array($commentId));
			return $deletedComment;

	}
	
	public function deleteAllComments($postId){
		$db = $this->dbConnect();
		$deletComments = $db->prepare('DELETE FROM comments WHERE post_id = ?');
		$deletComments->execute(array($postId));
	}
	
	  public function getReportedComments(){
		$db = $this->dbConnect();
		$comments = $db->query('SELECT id, content, date, author, number_report, post_id, last_report_date FROM comments WHERE number_report > 0 ORDER BY number_report desc, last_report_date desc');
		return $comments;
    }
	
	public function deleteComment($id){
		$db = $this->dbConnect();
		$comment = $db->prepare('DELETE FROM comments WHERE id = ?');
		$deletedComm = $comment->execute(array($id));
		echo "<p class='moderation'>Commentaire supprimé</p>";
		return $deletedComm;
	}
	
	public function deleteReport($id){
		$db = $this->dbConnect();
		$comment = $db->prepare('UPDATE comments SET number_report = 0 WHERE id = ?');
		$deletedReport = $comment->execute(array($id));
		return $deletedReport;
	}

}