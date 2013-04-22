<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<?php if($vars['success'] === 1){ ?>
	<p class="success label">You have successfully edited a company.</p>
<?php }
else{
?>

<form method="POST">
<fieldset class="form-wrapper">
	<legend>Edit a Company Contact</legend>
	<?php print validation_errors('<p class="validation-error">', '</p><br />'); ?>

	<div class="form-field">
		<label for="e_com_name">Name: <span class="required">*</span></label>
		<input type="text" name="e-com-name" id="e-com_name" size="60" maxlength="60" value="<?php print $vars['data']->name; ?>" />
	</div>

	<div class="form-field">
		<label form="e_com_phone">Phone: </label>
		<input type="text" name="e-com-phone" id="e-com_phone" size="60" maxlength="60" value="<?php print $vars['data']->phone; ?>" />
	</div>

	<div class="form-field">
		<label form="e_com_email">Email: </label>
		<input type="text" name="e-com-email" id="e-com-email" size="60" maxlength="60" value="<?php print $vars['data']->email; ?>" />
	</div>

	<div class="form-field">
		<label form="e_com_website">Company Website: </label>
		<input type="text" name="e-com-website" id="e-com-website" size="60" maxlength="60" value="<?php print $vars['data']->website; ?>" />
	</div>

	<div class="form-field">
		<label form="e_com_street">Street Address: </label>
		<input type="text" name="e-com-street" id="e-com_street" size="60" maxlength="60" value="<?php print $vars['data']->inputted_address; ?>" />

		<label form="e_com_city">City: </label>
		<input type="text" name="e-com-city" id="e-com_city" size="60" maxlength="60" value="<?php print $vars['data']->inputted_city; ?>" />

		<label form="e-com_prosta">Province/State: </label>
		<select name="e-com-prosta">
			<?php foreach($vars['state_arr'] as $short => $value): ?>
				<?php if($vars['data']->inputted_prosta == $short){ ?>
				<option value="<?php print $short; ?>" selected><?php print $value; ?></option>
				<?php } else { ?>
				<option value="<?php print $short; ?>"><?php print $value; ?></option>
				<?php } ?>
			<?php endforeach; ?>
		</select>

		<label form="e_com_country">Country: </label>
		<select name="e-com-country">
			<?php if ($vars['data']->inputted_country == 'CA') { ?>
				<option value="CA" selected>Canada</option>
				<option value="US">USA</option>
			<?php } else { ?>
				<option value="CA">Canada</option>
				<option value="US" selected>USA</option>
			<?php } ?>			
		</select>
	</div>

	<div class="form-actions">
		<input type="submit" name="submit" value="Send" />
	</div>
</fieldset>
<?php print form_close(); 
}
?>