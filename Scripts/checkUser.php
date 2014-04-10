<?php

$connection = @new mysqli( /*removed*/ );

if ( !isset( $_SESSION ) ) {
	session_start();
}
$name = $_GET[ 'user' ];

if ( !$connection ) {
	die( "Couldn't connect to mysql server!<br>The error was: " . mysql_error() );
} else {
	echo "Connection successful!<br>\n";
}
$stmt = $connection->prepare( 'SELECT loginacct FROM User WHERE loginacct = ?' );
$stmt->bind_param( 's', $name );

$stmt->execute();

$stmt->bind_result( $loginacct );



if ( $stmt->fetch() == true ) {
	
}

else {
	if ( ( isset( $_SESSION ) ) && ( isset( $_SESSION[ 'username' ] ) ) ) {
		header( "Location: refer.php?user=" . $_SESSION[ 'username' ] . "&friend=" . $name );
		die();
	} else {
		header( "Location: splash.php?err=2" );
		die();
	}
}

$stmt->close();



?>