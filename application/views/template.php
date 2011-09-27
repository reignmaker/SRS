<?php if (isset($title)): ?>
<?php $this->load->view('layouts/header',$title); ?>	
<?php else: ?>
<?php $this->load->view('layouts/header'); ?>	
<?php endif ?>


<?php if (isset($panel)): ?>
<?php $this->load->view('layouts/panel',$panel); ?>	
<?php else: ?>
<?php $this->load->view('layouts/panel'); ?>	
<?php endif ?>


<?php if (isset($partial)): ?>
<?php $this->load->view($partial); ?>
<?php endif ?>

<?php if (isset($footer)): ?>
<?php $this->load->view('layouts/footer',$footer); ?>	
<?php else: ?>
<?php $this->load->view('layouts/footer'); ?>	
<?php endif ?>
