		<!-- registration partial -->
		<?php if(!empty($msg)){ ?>
		<span><?php echo $msg; ?></span>
		<?php } ?>
		<form method="post" data-ajax="false" id="registrationform" action="/?task=reg-submit" class="validate reg-form">
		  <div data-role="fieldcontain">
		  	<label for="username">Username *</label>
		    <input type="text" name="username" id="username" value="" minlength="3" maxlength="10" class="required"  />
		  </div>
		  <div data-role="fieldcontain">
		  	<label for="fullname">Full Name</label>
		    <input type="text" name="fullname" id="fullname" value=""  maxlength="50" />
		  </div>
		  <div data-role="fieldcontain">    
		    <label for="pass1">Password *</label>
		    <input type="password" name="pass1" id="pass1" value="" class="required" minlength="4" maxlength="32" />
		  </div>
		  <div data-role="fieldcontain">
		    <label for="pass2">Confirm Password *</label>
		    <input type="password" name="pass2" id="pass2" value="" class="required" minlength="4" maxlength="32"  />
		    <input type="hidden" name="pass-ok" id="pass-ok" value="false" />
		  </div>
		  <div data-role="fieldcontain">   	    
		    <label for="email">Email *</label>
		    <input type="text" name="email" id="email" value="" class="required email"  maxlength="50" />
		  </div>
		  <div data-role="fieldcontain">  
		    <!--TODO: Change to dropdown from Marissa's list-->
		    <label for="interestarea">Area of Interest</label>
		    <input type="text" name="interestarea" id="interestarea" value="" /> 
		  </div>
		  <div data-role="fieldcontain" class=""> 
		    <fieldset data-role="controlgroup">
			    <div class="ui-grid-a" id="terms-grid">
					<div class="ui-block-a">
						<input type="checkbox" name="accept-terms" id="accept-terms" class="custom required" value="true" />
						<label for="accept-terms">Agree *</label>
					</div>		
			    	<div class="ui-block-b">
			    		<legend class="cbox-inline-lbl"><a href="/#terms" data-rel="dialog" data-transition="pop">Terms & Conditions</a></legend>
			    	</div>
				</div>
		    </fieldset>
		  </div>
		  <div data-role="fieldcontain" class="reg-buttons">
		    <div>* required</div>
		
		    <input type="hidden" name="task" id="task" value="register" />
		    <div class="ui-grid-a">
				<div class="ui-block-a">
		    		<a href="/" id="cancel" type="cancel" data-role="button" data-direction="reverse">Cancel</a>
		    	</div>
		    	<div class="ui-block-b">
				    <button data-theme="b" id="submit" type="submit">Register</button>
				</div>
			</div>
			<script type="text/javascript">
				validateRegistration();
			</script>
		  </div>
		</form>
<?php render('_pagefoot'); ?>	