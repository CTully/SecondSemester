<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<?php if(isset($vars['success']) ): ?>
	<p class="success label">You have successfully added a person.</p>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data" >
<fieldset class="form-wrapper">
	<legend>Add a Person Contact</legend>
	<?php print validation_errors('<p class="validation-error">', '</p><br />'); ?>

	<div class="form-field">
		<label for="peo_title">Title: </label>
			<select name="peo-title">
				<?php foreach($vars['title'] as $title): ?>
				<option value="<?php print $title; ?>"><?php print $title; ?></option>
			<?php endforeach; ?>
			</select>
	</div>

	<div class="form-field">
		<label for="peo_fname">First Name: <span class="required">*</span></label>
		<input type="text" name="peo-fname" id="peo_fname" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label for="peo_lname">Last Name: <span class="required">*</span></label>
		<input type="text" name="peo-lname" id="peo_lname" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label form="peo_phone">Phone: </label>
		<input type="text" name="peo-phone" id="peo_phone" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label form="peo_mobile">Mobile Phone: </label>
		<input type="text" name="peo-mobile" id="peo-mobile" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label form="peo_email">Email: </label>
		<input type="text" name="peo-email" id="peo_email" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label form="peo_website">Personal Website: </label>
		<input type="text" name="peo-website" id="peo_website" size="60" maxlength="60"  />
	</div>

	<div class="form-field">
		<label form="peo_street">Street Address: </label>
		<input type="text" name="peo-street" id="peo_street" size="60" maxlength="60"  />

		<label form="peo_city">City: </label>
		<input type="text" name="peo-city" id="peo_city" size="60" maxlength="60"  />

		<label form="peo_prosta">Province/State: </label>
		<select name="peo-prosta">
			<?php foreach($vars['state_arr'] as $short => $value): ?>
				<option value="<?php print $short; ?>"><?php print $value; ?></option>
			<?php endforeach; ?>
		</select>

		<label form="peo_country">Country: </label>
		<select name="peo-country">
			<option value="CA">Canada</option>
			<option value="US">USA</option>
		</select>
	</div>

	<div class="form-field">
		<label form="peo_company">Associated Company: </label>
		<select name="peo-company">
			<option value="0"> - </option>
			<?php foreach($vars['company'] as $obj): ?>
				<option value="<?php print $obj->id; ?>"><?php print $obj->name; ?></option>
			<?php endforeach; ?>
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