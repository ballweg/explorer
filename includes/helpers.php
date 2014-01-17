<?php

/* These are helper functions */

function render($template,$vars = array()){
	
	// This function takes the name of a template and
	// a list of variables, and renders it.
	
	// This will create variables from the array:
	extract($vars);
	
	// It can also take an array of objects
	// instead of a template name.
	if(is_array($template)){
		
		// If an array was passed, it will loop
		// through it, and include a partial view
		foreach($template as $k){
			
			// This will create a local variable
			// with the name of the object's class
			
			$cl = strtolower(get_class($k));
			$$cl = $k;
			
			include "views/_$cl.php";
		}
		
	}
	else {
		include "views/$template.php";
	}
}

function cleanAnswer($ans){
	$ans_lower = strtolower($ans);
	if($ans_lower == "one") $val = 1;
	else if($ans_lower == "two") $val = 2;
	else if($ans_lower == "three") $val = 3;
	else if($ans_lower == "four") $val = 4;
	else if($ans_lower == "five") $val = 5;
	else if($ans_lower == "six") $val = 6;
	else if($ans_lower == "seven") $val = 7;
	else if($ans_lower == "eight") $val = 8;
	else if($ans_lower == "nine") $val = 9;
	else if($ans_lower == "ten") $val = 10;
	else $val = $ans_lower;
	return $val;
}

function checkLogin(){

    $firstName = $_POST['user'];
    $lastName = $_POST['pass'];
     
    echo("First Name: " . $firstName . " Last Name: " . $lastName);
}

// Helper function for title formatting:
function formatTitle($title = ''){
	if($title){
		$title.= ' | ';
	}
	
	$title .= $GLOBALS['defaultTitle'];
	
	return $title;
}


/**
 * Redirect the user to any page on the site.
 *
 * @param   $location	URL of where you want to return the user to.
 */
function return_to($location){
	$location = '/'.$location;
	header("Location: $location");
	exit();
}

/**
*
*  debug util. can plop arrays in errorlog for ya!
*		$d is for the value you're after, $t for txt	
*	
**/
function debug($d, $t){
	if($t){
		error_log($t);
	}	
	ob_start();
	var_dump($d);
	$o = ob_get_contents();
	ob_end_clean();
	error_log($o);
}


function natsort2d(&$aryInput) {
  $aryTemp = $aryOut = array();
  foreach ($aryInput as $key=>$value) {
   reset($value);
   $aryTemp[$key]=current($value);
  }
  natsort($aryTemp);
  foreach ($aryTemp as $key=>$value) {
   $aryOut[$key] = $aryInput[$key]; 
  }
  $aryInput = $aryOut;
}


?>