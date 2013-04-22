<?php if(isset($vars['success']) ): 
	redirect(base_url() . 'index.php/people');	
endif; ?>
<?php if(isset($vars['failure']) ): ?>
	<p class="alert label">Incorrect username/password.</p>
<?php endif; ?>
	
<form method="POST">
<fieldset class="form-wrapper">
	<legend>Login</legend>
	<?php print validation_errors('<div class="form-error-messages">', '</div>'); ?>

	<div class="form-field">
		<label for="l_username">Username: <span class="required">*</span></label>
		<input type="text" name="l-username" id="l_username" size="60" maxlength="60" value=""/>
	</div>

	<div class="form-field">
		<label form="l_message">Password: <span class="required">*</span></label>
		<input type="password" name="l-password" id="l_message" size="60" maxlength="60" value=""/>
	</div>

	<div class="form-actions">
		<input type="submit" name="submit" value="Send" />
	</div>
</fieldset>
<?php print form_close(); ?>
<a href="<?php print base_url(); ?>index.php/users/register" class="button secondary">Create new account</a>