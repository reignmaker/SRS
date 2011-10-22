<div class="container">
	<div class="row">
		<?php if ($teachers): ?>
				
			<?php 
				$tmpl = array ( 'table_open'  => '<table class="zebra-striped mtop10">' );
				$this->table->set_template($tmpl);
				$this->table->set_heading('Имя', 'Ученая степень','Звание');
				echo $this->table->generate($teachers);
			?>
		<?php else: ?>
				<div class="span8  offset4 alert-message block-message warning fade in" data-alert="alert">
				        <a href="#" class="close">×</a>
				        <p class="offset2"><strong><?php echo 'Данных нет'; ?></strong></p>
			    </div>
		<?php endif ?>
	</div>
</div>
	
