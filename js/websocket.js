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
	var wsUri = "ws://localhost:9000/daemon.php";
	websocket = new WebSocket(wsUri);
	
	// connect to a server
	websocket.onopen = function(ev)
	{
		alert("Connected to Server");
	};
	
	// close the connection
	websocket.onclose = function(ev)
	{
		alert("Connection closed");
	};
	
	// message received
	websocket.onmessage = function(ev)
	{
		alert("Message " + ev.data);
	};
	
	// error
	websocket.onerror = function(ev)
	{
		alert("Error " + ev.data);
	};
	
});
