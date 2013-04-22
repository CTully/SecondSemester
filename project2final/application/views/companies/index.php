<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<h2>Companies</h2>

<?php foreach ($vars['data'] as $obj): ?>
	<p><a href="<?php print base_url(); ?>index.php/companies/view/<?php print $obj->id; ?>"><?php print $obj->name; ?></a></p>
<?php endforeach; ?>