<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<?php if(isset($vars['success']) ): ?>
	<p class="success label">You have successfully added a company.</p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" >
<fieldset class="form-wrapper">
	<legend>Add a Company Contact</legend>
	<?php print validation_errors('<p class="validation-error">', '</p><br />'); ?>

	<div class="form-field">
		<label for="com_name">Name: <span class="required">*</span></label>
		<input type="text" name="com-name" id="com_name" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label form="com_phone">Phone: </label>
		<input type="text" name="com-phone" id="com_phone" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label form="com_email">Email: </label>
		<input type="text" name="com-email" id="com_email" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label form="com_website">Company Website: </label>
		<input type="text" name="com-website" id="com_website" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label form="com_street">Street Address: </label>
		<input type="text" name="com-street" id="com_street" size="60" maxlength="60"  />

		<label form="com_city">City: </label>
		<input type="text" name="com-city" id="com_city" size="60" maxlength="60"  />

		<label form="com_prosta">Province/State: </label>
		<select name="com-prosta">
			<?php foreach($vars['state_arr'] as $short => $value): ?>
				<option value="<?php print $short; ?>"><?php print $value; ?></option>
			<?php endforeach; ?>
		</select>

		<label form="com_country">Country: </label>
		<select name="com-country">
			<option value="CA">Canada</option>
			<option value="US">USA</option>
		</select>
	</div>

	<div class="form-field">
		<label form="userfile">Profile Picture: </label>
		<input type="file" name="userfile" id="userfile" size="60" maxlength="60"  />
	</div>

	<div class="form-actions">
		<input type="submit" name="submit" value="Send" />
	</div>
</fieldset>
<?php print form_close(); ?>