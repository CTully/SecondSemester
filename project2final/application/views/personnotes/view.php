<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<h4><?php print $vars['note']->note; ?></h4>

<p><a href="<?php print base_url(); ?>index.php/personnotes/edit/<?php print $vars['note']->id; ?>" class="button secondary">Edit Person Note</a>   <a href="<?php print base_url(); ?>index.php/personnotes/confirm/<?php print $vars['note']->id; ?>" class="button alert">Delete Person Note</a></p>