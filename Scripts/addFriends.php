<?php
session_start();

if( isset( $_POST[ 'user' ] ) ){
		$you = $_SESSION[ 'username' ];
		$them = $_POST[ 'user' ];

		//DB connection
		$noCheck = mysqli_query( $connection, 'SET FOREIGN_KEY_CHECKS=0');
		$stmt = $connection->prepare( 'INSERT INTO Friends ( loginacct1, loginacct2 ) VALUES ( ?, ? )' );
		$stmt->bind_param( 'ss',  $you, $them );
		$stmt->execute();
		$stmt->store_result();
		
		echo "Friend added!";
		$stmt->close();

		$prevID = 0;
		$results = mysqli_query( $connection, 'SELECT notid FROM Notifications ORDER BY notid DESC' );
		while( $row = $results->fetch_array() ){
		$prevID = $row[0];
		}
		$prevID += 1;

		$message = $you . " is now following you!";
		$stmt = $connection->prepare( 'INSERT INTO Notifications ( notid, content, Recipient ) VALUES ( ?, ?, ? )' );
		$stmt->bind_param( 'sss',  $prevID, $message, $them );
		$stmt->execute();

		$Check = mysqli_query( $connection, 'SET FOREIGN_KEY_CHECKS=1');
		$connection->close();
	

}

?>