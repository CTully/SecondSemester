<?php if (!$this->session->userdata('username') ){
	redirect(base_url() );
}
if ( $vars['success'] === 1) { ?>
	<p class="success label">Your information successfully changed.</p>
<?php 
}
else{
?>

<form method="POST">
<fieldset class="form-wrapper">
	<legend>Edit</legend>
	<?php print validation_errors('<div class="form-error-messages">', '</div>'); ?>

	<div class="form-field">
		<label for="e_username">Username: <span class="required">*</span></label>
		<input type="text" name="e-username" id="e_username" size="60" maxlength="60" value="<?php print $vars['username']; ?>"/>
	</div>

	<div class="form-field">
		<label form="e_email">Email Address: <span class="required">*</span></label>
		<input type="text" name="e-email" id="e_email" size="60" maxlength="60"  
		value="<?php print $vars['query_info']['email']; ?>"/>
	</div>

	<div class="form-actions">
		<input type="submit" name="submit" value="Send" />
	</div>
</fieldset>
<?php print form_close(); ?>

<?php } ?>