<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<?php if($vars['success'] === 1 ){ ?>
	<p class="success label">You have successfully edited a company note.</p>
<?php } else{ ?>

<form method="POST">
<fieldset class="form-wrapper">
	<legend>Add a note about the company</legend>
	<?php print validation_errors('<p class="validation-error">', '</p><br />'); ?>

	<div class="form-field">
		<label form="e_com_note">Note: <span class="required">*</span></label>
		<textarea name="e-com-note" id="e-com-note" size="60" maxlength="60" ><?php print $vars['data']->note; ?></textarea>
	</div>

	<div class="form-actions">
		<input type="submit" name="submit" value="Send" />
	</div>
</fieldset>
<?php print form_close(); 
}
?>