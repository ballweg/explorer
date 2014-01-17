<!-- Spash page -->
<div id="splash">
	<?php $splash = Config::find('splash');
		if(isset($splash)){ ?>
			<object type="image/svg+xml" data="<?php echo $splash; ?>"></object>
		<?php	
		} else { ?>
			<object type="image/svg+xml" data="/assets/img/exp_splash.svg"></object>
		<?php 
		}
	 ?>
</div>