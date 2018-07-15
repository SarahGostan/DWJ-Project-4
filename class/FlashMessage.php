<?php

class FlashMessage {
	
	public function __construct(){
		if(session_status() ==  PHP_SESSION_NONE)
			{ 
		session_start(); 
			}
	}

	public function addMessage($message){
		$_SESSION['messageFlash'] = $message;
	}
	
	public function readMessage(){
		if (array_key_exists('messageFlash', $_SESSION)){
			$message = $_SESSION['messageFlash'];
			unset($_SESSION['messageFlash']);
			return $message;
		}
		else{
			return null;
		}
	}
	
	public function messageExist(){
		if (array_key_exists('messageFlash', $_SESSION)){
			if (!empty($_SESSION['messageFlash'])){
				return true;
			}
		}
		return false;			
	}

}