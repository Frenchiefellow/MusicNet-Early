<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h1 class='page-header'>Refer A Friend!</h1>

<?php
if( isset( $_GET[ 'friend' ] )  && !isset( $_POST[ "submit"] ) ){
echo '<p>We see you tried to look for <strong>' . $_GET[ 'friend' ] .  "</strong>'s profile, but it appears they aren't a member of MusicNet!</p>";
echo '<p>Do you know <strong>' . $_GET[ 'friend' ] . "</strong>? If so, you should invite them to become a part of the greatest community of music enthusiasts the world has to offer! Hell, you're part of the community, why isn't  " .  "<strong>" . $_GET[ 'friend' ] .  '</strong>?';
}
else{
echo "<p >Got a friend that you think would love all that MusicNet has to offer? If so, you should invite them to become a part of the greatest community of music enthusiasts the world has to offer! Hell, you're part of the community, why aren't they?</p>";
}
if ( !isset( $_POST[ "submit"] ) ){
echo '<div class = "jumbotron">';
echo '<form id="refer" method="post" action="' . $_SERVER['REQUEST_URI'] . '">' .
"Friend's Email: <input type='email' name='address' placeholder='friend@mail.com' required><br><br>" .
"E-Mail Subject: <input type='text' name='subject' value='Invite to MusicNet!' required> <br><br>" .
'Send A Message with the Invite!<br>' .
'<textarea type="text" name="message" cols="200" rows="12">';

$set;
if( isset( $_GET[ 'friend' ] ) ){ $set = $_GET[ 'friend' ];}  

echo 'Hello ' . $set . ',

' . "You've been requested ";

$set2;
if( isset( $_SESSION[ 'username' ] ) ){ $set2 = "by " . $_SESSION[ 'username' ];} 

echo $set2 . ' to become part of something bigger than yourself; become part of the greatest community of mussic enthusiasts the world has to offer! ' .
'Join MusicNet today to access the hottest new music, artists, and albums, as well as making lifelong friends along the way that share your musical interests!
'.
"
Copy and paste this link into your internet browser and see all that you can become: 
http://www.cs445.cs.umass.edu/php-wrapper/clp/splash.php


Join the MusicNet Community and you'll never look back! Hope to see you on the web!

-The MusicNet Team
</textarea><br>".
'<input type="submit" name="submit">' .
'</form>';
}

else{
  if (isset($_POST[ "address" ])) {
    $to = $_POST[ "address" ]; 
    $from = $_SESSION[ "username" ];
    $subject = $_POST[ "subject" ];
    $message = $_POST[ "message" ];
    $message = wordwrap($message, 70);
    mail($to,$subject,$message,"From: $from\n");
    ob_start();
    $url = "refer.php?user=" . $_SESSION[ 'username' ];
    while ( ob_get_status() ) {
		ob_end_clean();
	}
?>
   <script type="text/javascript">
	location.reload();
	alert("Invite Sent!");
   </script>
<?php  
    }
  }
?>


</div>
