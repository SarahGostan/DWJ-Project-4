<?php	
	if(session_status() ==  PHP_SESSION_NONE)
	{ 
		session_start(); 
	}

	Class UserSession{
		public function logoff(){
			session_destroy();
		}
	}
