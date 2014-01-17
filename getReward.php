<?php
	require_once "includes/main.php";
	session_start();
	
	$return = array();
	$return['success'] = false;
	// TODO: remove all the debug stuff!
	// get the necessary values to do compare.
    $reward_list = Content::find(array('reward'=>$_SESSION['user_id']));
    $completed_list = User::find(array('completed'=>$_SESSION['user_id']));
    $completed = json_decode($completed_list[0]->completed);
    
    foreach($reward_list as $reward){
    	//error_log('************** REWARD '.$reward->id.' ***************');
    	$criteria = json_decode($reward->criteria);
    	//debug($criteria, 'the value of $criteria: ');
    	
	    //compare two arrays, check if length is same to determine if they match
    	$intersect = count(array_intersect($criteria, $completed)) == count($criteria);
    	//debug($intersect, 'the value of $intersect: ');
    
    	if($intersect){
    		// there is a match - this challenge completes a quest/reward
    		error_log('The reward with id '.$reward->id.' matches '. $_SESSION['user_id'].'\'s completed challenges');
    		// Check if this reward has already been issued (check if user id is in users_completed)
    		$user_list = json_decode($reward->users_completed);
    		
	    	//debug($user_list, 'the value of $user_list: ');
    		
    		if(!empty($user_list)){
    			// first check if the users_completed is empty    			
    			error_log('the user list for this reward doesnt appear to be empty');
	    		if(!in_array($_SESSION['user_id'], $user_list)){
	    			// reward has yet to be issued to user
		    		//debug($user_list, 'you have not won this award yet. Other users have though, such as: ');
		  			//
		    		// if has not been issued, 
		    		//		set return[reward] = reward and return[success] = true
	    			$return['success'] = true;
	    			$return['reward'] = $reward;	    			
	    				    			
		    		//	increment completed in reward table
		    		Content::increment(array('reward'=>$reward->id));
		    		//error_log('have just incremented the count for content:reward:'.$reward->name);
		    		
		    		//	add this reward ID to user's earned_rewards list
		    		//Content::addUserToRewardCompletedList($reward->id);
		    		Content::addIdToList(array('list'=>'users_completed', 'reward'=>$reward->id));
					Content::addIdToList(array('list'=>'earned_rewards', 'reward'=>$reward->id));
		    		//error_log('have just added user '.$_SESSION['user_id'].' to the rewardCompleted array');
		    		error_log('User '.$_SESSION['user'].' ('.$_SESSION['user_id'].') has earned the '.$reward->name.' reward');
	    		} else {
	    			// it has already been issued to this user
	    			error_log('you already got this reward!');
	    			//$return['success'] = false;
	    			//$return['reward'] = null;
	    		}
    		} else {
    			// this is the first time that someone has completed this reward, insert into table
    			error_log('user '.$_SESSION['user'].' is the first to complete this reward.');
    			$user_list = array($_SESSION['user_id']);
	    		$return['success'] = true;
	    		$return['reward'] = $reward;
	    		//array_push($return['reward'], $reward);
	    		//error_log($return['reward']);
	    		
	    		//	increment completed in reward table
	    		Content::increment(array('reward'=>$reward->id));
	    		//error_log('have just incremented the count for content:reward:'.$reward->name);
	    		//Content::addUserToRewardCompletedList($reward->id);
		    	Content::addIdToList(array('list'=>'users_completed', 'reward'=>$reward->id));
		    	Content::addIdToList(array('list'=>'earned_rewards', 'reward'=>$reward->id));
	    		error_log('have just added user '.$_SESSION['user'].' to the rewardCompleted array');
    		}
	    }
    }
    //error_log('----------- json encoded return from getReward.php -------');
    //error_log(json_encode($return));
    echo json_encode($return);
?>