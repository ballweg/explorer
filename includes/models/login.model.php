<?php

////  TODO  ///////////////////////////////////////////////////////////////////////////////////
////  
////	Merge this into th
////
////

class Login{


	
	
	///////////////////////////////////////////////////////////////////////////////////
	//
	// find: returns user data from database, accepts array of values
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	/*
	public static function find($arr){
		global $db;
		
		if(empty($arr)){
			throw new Exception("Please provide a username and password");
		}
		else if($arr['id']){
			$st = $db->prepare("SELECT username, password, id FROM users WHERE id = :id");
		}
		// TODO: get only username and password, any key details
		else{
			throw new Exception("Unsupported property. (Login Class)");
		}
		$st->execute($arr);	
		return $st->fetchAll(PDO::FETCH_CLASS, "Login");
	}
	*/
}

?>