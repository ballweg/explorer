<!-- login partial -->
<h2>Log In</h2>
<?php if(!empty($msg)){ ?>
<span><?php echo $msg ?></span>
<?php } ?>
<form method="post" data-ajax="false" action="/?task=login">
	<div data-role="fieldcontain">
		<?php if(User::isPlayOpen()){ ?>
			<div class="login-username">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" value=""  />
			</div>
			<div class="login-password">
				<label for="pass">Password</label>
				<input type="password" name="pass" id="pass" value="" />	
				<input type="hidden" name="task" id="task" value="login" />
			</div>
			<div class="login-buttons">	
				<button data-theme="b" id="submit" type="submit">Sign in</button>
		<?php } else { ?>
			<?php $start = date_create($play_start = Config::find('play-start')); ?>
			<div>Game opens <?php echo date_format($start, 'g:ia\, l jS F'); ?>.</div>
			<div class="login-username">
				<label for="username">Username</label>
				<input type="text" name="username" id="username" value="" disabled />
			</div>
			<div class="login-password">
				<label for="pass">Password</label>
				<input type="password" name="pass" id="pass" value="" disabled />	
				<input type="hidden" name="task" id="task" value="login" disabled />
			</div>
			<div class="login-buttons">		
				<button data-theme="b" id="submit" type="submit" disabled>Sign in</button>
		<?php } ?>
		<?php if(User::isRegistrationOpen()){ ?>
				<a data-theme="b" href="#registration" class="ui-submit" data-role="button">Register</a>
			</div>
		<?php } else { ?>
				<a data-theme="b" href="" class="ui-disabled" data-role="button" class="ui-disabled">Register</a>
				<!-- <a data-theme="b" href="" data-role="button" class="ui-disabled" class="ui-disabled">Register</a> -->
			</div>
		<?php } ?>
	</div>
</form>
<?php render('_pagefoot'); ?>