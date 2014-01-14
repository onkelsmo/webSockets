<?php
/**
 * webSockets
 * 
 * Just a testing project for webSockets with help from 
 * http://www.sanwebe.com/2013/05/chat-using-websocket-php-socket
 * also see https://github.com/onkelsmo/webSockets
 * 
 * @author jsmolka
 * @since 08.01.2014
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Testing Websockets</title>
		<script type="text/javascript" src="js/jQuery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/websocket.js"></script>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
	</head>
	<body>
		<div class="clientList">
			<div class="clientListHeader">Active Clients</div>
			<hr />
			<div class="list" id="list"></div>
		</div>
		<div class="chatWrapper">
			<div class="messageBox" id="messageBox"></div>
			<hr />
			<div class="panel">
				<input type="text" name="name" id="name" placeholder="You Name" maxlength="6" />
				<input type="text" name="message" id="message" placeholder="Message" maxlength="80" />
				<button id="sendBtn">Send</button>
			</div>
		</div>
	</body>
</html>