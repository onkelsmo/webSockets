<?php
/**
*
* Start Server with specific attributes 
*
* @author SmO
* @since 23.01.2014
*
**/
require 'classes/Server.php';
require 'classes/Log.php';

$server = new Server();

var_dump($server); 

$server->start();

?>