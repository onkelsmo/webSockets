<?php
/**
*
* stops the server
*
* @author SmO
* @since 12.01.2014
*
**/
//$output = passthru('ps ax | grep server\.php');
$output = shell_exec('ps ax | grep server\.php');

$ar = preg_split('/ /', $output);

echo "<pre>";
var_dump(getmypid());
echo "</pre>";

if (in_array('php', $ar))
{
	$pid = (int) $ar[0];
	var_dump($pid);

	//posix_kill($pid, SIGKILL);
}

?>