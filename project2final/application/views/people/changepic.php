<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<?php if(isset($vars['success']) ): ?>
	<p class="success label">You have successfully changed the person's picture.</p>
<?php endif; ?>

<?php if($_POST){
	if(isset($vars['upload_errors'])){
		print $vars['upload_errors']; 
	}
}
?>

<form method="POST" enctype="multipart/form-data" >
<fieldset class="form-wrapper">
	<legend>Change this person's profile picture</legend>

	<div class="form-field">
		<label form="userfile">Profile Picture: </label>
		<input type="file" name="userfile" id="userfile" size="60" maxlength="60"  />
	</div>

	<div class="form-actions">
		<input type="submit" name="submit" value="Send" />
	</div>
</fieldset>
<?php print form_close(); ?>