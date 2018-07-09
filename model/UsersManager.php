<?php

require_once("Database.php");

class UsersManager extends Manager{
	
	
	public function logAdmin($pseudo, $password){
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, name, password FROM users WHERE name = :name');
		$req->execute(array(
		'name' => $pseudo));
		$result = $req->fetch();
		$passwordTry = password_verify($password, $result['password']);
		if (!$passwordTry){
			$result = false;
			return $result;
		}
		else{
			return $result;
		}
	}
}