<?php
	if (!$this->session->userdata('username')) {
		redirect(base_url() );
	}
?>
<h2>Note has been successfully deleted.</h2>