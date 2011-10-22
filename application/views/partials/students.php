<div class="container form-stacked">
	<div id="filter" class = "row" >
		<?php echo form_open('students'); ?>
		<div class="row">
			<div class = "span5">
				<?php echo form_label('Курс:','course');?>
				<?php echo form_dropdown('course',$options['course']['options'],$options['course']['selected']?$options['course']['selected']:$options['course']['default'],'id=course');?>
			</div>
			
			<div class = "span5">
				<?php echo form_label('Специальность:','spec');?>
				<?php echo form_dropdown('spec',$options['spec']['options'],$options['spec']['selected']?$options['spec']['selected']:$options['spec']['default'],'id=spec');?>
			</div>
		</div>

		<div class="row">
			<div class = "span">
				<?php echo form_submit('show','Показать','class = "btn primary mtop10"');?>
			</div>
		</div>
		<?php echo form_close();?>
				
	</div>
	<?php if (isset($students)): ?>
		
		<?php 
			$tmpl = array ( 'table_open'  => '<table class="zebra-striped mtop10">' );
			$this->table->set_template($tmpl);
			$this->table->set_heading('Имя', 'Срециальность', 'Курс');
			echo $this->table->generate($students);
		?>
	<?php else: ?>
			<div class="span8  offset4 alert-message block-message warning fade in" data-alert="alert">
			        <a href="#" class="close">×</a>
			        <p class="offset2"><strong><?php echo 'Данных нет'; ?></strong></p>
		    </div>
	<?php endif ?>
</div>

