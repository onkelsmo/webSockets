<?php
/**
*
* The Server class 
*
* @author SmO
* @since 23.01.2014
*
**/
class Server
{
	private $host = 'localhost';
	private $port = '9000'; 
	private $null = NULL;
	private $socket;
	private $clients = array();
	
	public function __construct()
	{
		try 
		{
			//Create TCP/IP sream socket
			$this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
			//reuseable port
			socket_set_option($this->socket, SOL_SOCKET, SO_REUSEADDR, 1);
			//bind socket to specified host
			socket_bind($this->socket, 0, $this->port);
			//listen to port
			socket_listen($this->socket);
			//add listning socket to the list
			$this->clients[] = $this->socket;
			
			echo "[Info]socket created\n";
		}
		catch (Exception $e)
		{
			echo "[Error]" . $e->getMessage();
		}
	}
	
	public function start()
	{
		echo "[Info]server startet!\n";
		//start endless loop, so that our script doesn't stop
		while (true) 
		{
			//manage multipal connections
			$changed = $this->clients;
			//returns the socket resources in $changed array
			socket_select($changed, $this->null, $this->null, 0, 10);
		
			//check for new socket
			if (in_array($this->socket, $changed)) {
				$socket_new = socket_accept($this->socket); //accpet new socket
				$this->clients[] = $socket_new; //add socket to client array
		
				$header = socket_read($socket_new, 1024); //read data sent by the socket
				$this->perform_handshaking($header, $socket_new, $this->host, $this->port); //perform websocket handshake
		
				socket_getpeername($socket_new, $ip); //get ip address of connected socket
				$response = $this->mask(json_encode(array('type'=>'system', 'message'=>$ip.' connected'))); //prepare json data
				$this->send_message($response); //notify all users about new connection
		
				//make room for new socket
				$found_socket = array_search($this->socket, $changed);
				unset($changed[$found_socket]);
			}
		
			//loop through all connected sockets
			foreach ($changed as $changed_socket)
			{
				//check for any incomming data
				while(socket_recv($changed_socket, $buf, 1024, 0) >= 1)
				{
					$received_text = $this->unmask($buf); //unmask data
					$tst_msg = json_decode($received_text); //json decode
					
					if ($tst_msg == null)
					{
						continue;
					}
					
					$user_name = $tst_msg->name; //sender name
					$user_message = $tst_msg->message; //message text
					$user_color = $tst_msg->color; //color
					$user_time = $tst_msg->time;
						
					$clientArray[$ip] = $tst_msg->name;
					//$clientArray = array_unique($clientArray);
						
					//prepare data to be sent to client
					$response_text = $this->mask(json_encode(array('type'=>'usermsg', 'name'=>$user_name, 'message'=>$user_message, 'color'=>$user_color, 'time'=>$user_time, 'clients'=>$clientArray)));
					$this->send_message($response_text); //send data
					break 2; //exist this loop
				}
		
				$buf = @socket_read($changed_socket, 1024, PHP_NORMAL_READ);
				if ($buf === false) { // check disconnected client
					// remove client for $clients array
					$found_socket = array_search($changed_socket, $this->clients);
					socket_getpeername($changed_socket, $ip);
					unset($this->clients[$found_socket]);
		
					//notify all users about disconnected connection
					$response = $this->mask(json_encode(array('type'=>'system', 'message'=>$ip.' disconnected')));
					$this->send_message($response);
				}
			}
		}
		
		// close the listening socket
		echo "[Info]connection closed\n";
		socket_close($sock);
	}
	
	private function send_message($msg)
	{
		//global $clients;
		echo "[Info]message send\n";
		foreach($this->clients as $changed_socket)
		{
			@socket_write($changed_socket,$msg,strlen($msg));
		}
		return true;
	}
	
	//Unmask incoming framed message
	private function unmask($text) {
		$length = ord($text[1]) & 127;
		if($length == 126) {
			$masks = substr($text, 4, 4);
			$data = substr($text, 8);
		}
		elseif($length == 127) {
			$masks = substr($text, 10, 4);
			$data = substr($text, 14);
		}
		else {
			$masks = substr($text, 2, 4);
			$data = substr($text, 6);
		}
		$text = "";
		for ($i = 0; $i < strlen($data); ++$i) {
			$text .= $data[$i] ^ $masks[$i%4];
		}
		return $text;
	}
	
	//Encode message for transfer to client.
	private function mask($text)
	{
		$b1 = 0x80 | (0x1 & 0x0f);
		$length = strlen($text);
	
		if($length <= 125)
			$header = pack('CC', $b1, $length);
		elseif($length > 125 && $length < 65536)
		$header = pack('CCn', $b1, 126, $length);
		elseif($length >= 65536)
		$header = pack('CCNN', $b1, 127, $length);
		return $header.$text;
	}
	
	//handshake new client.
	private function perform_handshaking($receved_header,$client_conn, $host, $port)
	{
		echo "[Info]handshaking new client\n";
		$headers = array();
		$lines = preg_split("/\r\n/", $receved_header);
		foreach($lines as $line)
		{
			$line = chop($line);
			if(preg_match('/\A(\S+): (.*)\z/', $line, $matches))
			{
				$headers[$matches[1]] = $matches[2];
			}
		}
	
		$secKey = $headers['Sec-WebSocket-Key'];
		$secAccept = base64_encode(pack('H*', sha1($secKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
		//hand shaking header
		$upgrade  = "HTTP/1.1 101 Web Socket Protocol Handshake\r\n" .
				"Upgrade: websocket\r\n" .
				"Connection: Upgrade\r\n" .
				"WebSocket-Origin: $host\r\n" .
				"WebSocket-Location: ws://$host:$port/demo/shout.php\r\n".
				//"WebSocket-Location: ws://$host:$port/webSockets/server.php\r\n".
		"Sec-WebSocket-Accept:$secAccept\r\n\r\n";
		socket_write($client_conn,$upgrade,strlen($upgrade));
	}
}

?>