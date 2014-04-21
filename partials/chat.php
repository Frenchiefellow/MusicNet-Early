
<?php 
if( isset( $_SESSION[ 'username' ] ) ){
echo '<div class="chat_wrapper" style="position: relative; border: 1px solid #eee; border-radius: 10px; width: 60%; margin: auto; background-color: #eee; background-color: rgba(128, 128, 128, .7)">
    <p style="text-align: center; font-weight: bold;">Song-Chat!</p>
	<div class="message_box" id="mess_box" style="border: 1px solid; border-radius: 10px; width: 90%; margin: auto; height: 150px; overflow: auto; background-color: white; opacity: .7">
    <span style="margin-left: 1%"><strong>Username: </strong> PLACE HOLDER FOR NOW I GUESS</span>
    </div>
    <br>
	<div class="hold" style="margin: auto; height: 15%;">
	<form name="message_box" style="margin-left: 5%">
		<input type="text" name="message" id="message" placeHolder="Type Message Here" style="width: 30%; "/>
		<input id="sendbtn" name="send-btn" type="submit" value="Enter"/>
	</form>
    <br>
	</div>

</div>';
}
else{
echo '<div class="chat_wrapper" style="position: relative; width: 8.1%; margin: auto;">
	<a href="http://cs445.cs.umass.edu/php-wrapper/clp/splash.php" class="btn btn-warning" style="border: 1px solid #eee; border-radius: 5px;">Log In To View Chat</a>
	</div>';
}
?>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">



</script>
