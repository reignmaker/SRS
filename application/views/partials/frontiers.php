<div class="container">
	<div id="filter" class = "row form-stacked">
		
	<?php echo form_open('frontiers');?>
	
		<div class="row">
			
			<div class="span5">
			<?php echo form_label('Специальность:','spec');?>
			<?php echo form_dropdown('spec',$options['spec']['options'],$options['spec']['selected']?$options['spec']['selected']:$options['spec']['default'],'id=spec');?>
			</div>

			<div class="span5">
			<?php echo form_label('Курс:','course');?>
			<?php echo form_dropdown('course',$options['course']['options'],$options['course']['selected']?$options['course']['selected']:$options['course']['default'],'id=course');?>
			</div>
				
		</div>
	
		<div class="row">
			<div class="span5">	
			<?php echo form_label('Предмет:','subject');?>
			<?php echo form_dropdown('subject',$options['subject']['options'],$options['subject']['selected']?$options['subject']['selected']:$options['subject']['default'],'id=subject');?>
			</div>
			
			<div class="span5">
			<?php echo form_label('Период:','period');?>
			<?php echo form_multiselect('period[]',$options['period']['options'],$options['period']['selected']?$options['period']['selected']:$options['period']['default'],'id=period');?>
			</div>
		</div>
	
		<div class="span">
			<?php echo form_submit('show','Показать','class = "btn primary mtop10"');?>
		</div>
		<?php echo form_close();?>	
	</div>
	<div class = "row content">
	<?php if (isset($frontiers)): ?>
		<?php 
			$tmpl = array ( 'table_open'  => '<table class="zebra-striped mtop10">' );
			$this->table->set_template($tmpl);
			if (isset($theading))$this->table->set_heading($theading);
			$this->table->set_caption(implode(', ',$caption));
			echo $this->table->generate($frontiers);	
		?>
	<?php else: ?>
      	<div class="alert-message warning mtop10 span8 offset4 fade in" data-alert="alert">
				<a class="close" href="#">×</a>
    			<p class="offset1"><strong>Данных нет. </strong>Попробуйте изменить фильтр.</p>
    	</div>
	<?php endif ?>
	
	
	</div>
</div>
<script type="text/javascript">
jQuery(function(){
	
	$('.mark').click(function(e){
		var obj = $(this);
		var thIndex = $('.content table th')[$(this).index()];
		var moduleName = $(thIndex).html();
		var subjName = $(this).parent().find('input').attr('name');
		var name = obj.parent().find('.name').html();
		var id = obj.parent().find('.name').attr('id');
		var mark = obj.html();
		var summOld = parseInt(obj.parent().find('.summ').html())
			delta = 0;
		var template = '<div style="position: absolute;  margin: auto auto; z-index: 1" class="modal popup"><div class="modal-header"><p>'+ name +', '+subjName+'</p><a class="close" href="#">×</a></div><div class="modal-body"><label for="module">'+ moduleName +'</label><input type="text" id="module" name = "module" value = "'+ mark+'"></div><div class="modal-footer"><a class="btn primary send" href="#">Принять</a><a class="btn secondary" href="#">Отмена</a></div></div>';
      
		markData = {}
		markData.id = id;
		markData.field = obj.attr('rel');
		markData.subjId = obj.parent().find('input').val();
		console.log(markData);
		$('.modal').remove();
		$('.content').append(template);
		$('.send').click(function(e){
			e.preventDefault();
			markData.val = parseInt($(this).parents('.modal').find('#module').val());
			$.ajax({
				url:"<?php echo site_url('frontiers/actions') ?>",
				type:'POST',
				data: markData,
				success: function(msg){
					console.log(obj.html());
					obj.html(markData.val);
					console.log(obj.html());
					/*obj.parent().find('.summ').html(summOld + parseInt(markData.val));*/
					$('.modal').remove();
					$('.content').append('<div class="alert-message success"><a href="#" class="close">×</a><p>'+msg+'</p></div>');
					close($('.alert-message'),2000);
				}
			});
		});
		
	$('a.secondary, .close').click(function(e){e.preventDefault();close($('.modal'))});
	});
	close = function(el,timeOut){
		el.fadeOut(timeOut,function(){
			$(this).remove();
		});
	}
});	


</script>
