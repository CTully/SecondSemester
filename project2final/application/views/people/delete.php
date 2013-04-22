<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<h2>Person has been successfully deleted.</h2>