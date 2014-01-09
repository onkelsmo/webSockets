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
		$('#messageBox').append('<div class="systemMessage">Connected!</div>');
		console.log("Connected to Server");
	};
	
	// send a message
	$('#sendBtn').click(function()
	{
		var myMessage = $('#message').val();
		var myName = $('#name').val();
		
		if (myName == "")
		{
			alert("Enter your Name first");
			return;
		}
		if (myMessage == "")
		{
			alert("Enter some message to chat");
			return;
		}
		
		// prepare json data
		var msg = 
		{
				message: myMessage,
				name: myName,
				color: '<?php echo $colours[$user_colour]; ?>'
		};
		
		// convert and send data to server
		websocket.send(JSON.stringify(msg));
	});
	
	// message received
	websocket.onmessage = function(ev)
	{
		var msg = JSON.parse(ev.data);
		var type = msg.type;
		var umsg = msg.message;
		var uname = msg.name;
		var ucolor = msg.color;
		
		if (type == 'usermsg')
		{
			$('#messageBox').append
			(
				'<div><span class="userName" style="color:#' 
				+ ucolor +
				'>' 
				+ uname +
				'</span>:<span class="userMessage">' 
				+ umsg + 
				'</span></div>'
			);
		}
		if(type == 'system')
		{
			$('#messageBox').append
			(
				'<div class="systemMsg">'
				+ umsg +
				'</div>'
			);
		}
		
		//console.log("Message " + ev.data);
		$('#message')val('');
	};

	websocket.onerror = function(ev)
	{
		//console.log("Error " + ev.data);
		$('#messageBox').append
		(
				"<div class=\"systemError\">Error Occurred - "
				+ ev.data +
				"</div>"
				);
		}; 
	websocket.onclose = function(ev)
	{
		console.log("Connection closed");
		$('#message_box').append
		(
			"<div class=\"system_msg\">Connection Closed</div>"
		);
	}; 
	
});
