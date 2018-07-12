<?php	

	Class UserSession{
		
		public function __construct(){
			if(session_status() ==  PHP_SESSION_NONE)
			{ 
		session_start(); 
			}
		}
		
		public function logoff(){
			session_destroy();
		}
		
		public function isAuthenticated(){
			if (!isset($_SESSION['id']) || !isset($_SESSION['pseudo']))
			{	
			return false;
			}
			else{
				return true;
			}
		}
		
		public function login($id, $name){
			$_SESSION['id'] = $id;
			$_SESSION['pseudo'] = $name;
		}
	}

