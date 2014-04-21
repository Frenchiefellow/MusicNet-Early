<?php
session_start();

//Changes the rating of a song for a user; handles if there is no pre-existing rating too
if( isset( $_POST[ 'new' ] ) ){
		$connection = @new mysqli( /*removed*/ );
		$song = $_GET[ 'id' ];

		//Grab User's previous rating
		$prev;
		$stmt = $connection->prepare( 'SELECT rating FROM UserInteraction WHERE loginacct = ? AND songid = ?' );
		$stmt->bind_param( 'ss', $_SESSION[ 'username' ], $_GET[ 'id' ] );
		$stmt->execute();
		$stmt->bind_result( $prevRating );
		$stmt->store_result();
		if( $stmt->num_rows > 0 ){
			while( $stmt->fetch() ){
				$prev = $prevRating;
			}
		}
		//Set previous number of ratings to 0
		else{
			$prev = 0;
		}

		$stmt->close();

		//If there is a pre-existing rating for this User
		if( $prev != 0 ){

			//Set the new rating in the UserInteraction Tuple
			$stmt = $connection->prepare( 'UPDATE UserInteraction SET rating = ? WHERE loginacct = ? AND songid = ?' );
			$stmt->bind_param( 'sss',  $_POST[ 'content' ], $_SESSION[ 'username' ], $_GET[ 'id' ]);
			$stmt->execute();
			$stmt->close();
			echo 'Rating Changed To: ' . $_POST[ 'content' ];

			//Update rating count and total ratings
			$newRate = $_POST[ 'content' ] - $prev;
			$stmt = $connection->prepare( 'UPDATE Song set ratecount = ratecount + ? WHERE songid = ?' );
			$stmt->bind_param( 'ss', $newRate, $_GET[ 'id' ] );
			$stmt->execute();
			$stmt->close();

			//If changes set ratingcount below 0, set ratingcount to 0
			$ratingcount;
			$stmt = $connection->prepare( 'SELECT ratecount FROM Song WHERE songid = ?' );
			$stmt->bind_param( 's', $_GET[ 'id' ] );
			$stmt->execute();
			$stmt->bind_result( $count );
			while( $stmt->fetch() ){
				$ratingcount = $count;
			}
			$stmt->close();
			if( $ratingcount < 0 ){
				$stmt = $connection->prepare( 'UPDATE Song set ratecount = 0 WHERE songid = ?' );
				$stmt->bind_param( 'ss', $newRate, $_GET[ 'id' ] );
				$stmt->execute();
				$stmt->close();
			}
		}

		elseif( $prev == 0 ){

			//Insert a new tuple for this rating
			$stmt = $connection->prepare( 'INSERT INTO UserInteraction ( loginacct, songid, rating, plays ) VALUES ( ?, ?, ?, 0 )' );
			$stmt->bind_param( 'sss', $_SESSION[ 'username' ], $_GET[ 'id' ], $_POST[ 'content' ] );
			$stmt->execute();
			echo 'Rating Set To: ' . $_POST[ 'content' ];

			//Update rating count and total ratings
			$stmt = $connection->prepare( 'UPDATE Song set ratecount = ratecount + ?, totalRatings = totalRatings + 1 WHERE songid = ?' );
			$stmt->bind_param( 'ss', $_POST[ 'content' ], $_GET[ 'id' ] );
			$stmt->execute();
			$stmt->close();

			//Update Average Rating
			$stmt = $connection->prepare( 'UPDATE Song set rating = ratecount / totalRatings WHERE songid = ?' );
			$stmt->bind_param( 's', $_GET[ 'id' ] );
			$stmt->execute();
			$stmt->close();
		}

		//Update Average Rating
		$stmt = $connection->prepare( 'UPDATE Song set rating = ratecount / totalRatings WHERE songid = ?' );
		$stmt->bind_param( 's', $_GET[ 'id' ] );
		$stmt->execute();
		$stmt->close();
		$connection->close();

}


//Checks to see if user has existing playlist
elseif( isset( $_POST[ 'songid' ] ) ){
	
	$connection = @new mysqli( /*removed*/ );
	$song = $_POST[ 'songid' ];
	$stmt = $connection->prepare( 'SELECT P.playlistname from Playlist P, Created C WHERE C.loginacct = ? AND P.playlistid = C.playlistid' );
	$stmt->bind_param( 's', $_SESSION[ 'username' ] );
	$stmt->execute();
	$stmt->bind_result( $pname );
	$stmt->store_result();
	$arr = array();
	if( $stmt->num_rows > 0 ){
		while( $stmt->fetch() ){
			array_push( $arr, $pname );
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
		//Grab playlists, let the user choose one and add the song to said playlist
	}
	else{
		echo "No Playlists Created";
		
	}
	$connection->close();
}

//Block of code to handle if no playlist exist and user creates a new one. 
elseif( isset( $_POST[ 'pname' ] ) ){

	$playlist = $_POST[ 'pname' ];
	$connection = @new mysqli( /*removed*/ );
	$song = $_POST[ 'sid' ];
	$prevID;
	//Get the value of the largest playlistID
	$results = mysqli_query( $connection, 'SELECT playlistid from Created ORDER BY playlistid DESC LIMIT 1' );
	while( $row = $results->fetch_array() ){
		$prevID = $row[0];
	}
	$prevID += 1;
	//Turn off foreign key checks to add tuple
	$noCheck = mysqli_query( $connection, 'SET FOREIGN_KEY_CHECKS=0');
	//Add a new tuple representing this playlist to Created
	$stmt = $connection->prepare( 'INSERT INTO Created ( loginacct, playlistid ) VALUES ( ?, ? )' );
	$stmt->bind_param( 'ss', $_SESSION[ 'username' ], $prevID );
	$stmt->execute();
	$stmt->store_result();

	//Grab the song name for later
	$title;
	$query = "SELECT title FROM Song WHERE songid = '$song'";
	$res = mysqli_query( $connection, $query );
	$row = mysqli_fetch_array( $res );
	$title = $row[ 0 ];
	$stmt->close();

	//Add a new tuple representing this playlist to Playlist
	$stmt = $connection->prepare( 'INSERT INTO Playlist ( playlistid, playlistname, trackno ) VALUES ( ?, ?, 1 )' );
	$stmt->bind_param( 'ss', $prevID, $playlist );
	$stmt->execute();
	$stmt->close();

	//Add a new tuple representing this playlist to Contains
	$stmt = $connection->prepare( 'INSERT INTO Contains ( playlistid, songid ) VALUES ( ?, ? )' );
	$stmt->bind_param( 'ss', $prevID, $song );
	$stmt->execute();
	$stmt->close();

	//Print that the song has been added to the playlist
	echo $title . " added to Playlist: " . $playlist; 
	
	//Re-enable Foreign Key Checks
	$check = mysqli_query( $connection, 'SET FOREIGN_KEY_CHECKS=1');
	$connection->close();
	
}

//Block of code to add a song to pre-existing playlist
elseif( isset( $_POST[ 'playlist' ] ) ){

	$play = $_POST[ 'playlist' ];
	$title = $_POST[ 's' ];
	$connection = @new mysqli( /*removed*/ );
	//Turn off foreign key checks to add tuple
	$noCheck = mysqli_query( $connection, 'SET FOREIGN_KEY_CHECKS=0');
	//Grab the id of the playlist in question
	$stmt = $connection->prepare( 'SELECT playlistid, trackno FROM Playlist WHERE playlistname = ?' );
	$stmt->bind_param( 's', $play );
	$stmt->execute();
	$stmt->bind_result( $ID, $tracks );
	$pID;
	$track;
	while( $stmt->fetch() ){
		$pID = $ID;
		$track = $tracks;
	}


	//Add a new tuple representing the playlist to Contains
	$stmt = $connection->prepare( 'INSERT INTO Contains ( playlistid, songid ) VALUES ( ?, ? )' );
	$stmt->bind_param( 'ss', $pID, $title );
	$stmt->execute();
	$stmt->close();

	//Update trackno in playlists
	$stmt = $connection->prepare( 'UPDATE Playlist set trackno = trackno + 1 where playlistid = ?' );
	$stmt->bind_param( 's', $pID );
	$stmt->execute();
	$stmt->close();

	//Print that the song has been added to the playlist
	echo $title . " added to Playlist: " . $play; 

	//Re-enable foreign key checks
	$check = mysqli_query( $connection, 'SET FOREIGN_KEY_CHECKS=1');
	$connection->close();
}

//Block of code to update total plays of song in the database
elseif( isset( $_POST[ 'songI' ] ) ){

	$ID = $_POST[ 'songI' ];
	$plays = $_POST[ 'totplays' ];
	$connection = @new mysqli( /*removed*/ );

	//Update the playcount from song page
	$stmt = $connection->prepare( 'UPDATE Song set playcount = ? where songid = ?' );
	$stmt->bind_param( 'ss', $plays, $ID);
	$stmt->execute();
	$stmt->close();

	//Grab the playcount for updating the song page
	$stmt = $connection->prepare( 'SELECT playcount FROM Song WHERE songid = ?' );
	$stmt->bind_param( 's', $ID );
	$stmt->execute();
	$stmt->bind_result( $pl );
	while( $stmt->fetch() ){
		echo $pl;
	}
	$stmt->close();

	$connection->close();
}

//Block of code to update Average Rating of Song
elseif( isset( $_POST[ 'update' ] ) ){

	$sname = $_GET[ 'id' ];
	$connection = @new mysqli( /*removed*/ );

	//Update Average Rating
	$stmt = $connection->prepare( 'UPDATE Song set rating = ratecount / totalRatings WHERE songid = ?' );
	$stmt->bind_param( 's', $_GET[ 'id' ] );
	$stmt->execute();
	$stmt->close();

	//Grab the average rating for the song and format to one decimal place for use on song page
	$stmt = $connection->prepare( 'SELECT rating FROM Song WHERE songid = ?' );
	$stmt->bind_param( 's', $sname );
	$stmt->execute();
	$stmt->bind_result( $songRating );
	while( $stmt->fetch() ){
		echo number_format( $songRating, 1 );
	}
	$stmt->close();

	$connection->close();
}


		?>