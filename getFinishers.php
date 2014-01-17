<?php
	require_once "includes/main.php";
	session_start();
    //$completed_list = User::find(array('completed'=>$_SESSION['user_id']));
    
    $completion = Content::find(array('reward_id'=>3));
    $criteria = json_decode($completion[0]->criteria);
    
    echo "<h1>Users who completed ALL tasks:</h1> <small>(those with ids:";
    echo $completion[0]->criteria;
    echo ')</small> <br/>';
	    	echo '</br>';
	    	echo '</br>';
    
    $all_users = User::find(array());
    $i = 0;
    
    foreach($all_users as $user){
    	$usr_completed = json_decode($user->completed);    	
    	$intersect = count(array_intersect($criteria, $usr_completed)) == count($criteria);
    	
    	//echo count(array_intersect($criteria, $usr_completed));
    	//echo '  ';
    	//echo count($criteria);
    	
    	if($intersect > 0){
	    	//echo $users_completed;
    	$i++;

	    	echo "$i  ";
	    	echo $user->name;
	    	echo '<br/><small>';
	    	echo $user->email;
	    	//echo '  '.$intersect.' ';
	    	//echo '   '.$user->completed;
	    	echo '</small></br>';
	    	echo '<br/>';
	    	echo '<br/>';

    	}
	    //echo '&nbsp;&nbsp;&nbsp;&nbsp;';
	    //echo $user->completed;
	    //echo '<br/>';
    }

    
    //echo json_encode($completed_list[0]->completed);
?>