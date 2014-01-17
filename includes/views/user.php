<?php render('_header',array('title'=>$title, 'id'=>'profile', 'button'=>'logout')); ?>

<!-- renders user detail/updates page-->
<h1><?php echo $user[0]->name?></h1><span></span>
<h3><?php echo $user[0]->username ?></h3>

<div id="badges">
<ul>
<?php 
	foreach(User::getUserRewards() as $badge){?>
		<li>
			<img src="<?php echo $badge['image_url'];?>" alt="<?php echo $badge['name'];?>" title="<?php echo $badge['name'];?>"/>
			<!--<div><?php //echo $badge['name'];?></div>-->
		</li>
<?php } ?>
</ul>
</div>
<ul data-role="listview" data-inset="true" data-theme="c" data-dividertheme="b">
    <li data-role="list-divider">Current User's Details</li>
    <?php render($user, array($_GET['user'])) ?>
</ul>

<?php render('_footer')?>