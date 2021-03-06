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
	//var wsUri = "ws://localhost:9000/webSockets/server.php";
	//var wsUri = "ws://onkelsmo.no-ip.biz:9000/webSockets/server.php";
	//var wsUri = "ws://home:9000/webSockets/server.php";
	
	var websocket = null;
	
	var colours = ['007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00'];
    var color = colours[Math.floor(Math.random()*colours.length)];
	
	$('#connectBtn').click(function()
	{
		connect();
	});
	
	// send a message by click on send button
	$('#sendBtn').click(function()
	{
		send();
	});

    // send a message by press the enter key	
	$('#message').keypress(function(event)
	{
	    if (event.which == 13)
	    {
	        event.preventDefault();
	        send();
	    };
	});
	
	var connect = function()
	{
		var host = $('#host').val();
				
		if (host != 'Host' && host != '')
		{
			this.websocket = new WebSocket(host);
			
			// connect to a server
			this.websocket.onopen = function(ev)
			{
				$('#messageBox').append('<div class="systemMessage">Connected!</div>');
				console.log("Connected to Server");
			};
			
			// message received
			this.websocket.onmessage = function(ev)
			{
				var msg = JSON.parse(ev.data);
			    var time = msg.time;
				var type = msg.type;
				var umsg = msg.message;
				
				if (umsg.length >= 75)
				{
				    var cut = umsg.substring(0, 75);
				    var rest = umsg.substring(75);
				
				    umsg = cut + "<br />" + rest;    
				}
				
				var uname = msg.name;
				var ucolor = msg.color;
				var clients = msg.clients;
				
				//console.log(clients);
				
				$('#list').empty();
				
			    $.each(clients, function (key, value)
		        { 
		            $('#list').append
		            (
		                '<div>'
		                + key +
		                '</div>'
		            );
			    });
				
				if (type == 'usermsg')
				{
				    $('#messageBox').append
					(	    
		                '<div><a name="'
		                + time + 
		                '"<span class="time">'
		                + time +
		                '</span> <span class="userName" style="color:#'
						+ ucolor +
						';">' 
						+ uname +
						'</span>: <span class="userMessage">' 
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
				
				// scroll #messageBox to bottom
				$('#messageBox').animate(
				{
		            scrollTop: $('#messageBox')[0].scrollHeight
		        }, 2000);
		        
				//console.log("Message " + ev.data);
				$('#message').val('');
			};

			this.websocket.onerror = function(ev)
			{
				//console.log("Error " + ev.data);
				$('#messageBox').append
				(
						"<div class=\"systemError\">Error Occurred - "
						+ ev.data +
						"</div>"
						);
				}; 
			this.websocket.onclose = function(ev)
			{
				console.log("Connection closed");
				$('#message_box').append
				(
					"<div class=\"system_msg\">Connection Closed</div>"
				);
			}; 
		}
		
		
	};
	
	var send = function()
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
            
        var unixTimeStamp = $.now();
        var time = new Date(unixTimeStamp);
        time = time.toLocaleTimeString();
                
        // prepare json data
        var msg = 
        {
            time: time,    
            message: myMessage,
            name: myName,
            color: color
        };
        
        // convert and send data to server
        this.websocket.send(JSON.stringify(msg));
	};
});
