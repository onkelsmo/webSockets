<?php
/**
*
* index.php of the adminpanel 
*
* @author jsmolka
* @since 11.01.2014
*
**/
// include_once '../lib/freaky_functions.php';

// //$run = false;

// if (isset($_POST))
// {
// 	$post = $_POST;
	
// 	if (isset($post['Start']))
// 	{
// 		$run = true;		
// 	}	
// 	else if (isset($post['Stop']))
// 	{	
// 		$run = false;
// 	}
// }

// if ($run === true)
// {
// 	//$output = shell_exec(addslashes("php -q /var/www/webSockets/server.php"));
// 	//exec(addslashes("php -q /var/www/webSockets/server.php"));
// 	$handle = popen("php ../server.php", "r");
// }
// else if ($run === false)
// {
// 	$output = passthru('ps ax | grep server\.php');
// 	$ar = preg_split('/ /', $output);
// 	if (in_array('/usr/bin/php', $ar)) 
// 	{
// 		$pid = (int) $ar[0];
// 		posix_kill($pid, SIGKILL);
// 	}
// 	//exec(addslashes("php -q /var/www/webSockets/server.php stop"));
// }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Server Administration</title>
	</head>
	<body>
		<form action="start.php" method="post">
			<input type="submit" value="Start" />
		</form>
		<form action="stop.php" method="post">
			<input type="submit" value="Stop" />
		</form>
	</body>
</html>

