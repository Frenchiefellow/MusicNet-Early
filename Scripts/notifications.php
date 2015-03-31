<?php
session_start();

if( isset( $_POST[ 'name' ] ) ) {

	$name = $_POST[ 'name' ];
	//DB connection

	//Echo the array of notifications
	$stmt = $connection->prepare( 'SELECT content, notid FROM Notifications WHERE Recipient = ?' );
	$stmt->bind_param( 's', $name );
	$stmt->execute();
	$stmt->bind_result( $message, $ID );
	$stmt->store_result();
	$arr = array();
	$notID = array();
	if( $stmt->num_rows > 0 ){
		while( $stmt->fetch() ){
			array_push( $arr, $message );
			array_push( $notID, $ID );
		}
		for($i = 0; $i < count( $arr ); $i++ ){
			if( $i > 0  && ( $i != ( count( $arr ) - 1) ) ) {
				echo $arr[ $i ] . "*|*|*";
			}
			elseif( $i == ( count( $arr ) - 1 ) ){
				echo $arr[ $i ];
			}
			elseif( $i == 0 && ( $i != ( count( $arr ) - 1) ) ) {
				echo $arr[ $i ] . "*|*|*";
			}
		} 
	}
	$stmt->close();

	//Delete Notifications after displayed
	for( $i = 0; $i < count( $notID ); $i++ ){
		$stmt = $connection->prepare( 'DELETE FROM Notifications WHERE notid = ?' );
		$stmt->bind_param( 's', $notID[ $i ] );
		$stmt->execute();
		$stmt->close();
	}

	$connection->close();


}