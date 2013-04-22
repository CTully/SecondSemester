<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<h2>You are now logged out.</h2>