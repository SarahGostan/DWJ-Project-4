<?php

Class UserSession{
	if(session_status() ==  PHP_SESSION_NONE)
	{ 
		session_start(); 
	}
}