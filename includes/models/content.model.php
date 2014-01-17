<?php

class Content{
	

	///////////////////////////////////////////////////////////////////////////////////
	//
	// find: returns bits of content from database, accepts array of values
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function find($arr = array()){
		global $db;
		
		if(empty($arr)){
			$st = $db->prepare("SELECT * FROM content");
		}
		else if($arr['id']){
			$st = $db->prepare("SELECT * FROM content WHERE id=:id");
		}
		else if($arr['questid']){
			$st = $db->prepare("SELECT * FROM content WHERE quest_id=:questid");
		}
		else if($arr['challengeid']){
			$st = $db->prepare("SELECT * FROM content WHERE id=:challengeid");
		}
		else if($arr['reward']){
			$st = $db->prepare("SELECT * FROM reward");
		}
		else if($arr['reward_id']){
			$st = $db->prepare("SELECT * FROM reward where :reward_id = id");
		}
		else if($arr['loc']){
			$st = $db->prepare("SELECT id, quest_id, location, lat, lon FROM content");
		}
		else{
			throw new Exception("Unsupported property!");
		}
		try{
			$st->execute($arr);
		} catch(PDOException $e) {
			error_log($e->getMessage());
		}
		
		// Returns an array of content 
		return $st->fetchAll(PDO::FETCH_CLASS, "Content");
	}
	
	public static function status($arr = array()){
		global $db;
		
		/* get total users */
		if($arr['total_users']){
			$st = $db->prepare("SELECT count(id) as user_count FROM users");
		}
		else if($arr['users_completed']){	
			/* users who have completed game */		
			$st = $db->prepare("select count(id) as user_count from users where earned_rewards LIKE CONCAT('%',7,'%')");
		}
		else if($arr['user_quests']){
			/* users who have completed each quest */
			$st = $db->prepare("select id, users_completed from reward");
		}
		else if($arr['newest_user']){
			/* latest user registered */
			$st = $db->prepare("SELECT id, username, name FROM users WHERE terms_accepted='1' ORDER by last_active desc LIMIT 1");
		}
		else if($arr['badge_info']){
			/* each badge icon, and name */
			$st = $db->prepare("select id, name, image_url, completed from reward order by completed desc");
		} else {
			throw new Exception("Unsupported property requested in status function.");
		}
		
		try {
			$st->execute($arr);
		} catch(PDOException $e) {
			error_log($e->getMessage());
		}
		
		return $st->fetchAll(PDO::FETCH_CLASS, "Content");
	}
	
	public static function listQuests($arr = array()){
		global $db;
		
		if(empty($arr)){
			$st = $db->prepare("SELECT * FROM quest");
		}
		
		$st->execute($arr);
		
		// Returns an array of content
		return $st->fetchAll(PDO::FETCH_CLASS, "Content");
	}
	
	// increments stats. provide a field and an id
	public static function increment($arr = array()){
		global $db;
		if($arr['visits']){
			$st = $db->prepare("UPDATE content SET visits = visits + 1 WHERE id = :visits");
		} else if($arr['completed']) {
			$st = $db->prepare("UPDATE content SET completed = completed + 1 WHERE id = :completed");
		} else if($arr['reward']) {
			$st = $db->prepare("UPDATE reward SET completed = completed + 1 WHERE id = :reward");
		} else {
			throw new Exception("Field to increment not specified.");
		}
		$st->execute($arr);
	}
	
	public static function addIdToList($arr){
		global $db;
		if($arr['reward']){
			$set_arr['reward'] = $arr['reward'];
			//error_log('you have specified a reward table to update');
			if($arr['list'] == 'users_completed'){
				// adds a user id to set of users who COMPLETED a reward
				//error_log('adds a user id to set of users who COMPLETED a reward');
				$st = $db->prepare("SELECT users_completed FROM reward WHERE id = :reward");
				$new_id = intval($_SESSION['user_id']);
			} 
			else if($arr['list'] == 'users_viewed'){
				// adds a user id to set of users who VIEWED a reward (wait! That's not possible)
				//error_log('adds a user id to set of users who VIEWED a reward (wait! T');
				$st = $db->prepare("SELECT users_viewed FROM reward WHERE id = :reward");
				$new_id = intval($_SESSION['user_id']);
			} 
			else if($arr['list'] == 'earned_rewards'){
				// adds a reward id to the set a USER has earned			
				//error_log('adds a reward id to the set a USER has earned');
				$arr['user_id'] = $set_arr['user_id'] = $_SESSION['user_id'];
				$st = $db->prepare("SELECT earned_rewards FROM users WHERE id = :user_id");
				$new_id = intval($arr['reward']);
				unset($arr['reward']);
			} 
			else {
				throw new Exception("Unsupported property inside reward! $arr");				
			}
		} else if($arr['content']){
			//error_log('you have specified a content table to update');
			if($arr['list']=='users_completed'){			
				// adds a user id to set of users who COMPLETED a CONTENT item
				$st = $db->prepare("select users_completed FROM content WHERE id = :content");
			} 
			else if($arr['list']=='users_viewed'){
				// adds a user id to set of users who VIEWED a CONTENT item
				$st = $db->prepare("select users_viewed FROM reward WHERE id = :content");
			} 
			else {
				throw new Exception("Unsupported property inside content! $arr");
			}	
			$set_arr['content'] = $arr['content'];
		} else if($arr['quest']){
			//error_log('you have specified a quest table to update');
			if($set_arr['list'] == 'users_completed'){
				// adds a user id to set of users who COMPLETED a QUEST
				$st = $db->prepare("SELECT users_completed FROM quest WHERE id = :quest");
			} 
			else if($arr['list'] == 'users_viewed'){			
				// adds a user id to set of users who VIEWED a QUEST
				$st = $db->prepare("SELECT users_viewed FROM quest WHERE id = :quest");
			} 
			else {
				throw new Exception("Unsupported property inside quest! $arr");
			}			
			$set_arr['quest'] = $arr['quest'];
		} else {
			throw new Exception("Unsupported property! $arr");
		}
		$set_arr['list'] = $arr['list'];
		unset($arr['list']);
		//debug($arr, 'the value of array to merge with PDO statement is: ');
		try{
			$st->execute($arr);
		} catch(Exception $e) {
			error_log('PDO Exception: '.$e);
		}
		
		$list = $st->fetchColumn();	
		//debug(json_Decode($list), "The list (".$arr['list']."), before addition contains: ");
	
		if(empty($list)){
			$new_list = array($new_id);
		} else {
			$new_list = json_decode($list);
			array_push($new_list, $new_id);
		}
			
		$set_arr['new_list'] = json_encode($new_list);
		
		// build a new pdo statement
		if($set_arr['reward']){			
			if($set_arr['list'] == 'users_completed'){
				$st_add = $db->prepare("UPDATE reward SET users_completed = :new_list WHERE id = :reward");
			} else if($set_arr['list'] == 'users_viewed'){
				$st_add = $db->prepare("UPDATE reward SET users_viewed = :new_list WHERE id = :reward");
			} else if($set_arr['list'] == 'earned_rewards'){
				unset($set_arr['reward']);
				$st_add = $db->prepare("UPDATE users SET earned_rewards = :new_list WHERE id = :user_id");
			}
		} else if($set_arr['content']){
			if($set_arr['list'] == 'users_completed'){
				$st_add = $db->prepare("UPDATE content SET users_completed = :new_list WHERE id = :content");
			} else if ($set_arr['list'] == 'users_viewed'){
				$st_add = $db->prepare("UPDATE content SET users_viewed = :new_list WHERE id = :content");
			}
		} else if($set_arr['quest']){
			if($set_arr['list'] == 'users_completed'){
				$st_add = $db->prepare("UPDATE quest SET users_completed = :new_list WHERE id = :quest");
			} else if ($set_arr['list'] == 'users_viewed'){
				$st_add = $db->prepare("UPDATE quest SET users_viewed = :new_list WHERE id = :quest");
			}
		}
		unset($set_arr['list']);
		//debug($set_arr, 'value of $set_arr just before it executes;');
		$st_add->execute($set_arr);
	}
	
	
	public static function addUserToRewardCompletedList($entity_id){
		global $db;
		$arr['entity_id'] = $entity_id;
		$st = $db->prepare("SELECT users_completed FROM reward WHERE id = :entity_id");
		$st->execute($arr);
		$user_list = $st->fetchColumn();
		
		//debug($user_list, 'User List in addUserToRewardCompletedList is: ');
		
		if(empty($user_list)){
			// if empty, create a new array with the current user id in it
			$new_list = array(intval($_SESSION['user_id']));
		} else {
			// not empty? read what's in there
			$new_list = json_decode($user_list);
			array_push($new_list, intval($_SESSION['user_id']));
		}
		
		// build an array to drive the PDO statement
		$set_arr['user_list'] = json_encode($new_list);
		$set_arr['entity_id'] = $entity_id;
	
		// build a new pdo statement
		$st_add = $db->prepare("UPDATE reward SET users_completed = :user_list WHERE id = :entity_id");
		$st_add->execute($set_arr);		
	}
	
	public static function addUserToChallengeCompletedList($challenge_id){
		global $db;
		$arr['challenge_id'] = $challenge_id;
		$st = $db->prepare("SELECT users_completed FROM content WHERE id = :challenge_id");
		$st->execute($arr);
		$user_list = $st->fetchColumn();
		
		//debug($user_list, 'User List in addUserToChallengeCompletedList is: ');
		
		if(empty($user_list)){
			// if empty, create a new array with the current user id in it
			$new_list = array(intval($_SESSION['user_id']));
		} else {
			// not empty? read what's in there
			$new_list = json_decode($user_list);
			array_push($new_list, intval($_SESSION['user_id']));
		}
		
		// build an array to drive the PDO statement
		$set_arr['user_list'] = json_encode($new_list);
		$set_arr['challenge_id'] = $challenge_id;
	
		// build a new pdo statement
		$st_add = $db->prepare("UPDATE content SET users_completed = :user_list WHERE id = :challenge_id");
		$st_add->execute($set_arr);		
	}
	
	public static function addChallengeToUserCompletedList($challenge_id){
		global $db;
		session_start();
		$arr['user_id'] = $_SESSION['user_id'];
		$st = $db->prepare("SELECT completed FROM users WHERE id = :user_id");
		$st->execute($arr);
		$challenge_list = $st->fetchColumn();
		
		//debug($challenge_list, 'Chalenge List in addChallengeToUserCompletedList is: ');
		
		if(empty($challenge_list)){
			// if empty, create a new array with the challenge just completed
			$new_list = array(intval($challenge_id));
		} else {
			// not empty? read what's in there
			$new_list = json_decode($challenge_list);
			array_push($new_list, intval($challenge_id));
		}

		// build array for PDO statement
		$_SESSION['completed'] = $set_arr['challenge_list'] = json_encode($new_list);
		$set_arr['user_id'] = $_SESSION['user_id'];
		
		// build the PDO statement
		$st_add = $db->prepare("UPDATE users SET completed = :challenge_list WHERE id = :user_id");
		$st_add->execute($set_arr);
	}
}

?>