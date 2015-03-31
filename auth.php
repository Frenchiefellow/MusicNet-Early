<?php
//DB CONNECTION


if( !isset( $_POST[ 'fb' ]  ) ){
$user = $_POST[ 'username' ];
$pass = $_POST[ 'pass' ];
$stmt = $connection->prepare( 'SELECT loginacct FROM User WHERE loginacct = ? AND password = ?' );
$stmt->bind_param( 'ss', $user, $pass );

$stmt->execute();

$stmt->bind_result( $loginacct );


if ( $stmt->fetch() == true ) {
	session_start();
	$_SESSION[ 'username' ] = $user;
	ob_start();
	$url = "profile.php?user=" . $_SESSION[ 'username' ];
	while ( ob_get_status() ) {
		ob_end_clean();
	}
	header( "Location: $url" );
	die();
}

else {
	header( "Location: splash.php?err=1" );
	die( "Incorrect Info!" );
}
$stmt->close();
$mysqli->close();
}


else{

	$username = $_POST[ 'name' ];
	$FID = $_POST[ 'fid' ];

	$gender;
	$location;



	if( isset( $_POST[ 'gender']) ){
		if( strtolower( $_POST[ 'gender' ] ) == 'male' ){
			$gender = 1;
		}
		elseif( strtolower( $_POST[ 'gender' ] ) == 'female' ){
			$gender = 0;
		}
	}
	else{
		$gender = NULL;
	}

	if( isset( $_POST[ 'location']) ){
		if( $_POST[ 'location' ] == 'undefined') {
			$location = NULL;
		}
		else{
			$location = $_POST[ 'location' ];
		}
	}
	else{
		$location = NULL;
	}

	$usern = $username . "_FB";
	$stmt = $connection->prepare( 'SELECT loginacct FROM User WHERE loginacct = ?' );
	$stmt->bind_param( 's', $usern );
	$stmt->execute();
	$stmt->store_result();
	$check = false;
	if( $stmt->num_rows > 0 ){
		$check = true;
	}
	$array = array();
	if( $check == true ){
		$array[ 0 ] = 'returning';
		$array[ 1 ] = $username;
		session_start();
		$_SESSION[ 'username' ] = $username . "_FB";
		for($i = 0; $i < count( $array ); $i++ ){
			if( $i > 0  && ( $i != ( count( $array ) - 1) ) ) {
				echo $array[ $i ] . "*|*|*";
			}
			elseif( $i == ( count( $array ) - 1 ) ){
				echo $array[ $i ];
			}
			elseif( $i == 0 && ( $i != ( count( $array ) - 1) ) ) {
				echo $array[ $i ] . "*|*|*";
			}
		} 
	}

	else{
		$login = $username . "_FB";
		$stmt = $connection->prepare( 'INSERT INTO User (loginacct, username, password, age, ismale, issuper, userloc, FBid) VALUES ( ? , ?, "xx9532", NULL, ? , 0, ?, ?)');
		$stmt->bind_param( 'sssss', $login, $username, $gender, $location, $FID );
		$stmt->execute();
		//start a new session, store username inside for varius purposes, and redirect to newuser.php
		session_start();
		$_SESSION[ 'username' ] = $username . "_FB";
		$array[ 0 ] = 'new';
		$array[ 1 ] = $username;
		for($i = 0; $i < count( $array ); $i++ ){
			if( $i > 0  && ( $i != ( count( $array ) - 1) ) ) {
				echo $array[ $i ] . "*|*|*";
			}
			elseif( $i == ( count( $array ) - 1 ) ){
				echo $array[ $i ];
			}
			elseif( $i == 0 && ( $i != ( count( $array ) - 1) ) ) {
				echo $array[ $i ] . "*|*|*";
			}
		}

	}


}

?>