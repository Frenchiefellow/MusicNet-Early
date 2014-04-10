<?php

if ( !isset( $_SESSION ) ) {
	session_start();
}

$connection = @new mysqli( /*removed*/ );
if ( !$connection ) {
	die( "Couldn't connect to mysql server!<br>The error was: " . mysql_error() );
}

$url  = $_SERVER["REQUEST_URI"];
$name = $_GET['id'];

if ( !is_numeric( $name ) ) {
	if ( ( isset( $_SESSION ) ) && ( isset( $_SESSION['username'] ) ) ) {
		header( "Location: profile.php?user=" . $_SESSION['username'] );
		die( );
	} else {
		header( "Location: splash.php?err=3" );
		die( );
	}
} else {
	
	//SONG CHUNK
	if ( strpos( $url, 'song.php' ) ) {
		
		$stmt = $connection->prepare( 'SELECT title FROM Song WHERE songid = ?' );
		$stmt->bind_param( 's', $name );
		
		$stmt->execute();
		
		$stmt->bind_result( $title );
		
		
		
		if ( $stmt->fetch() == true ) {
			
		} else {
			if ( ( isset( $_SESSION ) ) && ( isset( $_SESSION['username'] ) ) ) {
				header( "Location: profile.php?user=" . $_SESSION['username'] );
				die( );
			} else {
				header( "Location: splash.php?err=3" );
				die( );
			}
		}
		$stmt->close();
	}
	
	//ARTIST CHUNK
	if ( strpos( $url, 'artist.php' ) ) {
		
		$stmt = $connection->prepare( 'SELECT artistname FROM Artist WHERE artistid = ?' );
		$stmt->bind_param( 's', $name );
		
		$stmt->execute();
		
		$stmt->bind_result( $title );
		
		
		
		if ( $stmt->fetch() == true ) {
			
		} else {
			if ( ( isset( $_SESSION ) ) && ( isset( $_SESSION['username'] ) ) ) {
				header( "Location: profile.php?user=" . $_SESSION['username'] );
				die( );
			} else {
				header( "Location: splash.php?err=3" );
				die( );
			}
		}
		$stmt->close();
	}
	
	//ALBUM CHUNK
	if ( strpos( $url, 'album.php' ) ) {
		$stmt = $connection->prepare( 'SELECT albumname FROM Album WHERE albumid = ?' );
		$stmt->bind_param( 's', $name );
		
		$stmt->execute();
		
		$stmt->bind_result( $albumname );
		
		
		
		if ( $stmt->fetch() == true ) {
			
		} else {
			if ( ( isset( $_SESSION ) ) && ( isset( $_SESSION['username'] ) ) ) {
				header( "Location: profile.php?user=" . $_SESSION['username'] );
				die( );
			} else {
				header( "Location: splash.php?err=3" );
				die( );
			}
		}
		$stmt->close();
	}
	
	
	
}

?>

