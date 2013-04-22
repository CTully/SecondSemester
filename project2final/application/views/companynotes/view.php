<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<h4><?php print $vars['note']->note; ?></h4>

<p><a href="<?php print base_url(); ?>index.php/companynotes/edit/<?php print $vars['note']->id; ?>" class="button secondary">Edit Company Note</a>   <a href="<?php print base_url(); ?>index.php/companynotes/confirm/<?php print $vars['note']->id; ?>" class="button alert">Delete Company Note</a></p>