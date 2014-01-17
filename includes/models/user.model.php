<?php

class User{

	///////////////////////////////////////////////////////////////////////////////////
	//
	// authenticate: accepts username and password, checks them against values in db 
	// 		On success, returns true, on failure returns false	
	// 		TODO: return an array? True, userid - False, message.
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function authenticate($username, $password){
		$return = array('vaid'=>false);		
		if(empty($username) || empty($password)){
			$return = array('msg'=>'Please enter a username and password');
		} else {
			if(User::isPlayOpen()){
				$valid = User::checkUser($username, $password);
				if($valid['valid'] != false){
					User::createSession($username, $valid['id']);
					$return = array('valid'=>true);
				} else {
					$return = array('msg'=>$valid['msg']);
				}				
			} else {
				$return = array('msg'=>'Thank you! Game starts 25 August 2013');
			}
		}
		return $return;
	}
	
	///////////////////////////////////////////////////////////////////////////////////
	//
	// checkUser: Compares input username and password against database
	// 		TODO: Have method return arrays with message, etc. As seen above
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function checkUser($username, $pass_attempt){
		$userdata = User::find(array('user'=>$username));
		$return	= array('valid'=>false);
		if(is_null($userdata[0])){
			error_log('Failed login attempt with username '.$username.' from '.$_SERVER['REMOTE_ADDR']);
			$return = array('msg'=>'Sorry, wrong username or password.');
		} else {
			if(md5($pass_attempt) === $userdata[0]->password){
				error_log('User '.$username.' has logged in.');
				$return = array('valid'=>true, 'id'=>$userdata[0]->id);
			} else {
				error_log('The user '.$username.' failed to log in. (Wrong password)');
				$return = array('msg'=>'Sorry, wrong password.');
			}
		}		
		return $return;
	}
	
	
	///////////////////////////////////////////////////////////////////////////////////
	//
	// createSession: Load relevant details into $_SESSION superglobal
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function createSession($username, $id){
		$_SESSION['user'] 	  = $username;
		$_SESSION['loggedin'] = true;
		$_SESSION['user_id']  = $id;
		return true;
	}
		
		
	///////////////////////////////////////////////////////////////////////////////////
	//
	// exists: accepts a value and a db field to check. Responds to email and username
	//         if the user exists, returns true. if not, returns false.
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function exists($val, $field){
		global $db;
		try{
			if($field == 'username'){
				$arr['username'] = $val;
				$st = $db->prepare("SELECT id FROM users WHERE username = :username");			
				$st->execute($arr);
			} 
			else if($field == 'email'){
				$arr['email'] = $val;
				$st = $db->prepare("SELECT id FROM users WHERE email = :email");			
				$st->execute($arr);
			}
			return($st->rowCount() > 0);
		} catch(PDOException $e) {
			error_log($e->getMessage());
			die("Sorry, the database could not test whether or not a unique item had been used previously.");
		}
	}
	
	
	///////////////////////////////////////////////////////////////////////////////////
	//
	// find: returns user data from database, accepts array of values
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function find($arr){
		global $db;
		
		if(empty($arr)){
			$st = $db->prepare("SELECT * FROM users");
		} else if($arr['id']){
			$st = $db->prepare("SELECT * FROM users WHERE id = :id");
		} else if($arr['user']){
			$st = $db->prepare("SELECT * FROM users WHERE username = :user");
		} else if($arr['completed']){
			$st = $db->prepare("SELECT completed FROM users WHERE id = :completed");
		} else {
			throw new Exception("Unsupported property. (User Class)");
		}		
		$st->execute($arr);		
		return $st->fetchAll(PDO::FETCH_CLASS, "User");
	}
	
	
	///////////////////////////////////////////////////////////////////////////////////
	//
	// isRegistrationOpen: checks registration start, end and todays date to reply if
	//					   registration is open or not. Returns bool.
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function isRegistrationOpen(){
		$open  = Config::find('reg-start');
		$close = Config::find('reg-stop');
		$now   = date("Y-m-d H:i:s");

		return ($now > $open && $now < $close);
	}
	
		
	///////////////////////////////////////////////////////////////////////////////////
	//
	// isPlayOpen: checks play start date, end and todays date to reply if
	//			   play is open or not. Returns bool.
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function isPlayOpen(){
		$open  = Config::find('play-start');
		$close = Config::find('play-stop');
		$now   = date("Y-m-d H:i:s");

		return ($now > $open && $now < $close);
	}
			
		
	///////////////////////////////////////////////////////////////////////////////////
	//
	// logout: Clears the session variables.
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function logout(){
		$usr = $_SESSION['user'];
		session_unset();
		error_log('User '.$usr.' has logged out.');
	}
	
	
	///////////////////////////////////////////////////////////////////////////////////
	//
	// register: registers a new user and adds to database
	//	accepts: username (string), fullname (strings), password, email and interest
	//	         returns array, 'valid'=>true/false  'msg'=>string to be shown to user
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function register($username, $fullname, $password, $email, $interest, $terms){
		global $db;
		$return = array('valid'=>false);
		// check if username exists in db
		$fail = User::exists($username, 'username');
		if($fail){
			$return = array('valid'=>false, 'msg'=>'Sorry, that username is already in use.');
			return $return;
		}

		// check if email exists in db
		$fail = User::exists($email, 'email');
		if($fail){
			$return = array('valid'=>false, 'msg'=>'Sorry, that email address is already in use.');
			return $return;
		}
				
		// Basic check of password strength?
		
		if(!$fail){
			try{
				$regdata['username'] = $username;
				$regdata['fullname'] = $fullname;
				$regdata['password'] = md5($password);
				$regdata['email']    = $email;
				$regdata['interest'] = $interest;
				$regdata['terms']    = (bool)$terms;
				
				$st = $db->prepare("INSERT INTO users (username, name, password, email, interest, signup, last_active, terms_accepted) VALUES (:username, :fullname, :password, :email, :interest, NOW(), NOW(), :terms);");	
				$st->execute($regdata);
				$return = array('valid'=>true);
			} catch(PDOException $e) {
				error_log('During registration a user experienced the following database error: '.$e->getMessage());
				$return = array('return'=>false, 'msg'=>'Sorry, the database encontered an error. You were not registered.');
			}
		}
		return $return;
	}
	
		
	///////////////////////////////////////////////////////////////////////////////////
	//
	// getUserRewards: takes user_id from session, returns rewards (badges) earned in a 2d array
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function getUserRewards(){
		global $db;
		$arr = array('user_id' => $_SESSION['user_id']);
		
		try{
			$st = $db->prepare("SELECT earned_rewards FROM users where id = :user_id");
			$st->execute($arr);
			$raw_result = $st->fetch();
			$reward_list = json_decode($raw_result['earned_rewards']);
			
			if(!empty($reward_list)){
				$st2 = $db->prepare('SELECT * FROM reward WHERE id IN (' . implode(',', array_map('intval', $reward_list)) . ')');
				$st2->execute();
				
				// should contain 2D array of badges and their details
				return $st2->fetchAll();
			} else {
				return array();
			}
			
		} catch (Exception $e) {
			error_log('Exception thrown in getUserRewards '.$e);
		}
	}
	
		
	///////////////////////////////////////////////////////////////////////////////////
	//
	// update_activity_time: accepts username, updates last activity
	//
	///////////////////////////////////////////////////////////////////////////////////
	
	public static function update_activity_time($username){
		global $db;
		$arr = array('username'=>$username);
		try{
			$st = $db->prepare("UPDATE users (last_active) VALUES (NOW()) WHERE username = :username;");
			$st->execute($arr);
			return true;
		} catch(PDOException $e) {
			error_log('Database error in update_activity_time. User: '.$username.': '.$e->getMessage());
			return false;
		}
	}
}

?>