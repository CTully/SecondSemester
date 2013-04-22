<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<?php if($vars['success'] === 1){ ?>
	<p class="success label">You have successfully edited a person.</p>
<?php }
else{
?>

<form method="POST">
<fieldset class="form-wrapper">
	<legend>Edit a Person Contact</legend>
	<?php print validation_errors('<div class="form-error-messages">', '</div>'); ?>

	<div class="form-field">
		<label for="e_peo_title">Title: <span class="required">*</span></label>
		<select name="e-peo-title">
				<?php foreach($vars['title'] as $title): 
				if($title === $vars['data']->title){ ?>
				<option value="<?php print $title; ?>" selected><?php print $title; ?></option>
				<?php }else{ ?>
				<option value="<?php print $title; ?>"><?php print $title; ?></option>
			<?php }
			endforeach; ?>
			</select>
		</select>
	</div>

	<div class="form-field">
		<label for="e_peo_fname">First Name: <span class="required">*</span></label>
		<input type="text" name="e-peo-fname" id="e-peo_fname" size="60" maxlength="60" value="<?php print $vars['data']->fname; ?>"/>
	</div>

	<div class="form-field">
		<label for="e_peo_lname">Last Name: <span class="required">*</span></label>
		<input type="text" name="e-peo-lname" id="e-peo_lname" size="60" maxlength="60" value="<?php print $vars['data']->lname; ?>" />
	</div>

	<div class="form-field">
		<label form="e_peo_phone">Phone: </label>
		<input type="text" name="e-peo-phone" id="e-peo_phone" size="60" maxlength="60" value="<?php print $vars['data']->phone; ?>" />
	</div>

	<div class="form-field">
		<label form="e_peo_mobile">Mobile Phone: </label>
		<input type="text" name="e-peo-mobile" id="e-peo-mobile" size="60" maxlength="60" value="<?php print $vars['data']->mobile; ?>" />
	</div>

	<div class="form-field">
		<label form="e_peo_email">Email: </label>
		<input type="text" name="e-peo-email" id="e-peo-email" size="60" maxlength="60" value="<?php print $vars['data']->email; ?>" />
	</div>

	<div class="form-field">
		<label form="e_peo_website">Personal Website: </label>
		<input type="text" name="e-peo-website" id="e-peo-website" size="60" maxlength="60" value="<?php print $vars['data']->website; ?>" />
	</div>

	<div class="form-field">
		<label form="e_peo_street">Street Address: </label>
		<input type="text" name="e-peo-street" id="e-peo_street" size="60" maxlength="60" value="<?php print $vars['data']->inputted_address; ?>" />

		<label form="e_peo_city">City: </label>
		<input type="text" name="e-peo-city" id="e-peo_city" size="60" maxlength="60" value="<?php print $vars['data']->inputted_city; ?>" />

		<label form="e-peo_prosta">Province/State: </label>
		<select name="e-peo-prosta">
			<?php foreach($vars['state_arr'] as $short => $value): ?>
				<?php if($vars['data']->inputted_prosta == $short){ ?>
				<option value="<?php print $short; ?>" selected><?php print $value; ?></option>
				<?php } else { ?>
				<option value="<?php print $short; ?>"><?php print $value; ?></option>
				<?php } ?>
			<?php endforeach; ?>
		</select>

		<label form="e_peo_country">Country: </label>
		<select name="e-peo-country">
			<?php if ($vars['data']->inputted_country == 'CA') { ?>
				<option value="CA" selected>Canada</option>
				<option value="US">USA</option>
			<?php } else { ?>
				<option value="CA">Canada</option>
				<option value="US" selected>USA</option>
			<?php } ?>			
		</select>
	</div>

	<div class="form-field">
		<label form="e_peo_company">Associated Company: </label>
		<select name="e-peo-company">
			<option value="0"> - </option>
			<?php foreach($vars['companies'] as $obj): ?>
				<?php if($obj->id == $vars['data']->company_id){ ?>
					<option value="<?php print $obj->id; ?>" selected><?php print $obj->name; ?></option>
				<?php }else{ ?>
					<option value="<?php print $obj->id; ?>"><?php print $obj->name; ?></option>
				<?php } ?>
			<?php endforeach; ?>
		</select>
	</div>

	<div class="form-actions">
		<input type="submit" name="submit" value="Send" />
	</div>
</fieldset>
<?php print form_close(); 
}
?>