<?php

/* This controller renders the home page */

class HomeController{
	public function handleRequest(){
		
		// Select all the categories:
		$quests = Content::listQuests();
		
		/* for each quest id...*/
		//if($task == 'play'){
			foreach ($quests as $quest){
				$key = $quest->short_name;
				$content_item = Content::find(array('questid'=>$quest->id));
				//$content_table = array($key => $content_item);
				
				$content_table[$key] = $content_item;
				//debug($content_table, 'content table');
			}
						
			/*keep things running while I work*/
			$content = Content::find(array('questid'=>$quests[0]->id));
			
			
			render('home',array(
				'title'		=> 'Explorer',
				'content'	=> $content_table,
				'quests'	=> $quests
			));
		}
	//}
}

?>