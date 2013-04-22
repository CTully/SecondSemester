<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<h2>Your account has been deleted.</h2>

<a href="<?php print base_url(); ?>">Back to Home</a>