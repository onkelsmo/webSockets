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
	<!-- switch between stylesheets for different screen resolutions -->
	<link rel="stylesheet" type="text/css" href="css/main.css" 
			media="screen and (min-width: 501px)" />
	<link rel="stylesheet" type="text/css" href="css/mobile.css"
			media="screen and (max-width: 500px)" />
	
	<!-- switching templates
	<script type="text/javascript">
			$(window).load(function() {
			    var windowSize = $(window).width();
			      if (windowSize <= 700) {
			            $('body').load('templates/mobileIndex.php');
			        }
			        // just for the use of a tablet pc
			        /*
			        else if (windowSize <= 979) {
			           $('#block1').load('block1_pad.html');     
			        }
			        */
			        else if (windowSize >= 701) {
			           $('body').load('templates/desktopIndex.php');    
			        }
			});
		</script>		
		-->
		
		
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
			<input type="text" name="name" id="name" placeholder="You Name" maxlength="10" />
			<input type="text" name="message" id="message" placeholder="Message" maxlength="80" />
			<button id="sendBtn">Send</button>
		</div>
	</div>
</body>
</html>