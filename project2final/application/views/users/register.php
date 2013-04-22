<?php if(isset($vars['success']) ): 
	redirect( base_url() . 'index.php/people/create' );
 endif; ?>
<?php if(isset($vars['failure']) ): ?>
	<p class="alert label">Incorrect username/password.</p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" >
<fieldset class="form-wrapper">
	<legend>Register</legend>
	<?php print validation_errors('<div class="form-error-messages">', '</div>'); ?>

	<div class="form-field">
		<label for="r_username">Username: <span class="required">*</span></label>
		<input type="text" name="r-username" id="r_username" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label form="r_email">Email Address: <span class="required">*</span></label>
		<input type="text" name="r-email" id="r_email" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label form="userfile">Profile Picture: </label>
		<input type="file" name="userfile" id="userfile" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label form="r_password">Password: <span class="required">*</span></label>
		<input type="password" name="r-password" id="r_password" size="60" maxlength="60" />
	</div>

	<div class="form-field">
		<label form="r_confirm_password">Confirm Password: <span class="required">*</span></label>
		<input type="password" name="r-confirm-password" id="r_confirm_password" size="60" maxlength="60" />
	</div>

	<div class="form-actions">
		<input type="submit" name="submit" value="Send" />
	</div>
</fieldset>
<?php print form_close(); ?>