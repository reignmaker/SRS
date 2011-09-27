<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Lates</title>

</head>
<body>
	<div>
	
	<?php 
	$this->table->set_heading('Student ID', 'Pair', 'Date');
	echo $this->table->generate($lates);?>
	
	</div>
</body>
</html>