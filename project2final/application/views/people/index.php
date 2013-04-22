<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<h2>People</h2>

<?php foreach ($vars['data'] as $obj): ?>
	<p><a href="<?php print base_url(); ?>index.php/people/view/<?php print $obj->id; ?>"><?php print $obj->lname . ', ' . $obj->fname; ?></a></p>
<?php endforeach; ?>