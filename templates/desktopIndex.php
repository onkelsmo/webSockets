<?php
/**
 * desktopIndex.php - the template for desktop screen sizes
 * 
 * @author: jsmolka
 * @since: 15.01.2014
 */
?>
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
