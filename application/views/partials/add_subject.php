<div class="container mtop60">
	<div id="wrapper" class = "row">
	<?php echo form_open('subjects/add');?>
	<div class="row">
		<div class = "span5">
		<?php echo form_label('Название предмета:','name');?>
		<?php echo form_input($options['name']);?>
		</div>
		<div class = "span5">
		<?php echo form_label('Специальность:','spec');?>
		<?php echo form_dropdown('spec',$options['spec'],'','id=spec');?>
		</div>
	</div>
	
	<div class="row">
		<div class = "span5">
		<?php echo form_label('Курс:','course');?>
		<?php echo form_dropdown('course',$options['course'],'','id=course');?>
		</div>
		<div class = "span5 offset">
		<?php echo form_label('Семестр:','semester');?>
		<?php echo form_dropdown('semester',$options['semester'],'','id=semester');?>
		</div>
	</div>
	<div class = "span">
	<?php echo form_submit('add','Добавить','class = "btn primary mtop10"'); ?>
	</div>
	<?php echo form_close();?>
	</div>
</div>
