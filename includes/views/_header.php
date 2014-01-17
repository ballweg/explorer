<!DOCTYPE html > 
<html> 
	<head> 
	<title><?php echo formatTitle($title)?></title> 
	
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta charset="utf-8">

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.css" />
    <link rel="stylesheet" href="assets/css/styles.css" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/mobile/1.3.2/jquery.mobile-1.3.2.min.js"></script>
	<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script type="text/javascript" src="assets/js/explorer.js"></script>
	<script type="text/javascript" src="assets/js/jqm.page.params.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	
</head> 
<body> 

<?php
	$home = array('title'=>$title, 'id'=>'home', 'heading'=>$heading, 'button'=>$button);
	
	// pass along any overloads
	if($id){$home['id'] = $id;}
	if($header){$home['header'] = $header;}
	
	render('_pagehead', $home);
?>