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
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script type="text/javascript" src="js/jQuery-1.10.2.min.js"></script>
		<script type="text/javascript" src="js/jQuery.mobile-1.4.0.min.js"></script>
		<script type="text/javascript" src="js/websocket.js"></script>
		
		<!-- switch between templates -->
		<script type="text/javascript">
			$(window).load(function() {
			    var windowSize = $(window).width();
			      if (windowSize <= 767) {
			            $('body').load('templates/mobileIndex.php');
			        }
			        // just for the use of a tablet pc
			        /*
			        else if (windowSize <= 979) {
			           $('#block1').load('block1_pad.html');     
			        }
			        */
			        else if (windowSize >= 767) {
			           $('body').load('templates/desktopIndex.php');    
			        }
			});
		</script>
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		<link rel="stylesheet" type="text/css" href="css/jQuery.mobile-1.4.0.min.css" />		
		<!-- switch between stylesheets for different screen resolutions -->
		<!--  
		<link rel="stylesheet" type="text/css" href="css/main.css" 
			media="screen and (min-width: 701px)" />
		<link rel="stylesheet" type="text/css" href="css/mobile.css"
			media="screen and (max-width: 700px)" />
		-->
	</head>
	<body>
		
	</body>
</html>