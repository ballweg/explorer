<div data-role="<?php if(isset($datarole)){echo 'popup';} else {echo 'page';} ?>" <?php if(isset($id)){?>id="<?php echo $id;?>" data-url="<?php echo $id;}?>">
	<?php if($header != 'none'){ ?>
	<div data-role="header" data-theme="b">
		<?php
		if(isset($button)){ 
				if($button == 'logout'){ ?>
					<a data-icon="arrow-l" data-iconpos="left" data-transition="fade" data-rel="back">Back</a>
			<?php }
			} else { ?>
				<a href="/" data-icon="arrow-l" data-iconpos="left" data-transition="fade">Back</a>
	 	<?php } ?>
		<h1><?php echo $title?></h1>
			<?php
			if(isset($button)){ 
				if($button == 'logout'){ ?>
				<a href="/?task=logout" data-transition="fade" data-ajax="false" class="user">Log Out</a>
			<?php
				} else if($button == 'none') {}
			} 
			else {
				if(isset($_SESSION['user_id'])) { ?>
					<a href="/?task=profile" data-transition="fade" data-ajax="false" class="user"><?php echo $_SESSION['user']; ?></a>
					<?php 
				} else { ?>
					<a href="/?task=login" data-transition="fade" data-ajax="false" class="user">Log In</a>
				<?php }
			} ?>
	</div>
	<?php } ?>
	<div data-role="content">