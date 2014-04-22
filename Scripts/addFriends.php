<?php
session_start();

if( isset( $_POST[ 'user' ] ) ){
		$you = $_SESSION[ 'username' ];
		$them = $_POST[ 'user' ];

		$connection = @new mysqli( /*removed*/ );
		$noCheck = mysqli_query( $connection, 'SET FOREIGN_KEY_CHECKS=0');
		$stmt = $connection->prepare( 'INSERT INTO Friends ( loginacct1, loginacct2 ) VALUES ( ?, ? )' );
		$stmt->bind_param( 'ss',  $you, $them );
		$stmt->execute();
		$stmt->store_result();
		
		echo "Friend added!";
		$stmt->close();


		$Check = mysqli_query( $connection, 'SET FOREIGN_KEY_CHECKS=1');
		$connection->close();
	

}

?>