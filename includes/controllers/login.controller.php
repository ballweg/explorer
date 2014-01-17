<?php
class LoginController{
	///////////////////////////////////////////////////////////////////////////////////
	//
	// handlesRequest: handles requests for login page.
	//
	///////////////////////////////////////////////////////////////////////////////////

	public function handleRequest(){
		$task = $_GET['task'];
		
		if($task == 'login'){
			$success = User::authenticate($_POST['username'], $_POST['pass']);
			if($success['valid']){
				header('LOCATION: /');
			} else {
				// failed login. re-render login page with reason (msg)
				render('login', array(
					'title'		=> 'Login to CDU Explorer',
					'msg'		=> $success['msg'],
					'task'		=> $task
				));
			}
		} else {
			// if any other task is specified, render login page
			render('login', array(
				'title'		=> 'Login to CDU Explorer',
				'task'		=> $task,
				'header'	=> 'none',
				'id'		=> 'login'
			));
		}
	}
}
?>