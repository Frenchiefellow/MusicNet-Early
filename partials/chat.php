
<?php 
if( isset( $_SESSION[ 'username' ] ) ){
echo '<div class="chat_wrapper" style="position: relative; border: 1px solid #eee; border-radius: 10px; width: 60%; margin: auto; background-color: #eee; background-color: rgba(128, 128, 128, .7)">
    <p style="text-align: center; font-weight: bold; color: white;">Song-Chat!</p>
	<div class="message_box" id="mess_box" style="border: 1px solid; border-radius: 10px; width: 90%; margin: auto; height: 150px; overflow: auto; background-color: white; opacity: .7">';
    if(file_exists("Scripts/log.html") && filesize("Scripts/log.html") > 0){
    $handle = fopen("Scripts/log.html", "r");
    $contents = fread($handle, filesize("Scripts/log.html"));
    fclose($handle);
     
    echo $contents;
}
    echo '</div>
    <br>
	<div class="hold" style="margin: auto; height: 15%;">
	<form name="message_box" method="post" style="margin-left: 5%">
		<input type="text" name="message" id="message" placeHolder="Type Message Here" style="width: 30%; "/>
		<input id="sbutton" type="button" value="Send">
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

<script language="javascript" type="text/javascript">  
$(document).ready(function(){
	setInterval(loadLog, 100);
$( '#sbutton' ).click( function(){ 
 	var msg = $( '#message' ).val();
    var id = window.location.search.substring( 4 );

 	 $.ajax({
        type: 'POST',
        url: 'Scripts/chatHandler.php',
        data: { text: msg, songID: id }, 
        cache: false,
        error: function( e ){
        alert( e );
        },
        success: function( response4 ){
      	$( '#message' ).attr("value", "");
        }
    }); 
});
 	 function loadLog(){     
    
    $.ajax({
    	type: 'GET',
        url: "http://cs445.cs.umass.edu/groups/clp/www/Scripts/log.html",
        datatype: 'jsonp',
        success: function(html){ 
 
            $("#mess_box").html(html);  
            }               
       
    });
}

});




</script>
