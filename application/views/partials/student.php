<div class="container form-stacked">
	<div id="filter">
		<?php echo form_open('students/view'.$this->uri->slash_segment(3, 'leading'),array('class'=>'span10 ')); ?>
		<div class="row">
			<div class = "span4">
				<?php echo form_label('Курс:','course');?>
				<?php echo form_dropdown('course',$options['course']['options'],$options['course']['selected']?$options['course']['selected']:$options['course']['default'],'id=course');?>
			</div>
			
			<div class = "span4">
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
	<?php if ($student): ?>
		<div class="span5 student-info well">
			<ul>
				<li><span>Год поступления: </span><?php echo $student->yoe; ?></li>
				<li><span>Адрес: </span><?php echo $student->address; ?></li>
				<li><span>Тел: </span><?php echo $student->phone; ?></li>
			</ul>
		</div>
		<div class="offset5 span8">
					<h3><?php echo $student->fname.', '.translate_term($student->spec).', '.$student->course.' курс'; ?></h3>
		</div>
	<?php endif ?>
	<?php if (isset($student_subjects)): ?>
		<div class="row">
		<?php 
			$tmpl = array ( 'table_open'  => '<table class="zebra-striped mtop10">' );
			$this->table->set_template($tmpl);
			$this->table->set_heading('Предмет','Первый модуль', 'Первая рубежка', 'Второй модуль','Вторая рубежка','Третий модуль', 'Сумма');
			echo $this->table->generate($student_subjects);
		?>
		</div>
	<?php else: ?>
			
				<div class="alert-message warning mtop10 span8 offset4 fade in" data-alert="alert">
					<a class="close" href="#">×</a>
	    			<p class="offset1"><strong>Данных нет. </strong></p>
    			</div>	
	<?php endif ?>
</div>