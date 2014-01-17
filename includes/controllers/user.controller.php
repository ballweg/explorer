<?php

class UserController{

	///////////////////////////////////////////////////////////////////////////////////
	//
	// handlesRequest: handles requests for user functions. Does login/registration  
	//				   logic and renders appropriate page
	//
	///////////////////////////////////////////////////////////////////////////////////

	public function handleRequest(){
	
		$task = $_GET['task'];

		if($task == 'reg-submit' || $task == 'reg-retry'){
			if($_POST){
				// attempt to register user
				// check date to weed out bypass attempts
				
				if(User::isRegistrationOpen()){
					$success = User::register(
						$_POST['username'],
						$_POST['fullname'],
						$_POST['pass1'],
						$_POST['email'],
						$_POST['interestarea'],
						$_POST['accept-terms']
					);
					if($success['valid']){		
						// get user info from db for security and accuracy
						$usr = User::find(array('user'=>$_POST['username']));
						error_log('New user '.$usr[0]->username.' successfully registered');
						
						// try to login new user with registration details
						$result = User::authenticate($usr[0]->username,$_POST['pass1']);
						if($result['valid']){
							// on success, go to home page
							// TODO: Check if this is first logon
							//update_activity_time($usr[0]->username);
							header("location: /");
						} else {
							// on failure, go back for a manual login
							error_log('New user '.$usr['user'].' could not be logged in');					
							render('login', array(
								'title'	=> 'Register',
								'msg'	=> $usr['user'].' has been registered. Please log in to play.',
								'task'	=> 'login'
							));						
						}
					} else {
						// if registration fails, clear any session vars
						User::Logout();
						error_log('Registration failed. Asking user to try again.');					
						render('login', array(
							'title'	=> 'Register',
							'msg'	=> $success['msg'],
							'task'	=> 'register'
						));
					}
				} else {
					error_log('User tried to register outside of registration period. IP: '.$SERVER['REMOTE_ADDR']);
					render('login', array(
						'title'		=> 'Login to CDU Explorer',
						'msg'		=> 'Sorry, the registration period is closed.',
						'task'		=> 'login'
					));
				}				
			} else {
				// not postback, task possibly entered manually
				// clear session and send user back to registration page
				User::Logout();
				error_log('Registration page was called with $task of '.$task.' but without POST data.');
				render('login', array(
					'title'	=> 'Register',
					'task'	=> 'register'
				));
			}			
		} 
		// show registration page
		else if($task == 'register'){	
			render('login', array(
				'title'	=> 'Register',
				'msg'	=> $msg,
				'task'	=> $task
			));
		} 
		// logout
		else if($task == 'logout'){
			User::logout();
			render('login', array(
				'title'		=> 'Login to CDU Explorer',
				'msg'		=> 'You have been logged out.',
				'task'		=> $task
			));
		}
		// show user's profile
		else if($task == 'profile'){
			unset($_SERVER['QUERY_STRING']);
			if(empty($_SESSION['user_id'])){
				throw new Exception("Could not find user id. Are you logged in?");
			} else {
				$usr = User::find(array('id'=>$_SESSION['user_id']));
				render('user',array(
					'title'	=> 'Profile of '.$usr[0]->username,
					'user'	=> $usr
				));
			}
		}
	}

}

?>