<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Calendar</title>
	<style>
		table.calendar{
			margin:auto;
			border-collapse:collapse;
		}
		table.calendar tr td{
			padding: 40px;
			background:#DEF;
		}
		table.calendar tr td:hover{
			background:#FFF;
		}
		a{
			padding:3px;
			background:#999;
			color:red;
		}
		a:visited{
			color:#FFF;
		}
	</style>
</head>
<body>
	<?php echo $calendar; ?>
	<?php echo $total_days; ?>
</body>
</html>