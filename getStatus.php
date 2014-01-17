<?php
	require_once "includes/main.php";
	
	$task = $_GET['task'];
		
	if($task == 'total_users'){
		$response = Content::status(array('total_users'=>true));
		//var_dump($response["count(id)"]);
	} 
	else if($task == 'users_completed'){
		$response = Content::status(array('users_completed'=>7));
	} 
	else if($task == 'user_quests'){
		$response = Content::status(array('user_quests'=>true));
	} 
	else if($task == 'newest_user'){
		$response = Content::status(array('newest_user'=>true));
	} 
	else if($task == 'badge_info'){
		$response = Content::status(array('badge_info'=>true));
	}
	else if($task == 'pct_complete'){
		$completed = Content::status(array('users_completed'=>7));
		$total = Content::status(array('total_users'=>true));
				
		$c = intval($completed[0]->user_count);		
		$t = intval($total[0]->user_count);
		
		$response = $c/$t;
	}
	else {
		echo 'Hello!';
	}
	
	echo json_encode($response);
?>