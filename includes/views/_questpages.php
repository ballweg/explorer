<!-- quest pages -->
<?php
foreach ($quests as $quest){
	$name = $quest->short_name;
	foreach ($content[$name] as $challenge){
		$pageid = $quest->short_name . $challenge->id;
		render('_pagehead',array('title'=>$quest->name, 'heading'=>'Faculty', 'id'=>$pageid));
		?>
		<div class="challenge-page" data-inset="false">
			<h2><?php echo $challenge->heading; ?></h2>
			<div class="location"><img src="<?php echo $quest->icon_url;?>"/> <?php echo $challenge->location; ?></div>
			<img src="<?php echo $challenge->image; ?>" alt="<?php echo $challenge->name; ?>"/>
			<p>
				<?php echo $challenge->text; ?>
				<?php if (isset($challenge->link)){ ?>
				<div class="challenge-link">
					<a href="<?php echo $challenge->link; ?>" target="_blank">Learn&nbsp;More&nbsp;&rarr;</a>
				</div>
				<?php } ?>
			</p>
			<form id="qa-<?php echo $challenge->id; ?>" class="qaform">
				<?php // Achtung! $.ajax (explorer.js) uses relative location of form/submit button to collect data. ?>
                <div data-role="fieldcontain">
					<label for="answer-<?php echo $challenge->id; ?>"><?php echo $challenge->q1; ?></label>
					<div class="ui-grid-b">
						<div class="ui-block-a">
   		         			<input type="text" data-inline="true" name="answer" id="answer-<?php echo $challenge->id; ?>" class="answer" value=""  />
	            			<input type="hidden" name="question" value="<?php echo $challenge->id; ?>" />
            			</div>
            			<div class="ui-block-b">
            				<button data-theme="b" data-inline="true" id="submit-<?php echo $challenge->id; ?>" type="submit" class="qasubmit">OK</button>
            			</div>
            		</div>
            	</div>
            </form>
		</div>
        <div id="completed-<?php echo $challenge->id; ?>" class="page-completed">
        	<img src="/assets/img/tick.png" alt="Complete!"/>Completed!
        	<a href="/" data-role="button" data-theme="b" data-icon="arrow-l">Back to Map</a>
        </div>
		
		<?php		
		render('_pagefoot');
	}
}
?>




