<?php
	require_once "includes/main.php";
	session_start();
    $completed_list = User::find(array('completed'=>$_SESSION['user_id']));
    echo json_encode($completed_list[0]->completed);
?>