<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  	<title>logging out </title>
</head>
	<body> 

	<?php
	session_start();
	$_SESSION['logged-in'] = false;
	$_SESSION = array();
	session_destroy();
	echo"you have been logged out: ";
	echo "<a href ='Login.html'>login here</a> ";
	
	?>
	</body>
</html>