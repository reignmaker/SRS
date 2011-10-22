<div class="container form-stacked">
	<div id="wrapper" class = "row">
		<?php echo form_open('students/add');?>
		<div class="row">
			<div class = "span4">
			<?php echo form_label('Полное имя:','fname');?>
			<?php echo form_input($options['name']);?>
			</div>
			<div class = "span4">
			<?php echo form_label('Специальность:','spec');?>
			<?php echo form_dropdown('spec',$options['spec'],'','id=spec');?>
			</div>
			<div class = "span4">
			<?php echo form_label('Курс:','course');?>
			<?php echo form_dropdown('course',$options['course'],'','id=course');?>
			</div>
		</div>
		
		<div class="row">
			<div class = "span4">
			<?php echo form_label('Год поступления:','yoe');?>
			<?php echo form_input($options['yoe']);?>
			</div>
			<div class = "span4">
			<?php echo form_label('Адрес:','address');?>
			<?php echo form_input($options['addr']);?>
			</div>
			<div class = "span4">
			<?php echo form_label('Телефон:','phone');?>
			<?php echo form_input($options['phone']);?>
			</div>
		</div>
		<div class = "span">
		<?php echo form_submit('add','Добавить','class = "btn primary mtop10"'); ?>
		</div>
		<?php echo form_close();?>
	</div>
		<?php if (isset($msg)): ?>
		   	<div class="alert-message warning mtop10 span12 fade in" data-alert="alert">
				<a class="close" href="#">×</a>
    			<p><?php echo $msg ?></p>
    		</div>
		<?php endif ?>
</div>