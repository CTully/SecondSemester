<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<?php if(isset($vars['success']) ){ ?>
	<p class="success label">You have successfully changed the company's picture.</p>
<?php } else{ ?>

<?php if($_POST){
	if(isset($vars['upload_errors'])){
		print $vars['upload_errors']; 
	}
}
?>

<form method="POST" enctype="multipart/form-data" >
<fieldset class="form-wrapper">
	<legend>Change your profile picture</legend>
	<?php print validation_errors('<div class="form-error-messages">', '</div>'); ?>

	<div class="form-field">
		<label for="userfile">Profile Picture: </label>
		<input type="file" name="userfile" id="userfile" />
	</div>

	<div class="form-actions">
		<input type="submit" name="submit" value="Send" />
	</div>
</fieldset>
<?php print form_close(); ?>

<?php } ?>