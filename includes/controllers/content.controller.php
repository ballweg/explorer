<?php

class ContentController{

	///////////////////////////////////////////////////////////////////////////////////
	//
	// handlesRequest: handles requests for user functions. Does login/registration  
	//				   logic and renders appropriate page
	//
	///////////////////////////////////////////////////////////////////////////////////

	public function handleRequest(){
		/*
		$quests = Content::find(array('id'=>$_GET['quest']));
		
		if(empty($quests)){
			throw new Exception("There is no such category!");
		}
		*/
		
		// Fetch all the quests:
		$quests = Content::find(array('quest'));
		
		// Fetch all the products in this category:
		$content = Content::find(array('content'));
		
		// $categories and $products are both arrays with objects
		
		/*render('home',array(
			'title'		=> 'Explorer Quests',
			'quests'	=> $quests,
			'content'	=> $content
		));*/		
	}
}