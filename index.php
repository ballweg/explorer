<?php

/*
	This is the index file of our simple website.
	It routes requets to the appropriate controllers
*/
require_once "includes/main.php";

try {	
	session_start();
	
	// set $task if it exists in URL or POST
	if(isset($_GET['task'])){
		$task = $_GET['task'];
	} else if(isset($_POST['task'])){
		$task = $_POST['task'];
	}
	//error_log('Debug: Task is set to '.$task);
	if($_GET['user']){
		// if a user id is in URL, go to user page
		$c = new UserController();
	} else if($task == 'login'){
		$c = new LoginController();
	} else if($task == 'logout'){
		$c = new UserController();
	} else if($task == 'play'){
		$c = new HomeController();
	} else if($task == 'register' || $task == 'reg-retry' || $task == 'reg-submit'){
		if(!isset($_SESSION['user'])){
			// go to register page
			$c = new UserController();
		}
	} else if($task == 'profile'){
		// go to user profile page
		$c = new UserController();
	}
	
	// no task? If logged in, go to home page else go to login page
	else if(empty($_GET)){
		if($_SESSION['loggedin'] == true){
			$c = new HomeController();
		} else {
			$c = new LoginController();
		}
	} else {
		throw new Exception('Wrong page!');
	}
	
	$c->handleRequest();
}
catch(Exception $e) {
	render('error', array('msg'=>$e->getMessage()));
}

?>