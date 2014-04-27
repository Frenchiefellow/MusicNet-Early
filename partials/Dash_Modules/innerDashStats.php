<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header"><?php if(isset($_GET['user'])){echo $_GET['user'];} else{ echo "undefined";}; ?>: Stats</h1>

    <style>
    .stat{
    	font-size: 150%;
    	margin-bottom: 3%;
    	padding: 5px;
    	border: 1px solid #A9A9A9;
    	background-color: #f5f5f5;
    }
    </style>
  
    <?php
    $connection = @new mysqli( "cs445sql", "crpeters", "EL159crp", "clp" );

    $stmt = $connection->prepare( 'SELECT count( plays ) FROM UserInteraction  WHERE loginacct = ? AND plays > 0' );
	$stmt->bind_param( 's',  $_GET['user']);
	$stmt->execute();
	$stmt->bind_result( $plays );
	while ($stmt->fetch()){
			if( $plays != 0 )
				echo '<div class="stat" style="margin-top: 8.7%"> Songs Played: <strong> ' . $plays . '</strong></div>' ;
			else{
				echo '<div class="stat" style="margin-top: 8.7%">Songs Played: <strong> ' .  0 . '</strong></div>' ;
			}
			
	}
	$stmt->close();

	$stmt = $connection->prepare( 'SELECT sum(plays) FROM UserInteraction WHERE loginacct = ? AND plays > 0' );
	$stmt->bind_param( 's',  $_GET['user']);
	$stmt->execute();
	$stmt->bind_result( $plays );
	while ($stmt->fetch()){
			if( $plays != 0 )
				echo '<div class="stat">Total Plays: <strong> ' . $plays . '</strong></div>' ;
			else{
				echo '<div class="stat">Total Plays: <strong> ' .  0 . '</strong></div>' ;
			}
			
	}
	$stmt->close();

	$stmt = $connection->prepare( 'SELECT count(rating) FROM UserInteraction WHERE loginacct = ? AND rating > 0' );
	$stmt->bind_param( 's',  $_GET['user']);
	$stmt->execute();
	$stmt->bind_result( $rates );
	while ($stmt->fetch()){
		if( $rates != 0 ){
			echo '<div class="stat"> Songs Rated: <strong> ' . $rates . '</strong></div>' ;
		}
		else{
			echo '<div class="stat"> Songs Rated: <strong> ' . 0 . '</strong></div>' ;
		}
	}
	$stmt->close();
    $user = $_GET[ 'user' ];
    $stmt = $connection ->prepare (  'select UI.plays, S.duration
									 from UserInteraction UI, Song S
									 where UI.loginacct = ? and UI.songid = S.songid  
									 order by plays desc' );
	$stmt->bind_param( "s", $user );
    $stmt->execute();
    $stmt->bind_result( $plays, $duration );
	$time = array();
	while( $stmt-> fetch()){
		array_push($time, $plays * $duration );
	}
	$stmt->close();

	$sumtime = 0;
	for($i = 0; $i < count($time); $i++){
		$sumtime += $time[$i];
	}
	$hours = floor($sumtime/3600);
	$minutes = floor(($sumtime - ($hours*3600)) / 60);
	$seconds = floor($sumtime % 60);
	echo "<div class='stat'> Total time spent listening: <strong>" . $hours . ":" . $minutes . ":" . $seconds . "</strong></div>";
	
	$stmt = $connection -> prepare ( 'select T.tagname
									from TaggedBy_Tags T, UserInteraction UI
									where UI.loginacct = ? and ( UI.rating > 2 or UI.plays > 0 ) and UI.songid = T.songid and T.tagname is not NULL
									order by count(T.tagname) desc
									limit 1'
									);
	$stmt -> bind_param( "s", $user );
	$stmt -> execute();
	$stmt -> bind_result( $tagname );
	while( $stmt-> fetch()){
		if( $tagname != ''){
		echo "<div class='stat'> Your most popular genre of music is <strong>" . $tagname . ". </strong></div>";
		}
		else{
			echo "<div class='stat'> You Haven't Listened or Rating enough Songs to have a most popular Genre!</div>";
		}
	}
	$stmt->close();
	
	$stmt = $connection -> prepare ( '	select A.artistname, A.artistid from Artist A, UserInteraction UI, Linked_To L where UI.loginacct = ? and UI.songid = L.songid and L.artistid = A.artistid order by count(A.artistid) limit 1 ');
	$stmt -> bind_param( "s", $user );
	$stmt -> execute();
	$stmt -> bind_result( $topartist, $artID );
	while( $stmt-> fetch()){
		echo "<div class='stat'> Your most popular artist is <strong><a href='http://cs445.cs.umass.edu/php-wrapper/clp/artist.php?id=" . $artID . "'>" . $topartist . "</a></strong>. </div>"; 
	}
	$stmt->close();




?>

</div>