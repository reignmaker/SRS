<div class="container">
	<div id="filter" class = "row mtop60">
		
	<?php echo form_open('frontiers');?>
	
		<div class="row">
			<div class="span5">
			<?php echo form_label('Курс:','course');?>
			<?php echo form_dropdown('course',$options['course']['options'],$options['course']['selected']?$options['course']['selected']:$options['course']['default'],'id=course');?>
			</div>
				
			<div class="span5">
			<?php echo form_label('Специальность:','spec');?>
			<?php echo form_dropdown('spec',$options['spec']['options'],$options['spec']['selected']?$options['spec']['selected']:$options['spec']['default'],'id=spec');?>
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
	
	<?php 
	echo form_open('frontiers/actions');
	$tmpl = array ( 'table_open'  => '<table class="zebra-striped mtop10">' );
	$this->table->set_template($tmpl);
	$this->table->set_heading($theading);
	$this->table->set_caption(implode(', ',$caption));
	if (isset($frontiers)){
/*		foreach ($frontiers as $key => $value) {
			$cell = array('data' => $value, 'class' => $key);
			echo var_dump($cell);
			$this->table->add_row($cell);
		}*/
	echo $this->table->generate($frontiers);
	echo form_submit('action','Выполнить');
	echo form_close();
	}
	else {
		echo "<h2 class = 'offset5'>Данных нет</h2>";
	}

	/*echo "<pre>". cyr_json($frontiers). "</pre>";*/
	?>
	
	</div>
</div>
<script type="text/javascript">
jQuery(function(){
	
	$('.mark').click(function(e){
		var obj = $(this);
		var thIndex = $('.content table th')[$(this).index()];
		var moduleName = $(thIndex).html();
		var subjName = $('#subject option:selected').html();
		var name = $(this).parent().find('.name').html();
		var id = $(this).parent().find('.name').attr('id');
		var mark = $(this).html();
		var template = '<div style="position: absolute;  margin: auto auto; z-index: 1" class="modal popup"><div class="modal-header"><p>'+ name +', '+subjName+'</p><a class="close" href="#">×</a></div><div class="modal-body"><label for="module">'+ moduleName +'</label><input type="text" id="module" name = "module" value = "'+ mark+'"></div><div class="modal-footer"><a class="btn primary send" href="#">Принять</a><a class="btn secondary" href="#">Отмена</a></div></div>';
      
		markData = {}
		markData.id = id;
		markData.field = $(this).attr('rel');
		markData.subjId = $('#subject option:selected').val()*1;
		console.log(markData);
		$('.modal').remove();
		$('.content').append(template);
		$('.send').click(function(e){
			e.preventDefault();
			markData.val = $(this).parents('.modal').find('#module').val();
			$.ajax({
				url:"<?php echo site_url('frontiers/actions') ?>",
				type:'POST',
				data: markData,
				success: function(msg){
					obj.html(markData.val);
					$('.modal').remove();
					$('.content').append('<div class="alert-message success"><a href="#" class="close">×</a><p>'+msg+'</p></div>');
					close($('.alert-message'),2000);
				}
			});
		});
		
	$('a.secondary, .close').click(function(){close($('.modal'))});
	});
	close = function(el,timeOut){
		el.fadeOut(timeOut,function(){
			$(this).remove();
		});
	}
});	


</script>
