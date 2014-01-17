<?php
	require_once "includes/main.php";
	if($_GET){
		$id = $_GET['loc'];
	    $geo_list = Content::find(array('loc'=>$id));
        echo json_encode($geo_list);
    } else {
    	echo false;
    }
?>