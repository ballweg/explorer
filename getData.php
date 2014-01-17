<?php
	require_once "includes/main.php";
	
	$task = $_GET['task'];
		
	if($task == 'users'){
		// retrieve all user data.
		$response [] = array("id","username","password","name","email","interest","signup","first_logon","last_active","points","earned_rewards","completed","viewed","eligible","complete","complete_time","terms_accepted");
		$response = User::find(array());
		//$response = Content::status(array('total_users'=>true));
		foreach($response as $r){
			$earned_rewards = json_decode($r->earned_rewards);
			$r->earned_rewards = $earned_rewards;
			$completed = json_decode($r->completed);
			$r->completed = $completed;
		}
	} else if($task == 'users_table'){
		// retrieve all user data.
		$response = User::find(array());
		//$response = Content::status(array('total_users'=>true));
		foreach($response as $r){
			$earned_rewards = json_decode($r->earned_rewards);
			$r->earned_rewards = $earned_rewards;
			$completed = json_decode($r->completed);
			$r->completed = $completed;
		}
	} else if($task == 'test'){
		$response = User::find(array());
		
		/* setup Google visualisation JSON format */	
		$array['cols'][] = array('type' => 'string');
	    $array['cols'][] = array('type' => 'number');	        

		foreach($response as $r){
			$arr = json_decode($r->completed);
			if(!empty($arr)){
				$completed_count = count(array_unique(json_decode($r->completed)));
			} else {
				$completed_count = 0;
			}
			$array['rows'][] = array('c' => array(array('v'=>$r->name), array('v'=>$completed_count)));
		}	   
	    $response = $array;
	    
	} else if($task == 'completion_distribution'){
		/* returns distribution of completed-ness */
		$response = User::find(array());
		
		/* setup Google visualisation JSON format */
		$array['cols'][] = array('type' => 'string', 'label'=>'Tasks Completed');
	    $array['cols'][] = array('type' => 'number', 'label'=>'Number of Users');
	    
	    $collector = array();
	        

		foreach($response as $r){
			$arr = json_decode($r->completed);
			if(!empty($arr)){
				$completed_count = count(array_unique(json_decode($r->completed)));
			} else {
				$completed_count = 0;
			} 
			$collector[] = $completed_count; 	
		}
		$count_arr = array_count_values($collector);
		//$count_arr;
		
		foreach($count_arr as $completed => $count){
			$array['rows'][] = array('c' => array(array('v'=>$completed), array('v'=>$count)));
		}
		
		$response = $array;
	} else if($task == 'completion_distribution_by_content'){
		/* returns number of users completing each stand, and org's name			 */
		$response = Content::find(array());
		$total_completed = 43;
		
		//debug($total_completed, 'total completed');
				
		/* setup Google visualisation JSON format */	
		$array['cols'][] = array('type' => 'string', 'label' => 'Area');
	    $array['cols'][] = array('type' => 'number', 'label' => 'Completed Task');
	    $array['cols'][] = array('type' => 'number', 'label' => 'Number of users that completed all');
	    
	    $collector = array();
	      
		foreach($response as $r){
			$arr = json_decode($r->users_completed);
			if(!empty($arr)){
				$users_completed = count(array_unique(json_decode($r->users_completed)));
			} else {
				$users_completed = 0;
			} 
			$array['rows'][] = array('c' => array(array('v'=>$r->org), array('v'=>$users_completed), array('v'=>$total_completed)));
			//$collector[] = $users_completed;
		}
		//$count_arr = array_count_values($collector);
		//$count_arr;
		
		/*foreach($count_arr as $completed => $count){
			$array['rows'][] = array('c' => array(array('v'=>$completed), array('v'=>$count)));
		}*/
		
		//$response = $collector;
		$response = $array;
	} else if($task == 'content_loc'){
		/* get geographic location of each content element (stand) */
		$loc_response = Content::find(array());
		$loc_arr = array();
		foreach($loc_response as $loc){
			$array[] = array('id'=>$loc->id, 'lat'=>$loc->lat, 'lon'=>$loc->lon); 
		}
	    $response = $array;
	    
	}
	else if($task == 'user_paths'){		
		/* get a path for each user */
		$response = User::find(array());
		$array = array();
		foreach($response as $r){
			$task_path = json_decode($r->completed);
			if(!empty($task_path)){
				$task_path = array_unique($task_path);
			}
			$array[] = array('id' => $r->id, 'task_path'=>$task_path);
		}
	    $response = $array;
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