<?php

class Manager
{
    protected function dbConnect()
    {
		try{
       	$db = new PDO('mysql:host=db744106473.db.1and1.com;dbname=db744106473;charset=utf8', 'dbo744106473', 'PDPHP88*)+54VF');
		return $db;
		}
		catch(Exception $e){
			die('Erreur : ' . $e->getMessage());
		}
    }
}