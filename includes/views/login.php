<?php 
	render('_header', array('title'=>$title,'button'=>'none', 'header'=>'none', 'id'=>'login'));

	render('_splash');
	render('_login', array('title'=>$title,'task'=>$task,'msg'=>$msg));
	
	render('_pagehead',array('title'=>'Register', 'heading'=>'Register', 'header'=>'none', 'id'=>'registration'));
	render('_splash');	
	render('_register', array('title'=>$title,'task'=>$task,'msg'=>$msg, 'id'=>'registration'));

	render('_pagehead', array('title'=>'Terms & Conditions', 'heading'=>'Terms & Conditions', 'id'=>'terms', 'button'=>'none'));
	render('_terms');
?>



