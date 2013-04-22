<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<h2>Company has been successfully deleted.</h2>