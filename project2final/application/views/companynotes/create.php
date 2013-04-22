<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<?php if(isset($vars['success']) ): ?>
	<p class="success label">You have successfully added a company note.</p>
<?php endif; ?>

<form method="POST">
<fieldset class="form-wrapper">
	<legend>Add a note about the company</legend>
	<?php print validation_errors('<p class="validation-error">', '</p><br />'); ?>

	<div class="form-field">
		<label form="com_note">Note: <span class="required">*</span></label>
		<textarea name="com-note" id="com-note" size="60" maxlength="60" ></textarea>
	</div>

	<div class="form-actions">
		<input type="submit" name="submit" value="Send" />
	</div>
</fieldset>
<?php print form_close(); ?>