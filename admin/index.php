<?php
/**
*
* index.php of the adminpanel 
*
* @author jsmolka
* @since 11.01.2014
*
**/
include_once '../lib/freaky_functions.php';

$run = false;

if (isset($_POST))
{
	$post = $_POST;
	if (isset($post['Start']))
	{
		$run = true;
	}	
	else if (isset($post['Stop']))
	{
		$run = false;
	}
	else 
	{
		exit;
	}
}




	

if ($run === true)
{
	$output = shell_exec('php -q c:\xampp\htdocs\webSockets\server.php');
	dump($output);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Server Administration</title>
	</head>
	<body>
		<form action="" method="post">
			<label for="Start">Start</label>
			<input type="radio" name="Start" value="start" />
			<label for="Stop">Stop</label>
			<input type="radio" name="Stop" value="stop" />
			<input type="submit" value="Save" />
		</form>
	</body>
</html>
