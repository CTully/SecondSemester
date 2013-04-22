<?php defined('BASEPATH') or exit; ?>

<?php if (isset($view_filename) ): ?>

	<?php $this->load->view($view_filename); ?>
	
<?php endif; ?>