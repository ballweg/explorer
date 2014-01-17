<!-- User details page -->
<li class="user">
  <span class="title">Name</span> <?php echo $user->name ?>
  <!--TODO: Click to edit-->
</li>
<li class="user">
  <span class="title">Username</span> <?php echo $user->username?>
</li>
<li class="user">
  <span class="title">Change Password</span>
  <!--TODO: Click to change pass-->
</li>
<li class="user">
  <span class="title">Email</span> <?php echo $user->email?>
</li>

<?php if($_GET['advanced']){?>
	<li class="user">
	  <span class="title">Study interest</span> <?php echo $user->interest?>
	</li>
	<li class="user">
	  <span class="title">signup date</span> <?php echo $user->signup?>
	</li>
	<li class="user">
	  <span class="title">first logon</span> <?php echo $user->first_logon?>
	</li>
	<li class="user">
	  <span class="title">last active</span> <?php echo $user->last_active?>
	</li>
	<li class="user">
	  <span class="title">points</span> <?php echo $user->points?>
	</li>
	<li class="user">
	  <span class="title">level</span> <?php echo $user->level?>
	</li>
	<li class="user">
	  <span class="title">earned rewards</span> <?php echo $user->earned_rewards?>
	</li>
	<li class="user">
	  <span class="title">completed tasks</span> <?php echo $user->completed?>
	</li>
	<li class="user">
	  <span class="title">viewed tasks</span> <?php echo $user->viewed?>
	</li>
	<li class="user">
	  <span class="title">eligible for awards?</span> <?php echo $user->eligible?>
	</li>
	<li class="user">
	  <span class="title">game completed?</span> <?php echo $user->complete?>
	</li>
	<li class="user">
	  <span class="title">datestamp game completed</span> <?php echo $user->complete_time?>
	</li>
	<li class="user">
	  <span class="title">terms accepted?</span> <?php echo $user->terms_accepted ? 'true' : 'false' ?>
	</li>
<?php } ?>