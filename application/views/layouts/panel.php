<div id="panel" class = "topbar-wrapper">

	<div class="topbar">
		<div class="topbar-inner">
			<div class="container">
				<h3><a href="<?php echo base_url(); ?>">IC</a></h3>
				<ul class="nav">
					<li class = "dropdown" data-dropdown="dropdown">
					<a href="#" class = "dropdown-toggle">Студенты</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url(); ?>index.php/students">Список студентов</a></li>
						<li><a href="<?php echo base_url(); ?>index.php/students/add_student">Добавить студента</a></li>
					</ul>
					</li>

					<li class="dropdown" data-dropdown="dropdown">
						<a href="#" class="dropdown-toggle">Предметы</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url(); ?>index.php/subjects">Список предметов</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/subjects/add_subject">Добавить предмет</a></li>
						</ul>
					</li>
					<li class="dropdown" data-dropdown="dropdown">
						<a href="#" class="dropdown-toggle">Преподаватели</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url(); ?>index.php/teachers">Список преподавателей</a></li>
							<li><a href="<?php echo base_url(); ?>index.php/teachers/add_teacher">Добавить преподавателя</a></li>
						</ul>
					</li>
					<li class="dropdown" data-dropdown="dropdown">
						<a href="#" class="dropdown-toggle">Баллы</a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url(); ?>index.php/frontiers">Просмотр баллов</a></li>
						</ul>
					</li>
				</ul>
				<?php if ($user): ?>
					<div id="user">
						<p class="name"><span class="label success"><?php echo $user['name']; ?></p></span>
						<?php if ($user['permission'] == 'manage'): ?>
							<?php echo anchor('logout','Выход','title="Завершить сессию."'); ?>
						<?php endif ?>
					</div>
				<?php endif ?>
			</div>
		</div>
	</div>
</div>