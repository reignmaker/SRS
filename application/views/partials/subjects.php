<div class="container">
	<div id="filter" class = "row mtop60">
		<?php echo form_open('subjects'); ?>
		<div class="row">
			<div class = "span5">
				<?php echo form_label('Курс:','course'); ?>
				<?php echo form_dropdown('course',$options['course']['options'],$options['course']['selected']?$options['course']['selected']:$options['course']['default'],'id=course');?>
			</div>
			
			<div class = "span5">
				<?php echo form_label('Семестр:','semester');?>
				<?php echo form_dropdown('semester',$options['semester']['options'],$options['semester']['selected']?$options['semester']['selected']:$options['semester']['default'],'id=semester');?>
			</div class = "span5">
		</div>

		<div class="row">
			<div class = "span5">
				<?php echo form_label('Специальность:','spec');?>
				<?php echo form_dropdown('spec',$options['spec']['options'],$options['spec']['selected']?$options['spec']['selected']:$options['spec']['default'],'id=spec');?>
			</div>
		</div>

		<div class = "span">
			<?php echo form_submit('show','Показать','class = "btn primary mtop10"');?>
			<?php echo form_close();?>
		</div>
		
		<?php 
			$tmpl = array ( 'table_open'  => '<table class="zebra-striped mtop10">' );
			$this->table->set_template($tmpl);
			$this->table->set_heading('Наименование', 'Срециальность','Курс','Семестр' );
			echo $this->table->generate($subjects);
		?>
	</div>
</div>
	
