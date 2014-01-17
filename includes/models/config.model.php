<?php

class Config{

	///////////////////////////////////////////////////////////////////////////////////
	//
	// find: Fetch game config parameters from database
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function find($entity){
		try{
			if(!empty($entity)){
				global $db;
				if($entity == 'splash'){
					$st = $db->prepare("SELECT splash from config");
				} else if($entity == 'banner'){
					$st = $db->prepare("SELECT banner from config");
				} else if($entity == 'play-start'){
					$st = $db->prepare("SELECT play_start from config");
				} else if($entity == 'play-stop'){
					$st = $db->prepare("SELECT play_stop from config");
				} else if($entity == 'reg-start'){
					$st = $db->prepare("SELECT reg_start from config");
				} else if($entity == 'reg-stop'){
					$st = $db->prepare("SELECT reg_stop from config");
				} else if($entity == 'game-title'){
					$st = $db->prepare("SELECT game_title from config");
				} else if($entity == 'root'){
					$st = $db->prepare("SELECT root_url from config");
				}
				$st->execute();
				return $st->fetchColumn();
			}
		} catch(PDOException $e) {
			error_log($e->getMessage());
			$msg = $e->getMessage();
			if (class_exists('PDO')){$pdo = "Check logs for a PDO exception";}else{$pdo = "Sorry, no PDO here.";};
			die("Database error. Could not fetch configuration. $msg. $pdo");
		}
	}
}