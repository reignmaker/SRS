<div class="container">
	<div id="filter" class="row mtop60">
		<?php echo form_open('students/view'.$this->uri->slash_segment(3, 'leading')); ?>
		<div class="row">
			<div class = "span5">
				<?php echo form_label('Курс:','course');?>
				<?php echo form_dropdown('course',$options['course']['options'],$options['course']['selected']?$options['course']['selected']:$options['course']['default'],'id=course');?>
			</div>
			
			<div class = "span5">
				<?php echo form_label('Семестр:','semester');?>
				<?php echo form_dropdown('semester',$options['semester']['options'],$options['semester']['selected']?$options['semester']['selected']:$options['semester']['default'],'id=semester');?>
			</div>
		</div>

		<div class="row">
			<div class = "span">
				<?php echo form_submit('show','Показать','class = "btn primary mtop10"');?>
			</div>
		</div>
		
		<?php echo form_close();?>
	</div>
	<div class="offset5">
			<?php if ($student): ?>
				<h3><?php echo $student->fname.', '.$student->spec.', '.$student->course.' курс'; ?></h3>
			<?php endif ?>
	</div>
	<?php 
		$tmpl = array ( 'table_open'  => '<table class="zebra-striped mtop10">' );
		$this->table->set_template($tmpl);
		$this->table->set_heading('Предмет','Специальность','Первый модуль', 'Первая рубежка', 'Второй модуль','Вторая рубежка','Третий модуль');
		echo $this->table->generate($student_subjects);
	?>
</div>