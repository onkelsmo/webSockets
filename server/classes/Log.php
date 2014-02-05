<?php
/**
 * Log - Logging class establish file-logging, console-printing
 * 
 * @author jsmolka
 * @since 05.02.2014
 */
class Log
{
	// constants
	const METHOD_CONSOLE = 'CONSOLE';
	const METHOD_FILE = 'FILE';
	const TYPE_INFO = 'INFO';
	const TYPE_ERROR = 'ERROR';
	
	private $method;
	private $type;
	private $message;
	
	public static function Log($method = self::METHOD_CONSOLE, $type = self::TYPE_INFO, $message = "")
	{
		$this->method = $method;
		$this->type = $type;
		$this->message = $message;
	}
}
