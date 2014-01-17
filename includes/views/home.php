<?php render('_header',array('title'=>$title))?>
<?php if($msg){ ?>
	<span><?php echo $msg ?></span>
<?php } ?>
<div id="map" class="leftColumn">
	<!--<img src="http://maps.googleapis.com/maps/api/staticmap?center=-12.372056,130.869&zoom=17&size=440x400&maptype=hybrid&scale=2
&sensor=false">-->
</div>
<div class="rightColumn">
	<?php render('_questlist', array('quests' => $quests, 'content' => $content)); ?>
</div>
<?php render('_footer')?>

<?php render('_questpages', array('quests' => $quests, 'content' => $content)); ?>

<?php render('_dialog', array('title'=>'Congratulations!', 'heading'=>'Faculty', 'id'=>'rewardDialog')); ?>