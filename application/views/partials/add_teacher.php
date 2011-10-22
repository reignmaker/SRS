<div class="container form-stacked">
	<div id="wrapper" class = "row">
		<?php echo form_open('teachers/add');?>
		<div class="row">
			<div class = "span4">
			<?php echo form_label('Полное имя:','fname');?>
			<?php echo form_input($options['name']);?>
			</div>
			<div class = "span4">
			<?php echo form_label('Ученая степень:','degree');?>
			<?php echo form_input($options['degree']);?>
			</div>
			<div class = "span4">
			<?php echo form_label('Звание:','rank');?>
			<?php echo form_input($options['rank']);?>
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