/*
 * websocket.js
 * 
 * handler for websocket methods
 * 
 * @author jsmolka
 * @since 08.01.2014 
 * 
 */
$(document).ready(function()
{
	// open a connection
	var wsUri = "ws://localhost:9000/websocket/server.php";
	websocket = new WebSocket(wsUri);
	
	// connect to a server
	websocket.onopen = function(ev)
	{
		console.log("Connected to Server");
	};
	
	// close the connection
	websocket.onclose = function(ev)
	{
		console.log("Connection closed");
	};
	
	// message received
	websocket.onmessage = function(ev)
	{
		console.log("Message " + ev.data);
	};
	
	// error
	websocket.onerror = function(ev)
	{
		console.log("Error " + ev.data);
	};
	
	// send a message
	$('#send').click(function()
	{
		var myMessage = 'This is a test message';
		websocket.send(myMessage);
	});
	
});
