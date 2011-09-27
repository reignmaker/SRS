<div  class="container">
		<div class="modal login">
          <div class="modal-header">
            <h3>Авторизация</h3>
          </div>
          <div class="modal-body">
			<?php echo form_open('home/login'); ?>
			<div class="row">
				<?php echo form_label('Логин:','name'); ?>
				<?php echo form_input('name','','id="name"'); ?>
			</div>
			<div class="row">
				<?php echo form_label('Пароль:','pwd'); ?>
				<?php echo form_password('pwd','','id="pwd"'); ?>
			</div>
			
          </div>
          <div class="modal-footer">
            <button class="btn primary" >Войти</button>
          </div>
          	<?php echo form_close(); ?>
        </div>
</div>
		