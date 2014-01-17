<?php
require_once "includes/main.php";

    $answer = cleanAnswer($_POST[answer]);
    $challengeid = $_POST[question];
    
	$success = false;
	
    $content = Content::find(array('challengeid'=>$challengeid));

	//fuzzy matching
    similar_text($content[0]->a1, $answer, $match_strength);
	
    if($content[0]->a1 == $answer){
    	$success = true;
    } else {
	    if($match_strength > 70){
	    	$success = true;
	    }
    }
    
    session_start();
    if($success){
	    echo "true";
    	error_log('User '.$_SESSION['user'].' (id:'.$_SESSION['user_id'].') has successfully completed '.$challengeid);
	    Content::increment(array('completed'=>$content[0]->id));
	    // Content::addUserToList(array('completed'=>$content[0]->id));
	    Content::addUserToChallengeCompletedList($content[0]->id);
	    Content::addChallengeToUserCompletedList($challengeid);
    } else {	    
		echo "Sorry, try again.";
    	error_log('User '.$_SESSION['user'].' failed to complete challenge '.$challengeid.' with a match strength of '.$match_strength);
    }
    
    /* implement similar text function here. */
    
    //echo("you answered: ".$answer. " and the real answer is: ".$content[0]->a1." for challengeid: ".$challenge);
    
?>