<div class="container">
	<div id="filter" class = "row">
		<div class="offset3">
			<?php if ($subject): ?>
				<h3 class="offset2"><?php echo $subject[0]->name; ?></h3>
			<?php endif ?>
		</div>
		<?php if (isset($subject_students)): ?>
			
		<?php 
			$tmpl = array ( 'table_open'  => '<table class="zebra-striped mtop10">' );
			$this->table->set_template($tmpl);
			$this->table->set_heading('Студент', 'Первый модуль', 'Первая рубежка', 'Второй модуль','Вторая рубежка','Третий модуль','Сумма');
			echo $this->table->generate($subject_students);
		?>
		<?php if ($teacher): ?>
			<div class="span5 offset12">
				<span>Преподаватель: <h4><?php echo $teacher[0]->fname; ?></h4></span>
			</div>
		<?php endif ?>
		<?php else: ?>
			
				<div class="alert-message warning mtop10 span8 offset4 fade in" data-alert="alert">
					<a class="close" href="#">×</a>
	    			<p class="offset1"><strong>Данных нет. </strong></p>
    			</div>
		
		<?php endif ?>
	</div>
</div>
	
