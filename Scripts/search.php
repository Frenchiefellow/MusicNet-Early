<?php

if ( !isset( $_SESSION ) ) {
	session_start();
}

echo '<style>html, body{height: 100%;}</style>';

if ( isset( $_GET[ 'query' ] ) ) {
	
	$query1     = strtolower("% " .$_GET[ 'query' ] . "%" );
	$query3     = strtolower("% " .$_GET[ 'query' ] . " %" );
	$query2 	= strtolower( $_GET[ 'query' ] . "%" );
	$query      = strtolower( $_GET[ 'query' ] );
	//DB connection
	if ( !$connection ) {
		die( "Couldn't connect to mysql server!<br>The error was: " . mysql_error() );
	}
	
	//STRING INPUT
	if ( !is_numeric( $query ) ) {
		
		//USER CHUNK	
		echo '<h4 class="page-header">Users by Login Account</h4>';
		echo '<form id="myform" style="margin-top: -1%" method="post" action="search.php?query=' . $_GET[ 'query' ] . '"><label for="order">Order By: </label>' . '<select name="order" onChange="submit()">' . '<option value="alpha" ';
		
		if ( isset( $_POST[ 'order' ] ) && $_POST[ 'order' ] == "rele" ) {
			$sel = "selected";
		} else {
			$sel = "";
		}
		
		if ( isset( $_POST[ 'order' ] ) && $_POST[ 'order' ] == "alpha" ) {
			$sel2 = "selected";
		} else {
			$sel2 = "";
			
		}
		echo $sel2 . '>Alphabetically</option>' . '<option value="rele"' . $sel . '>Revelence</option>' . '</select></form>';
		
		//SQL INJECTION PREVENTION START
		$stmt = $connection->prepare( 'SELECT U.loginacct, U.username FROM User U WHERE U.loginacct like ? or U.username like ?' );
		if ( !$stmt ) {
			echo $connection->error;
		}
		$stmt->bind_param( 'ss', $query2, $query2 );
		
		$stmt->execute();
		$stmt->bind_result( $log, $username );
		
		
		if ( !isset( $_POST[ 'order' ] ) || $_POST[ 'order' ] == 'alpha' ) {
			echo '<div style="position: relative; height:13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			while ( $row = $stmt->fetch() ) {
				$url  = "http://avid.cs.umass.edu/projects/course-project/Musicnet/profile.php?user=" . $log;
				$html = '<a href="' . $url . '">';
				printf( $html . '%s</a></br>', $log );
			}

			echo '</div>';
		} else {
			$arr     = array();
			$results = array();
			$name    = array();
			$l       = 0;
			$u       = 0;
			$sorter;
			
			while ( $row = $stmt->fetch() ) {
				array_push( $arr, $log );
				array_push( $name, $username );
			}
			foreach ( $arr as $s ) {
				$l = $l + ( ( levenshtein( $s, $query ) / max( strlen( $s ), strlen( $query ) ) ) );
			}
			foreach ( $name as $s ) {
				$u = $u + ( ( levenshtein( $s, $query ) / max( strlen( $s ), strlen( $query ) ) ) );
			}
			
			$maxp = min( ( $l / count( $arr ) ), ( $u / count( $name ) ) );
			
			if ( $maxp == ( $l / count( $arr ) ) ) {
				$prob   = probAverage( $query, $arr );
				//echo 'login';
				$sorter = 'Login Account';
			} elseif ( $maxp == ( $u / count( $name ) ) ) {
				$prob   = probAverage( $query, $name );
				//echo 'username';
				$sorter = 'Name';
				
			}
			
			
			
			for ( $i = 0; $i < count( $arr ); $i++ ) {
				array_push( $results, array(
					$arr[ $i ],
					$prob[ $i ],
					$name[ $i ],
				) );
			}
			array_multisort( $prob, SORT_DESC, $results );
			echo '<div style="font-weight: bold;">Sorting By: ' . $sorter . '</div>';
			echo '<div style="position: relative; height: 13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			for ( $i = 0; $i < count( $results ); $i++ ) {
				$url  = "http://avid.cs.umass.edu/projects/course-project/Musicnet/profile.php?user=" . $results[ $i ][ 0 ];
				$html = '<a href="' . $url . '">';
				echo $html . $results[ $i ][ 0 ] . "</a> <div style='float: right;'>Probability: " . ( number_format( ( $results[ $i ][ 1 ] * 100 ), 0 ) ) . "%</div><br>";
				
				
				
			}
			echo '</div>';
			
		}
		
		
		
		
		//SONG CHUNK
		echo '<h4 class="page-header" style="margin-top: 1%">Songs</h4>';
		echo '<form id="myform1" style="margin-top: -1%" method="post" action="search.php?query=' . $_GET[ 'query' ] . '"><label for="order1">Order By: </label>' . '<select name="order1" onChange="submit()">' . '<option value="alpha" ';
		
		if ( isset( $_POST[ 'order1' ] ) && $_POST[ 'order1' ] == "rele" ) {
			$sel = "selected";
		} else {
			$sel = "";
		}
		
		if ( isset( $_POST[ 'order1' ] ) && $_POST[ 'order1' ] == "alpha" ) {
			$sel2 = "selected";
		} else {
			$sel2 = "";
			
		}
		echo $sel2 . '>Alphabetically</option>' . '<option value="rele"' . $sel . '>Revelence</option>' . '</select></form>';
		
		//SQL INJECTION PREVENTION START
		$stmt = $connection->prepare( 'SELECT S.title, S.songid FROM Song S WHERE S.title like ? OR S.title like ? OR  S.title like ?' );
		$stmt->bind_param( 'sss', $query1, $query2, $query3 );
		$stmt->execute();
		$stmt->bind_result( $title, $sID );
		$ss = array();
		$ht = array();
		if ( !isset( $_POST[ 'order1' ] ) || $_POST[ 'order1' ] == 'alpha' ) {
			echo '<div style="position: relative; height: 13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			while ( $row = $stmt->fetch() ) {
				array_push( $ss, $sID );
				$url  = "http://avid.cs.umass.edu/projects/course-project/Musicnet/song.php?id=" . $sID;
				$html = '<a href="' . $url . '">' . $title;
				array_push( $ht, $html );

			}

			$aa = array();
			for ( $i = 0; $i < count( $ss ); $i++ ) {
			$stmt = $connection->prepare( 'SELECT A.artistname FROM Artist A, Linked_To L WHERE L.songid = ? AND A.artistid = L.artistid' );
			$stmt->bind_param("s", $ss[ $i ] );
			$stmt->execute();
			$stmt->bind_result( $idd );
			while( $stmt->fetch() ){
				array_push( $aa, $idd );
				
			}
			$stmt->close();

			echo $ht[ $i ] . '</a><span> by: ' . $aa[ $i ] . '</span><br>';
			}

			echo '</div>';
		} else {
			$arr     = array();
			$results = array();
			$name    = array();
			$ids     = array();
			
			
			while ( $row = $stmt->fetch() ) {
				array_push( $arr, $title );
				array_push( $ids, $sID );
			}
			
			$prob = probAverage( $query, $arr );
			
			
			for ( $i = 0; $i < count( $arr ); $i++ ) {
				array_push( $results, array(
					 $arr[ $i ],
					$prob[ $i ],
					$ids[ $i ] 
				) );
			}
			array_multisort( $prob, SORT_DESC, $results );

			$artd = array();
			for ( $i = 0; $i < count( $results ); $i++ ) {
			$stmt = $connection->prepare( 'SELECT A.artistname FROM Artist A, Linked_To L WHERE L.songid = ? AND A.artistid = L.artistid' );
			$stmt->bind_param("s", $results[ $i ][ 2 ] );
			$stmt->execute();
			$stmt->bind_result( $idd );
			while( $stmt->fetch() ){
				array_push( $artd, $idd );
			}
			$stmt->close();
		}



			echo '<div style="position: relative; height: 13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			for ( $i = 0; $i < count( $results ); $i++ ) {
				$url  = "http://avid.cs.umass.edu/projects/course-project/Musicnet/song.php?id=" . $results[ $i ][ 2 ];
				$html = '<a style="float: left; margin-right: 5px;" href="' . $url . '">';
				echo $html . $results[ $i ][ 0 ] . " </a><span>by: " . $artd[ $i ] . "</span><div style='float: right;'>Probability: " . ( ( ($results[ $i ][ 1 ] * 100 ) % 100 ) )  . "%</div><br>";
			
				
				
			}
			echo '</div>';
			
		}
		
		
		//ARTIST CHUNK
		echo '<h4 class="page-header" style="margin-top: 1%">Artists</h4>';
		echo '<form id="myform2" style="margin-top: -1%" method="post" action="search.php?query=' . $_GET[ 'query' ] . '"><label for="order2">Order By: </label>' . '<select name="order2" onChange="submit()">' . '<option value="alpha" ';
		
		if ( isset( $_POST[ 'order2' ] ) && $_POST[ 'order2' ] == "rele" ) {
			$sel = "selected";
		} else {
			$sel = "";
		}
		
		if ( isset( $_POST[ 'order2' ] ) && $_POST[ 'order2' ] == "alpha" ) {
			$sel2 = "selected";
		} else {
			$sel2 = "";
			
		}
		echo $sel2 . '>Alphabetically</option>' . '<option value="rele"' . $sel . '>Revelence</option>' . '</select></form>';
		
		//SQL INJECTION PREVENTION START
		$stmt = $connection->prepare( 'SELECT A.artistname, A.artistid FROM Artist A WHERE A.artistname like ? OR A.artistname like ? OR  A.artistname like ?' );
		if ( !$stmt ) {
			echo $connection->error;
		}
		$stmt->bind_param( 'sss', $query1, $query2, $query3 );
		
		$stmt->execute();
		$stmt->bind_result( $name, $aID );
		
		
		if ( !isset( $_POST[ 'order2' ] ) || $_POST[ 'order2' ] == 'alpha' ) {
			echo '<div style="position: relative; height: 13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			while ( $row = $stmt->fetch() ) {
				$url  = "http://avid.cs.umass.edu/projects/course-project/Musicnet/artist.php?id=" . $aID;
				$html = '<a href="' . $url . '">';
				printf( $html . '%s</a></br>', $name );
			}
			echo '</div>';
		} else {
			$arr     = array();
			$results = array();
			$name    = array();
			$ids     = array();
			
			
			while ( $row = $stmt->fetch() ) {
				array_push( $arr, $name );
				array_push( $ids, $aID );
			}
			
			$prob = probAverage( $query, $arr );
			
			
			for ( $i = 0; $i < count( $arr ); $i++ ) {
				array_push( $results, array(
					 $arr[ $i ],
					$prob[ $i ],
					$ids[ $i ] 
				) );
			}
			array_multisort( $prob, SORT_DESC, $results );
			echo '<div style="position: relative; height: 13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			for ( $i = 0; $i < count( $results ); $i++ ) {
				$url  = "http://avid.cs.umass.edu/projects/course-project/Musicnet/artist.php?id=" . $results[ $i ][ 2 ];
				$html = '<a href="' . $url . '">';
				echo $html . $results[ $i ][ 0 ] . "</a> <div style='float: right;'>Probability: " . ( ( ($results[ $i ][ 1 ] * 100 ) % 100 ) ) . "%</div><br>";
				
				
				
			}
			echo '</div>';
			
		}
		
		
		//ALBUM CHUNK
		echo '<h4 class="page-header" style="margin-top: 1%">Albums</h4>';
		echo '<form id="myform3" style="margin-top: -1%" method="post" action="search.php?query=' . $_GET[ 'query' ] . '"><label for="order3">Order By: </label>' . '<select name="order3" onChange="submit()">' . '<option value="alpha" ';
		
		if ( isset( $_POST[ 'order3' ] ) && $_POST[ 'order3' ] == "rele" ) {
			$sel = "selected";
		} else {
			$sel = "";
		}
		
		if ( isset( $_POST[ 'order3' ] ) && $_POST[ 'order3' ] == "alpha" ) {
			$sel2 = "selected";
		} else {
			$sel2 = "";
			
		}
		echo $sel2 . '>Alphabetically</option>' . '<option value="rele"' . $sel . '>Revelence</option>' . '</select></form>';
		
		//SQL INJECTION PREVENTION START
		$stmt = $connection->prepare( 'SELECT A.albumname, A.albumid FROM Album A WHERE A.albumname like ? OR A.albumname like ? OR A.albumname like ?' );
		if ( !$stmt ) {
			echo $connection->error;
		}
		$stmt->bind_param( 'sss', $query1, $query2, $query3 );
		
		$stmt->execute();
		$stmt->bind_result( $name, $aID );
		
		
		if ( !isset( $_POST[ 'order3' ] ) || $_POST[ 'order3' ] == 'alpha' ) {
			echo '<div style="position: relative; height: 13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			while ( $row = $stmt->fetch() ) {
				$url  = "http://avid.cs.umass.edu/projects/course-project/Musicnet/album.php?id=" . $aID;
				$html = '<a href="' . $url . '">';
				printf( $html . '%s</a></br>', $name );
			}
			echo '</div>';
		} else {
			$arr     = array();
			$results = array();
			$name    = array();
			$ids     = array();
			
			
			while ( $row = $stmt->fetch() ) {
				array_push( $arr, $name );
				array_push( $ids, $aID );
			}
			
			$prob = probAverage( $query, $arr );
			
			
			for ( $i = 0; $i < count( $arr ); $i++ ) {
				array_push( $results, array(
					 $arr[ $i ],
					$prob[ $i ],
					$ids[ $i ] 
				) );
			}
			array_multisort( $prob, SORT_DESC, $results );
			echo '<div style="position: relative; height: 13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			for ( $i = 0; $i < count( $results ); $i++ ) {
				$url  = "http://avid.cs.umass.edu/projects/course-project/Musicnet/album.php?id=" . $results[ $i ][ 2 ];
				$html = '<a href="' . $url . '">';
				echo $html . $results[ $i ][ 0 ] . "</a> <div style='float: right;'>Probability: " . ( ( ($results[ $i ][ 1 ] * 100 ) % 100 ) ) . "%</div><br>";
				
				
				
			}
			echo '</div>';
			
		}
	}
	
	
	
	
	
	
	
	
	//NUMERIC INPUT
	if ( is_numeric( $query ) ) {
		
		//SONG CHUNK
		echo '<h4 class="page-header" style="margin-top: 1%">Songs by Year</h4>';
		
		//SQL INJECTION PREVENTION START
		$stmt = $connection->prepare( 'SELECT S.title, S.year, S.songid FROM Song S WHERE S.year = ?' );
		if ( !$stmt ) {
			echo $connection->error;
		}
		$stmt->bind_param( 'i', $query1 );
		
		$stmt->execute();
		$stmt->bind_result( $title, $year, $sID );
		
		
		if ( !isset( $_POST[ 'order1' ] ) || $_POST[ 'order1' ] == 'alpha' ) {
			echo '<div style="position: relative; height: 80%; overflow: auto; background-color: #eee; border: 2px solid;">';
			while ( $row = $stmt->fetch() ) {
				$url  = "http://avid.cs.umass.edu/projects/course-project/Musicnet/song.php?id=" . $sID;
				$html = '<a href="' . $url . '">';
				printf( $html . '%s</a></br>', $title );
			}
			echo '</div>';
		}
		
		
	}
	
}

$stmt->close();


function queryProbability( $query, $res )
{
	
	$prob = array();
	$p    = ( float ) 0;
	$maxp = ( float ) 0;
	for ( $i = 0; $i < count( $res ); $i++ ) {
		$tokens = array();
		$words = preg_replace("/[^a-zA-Z0-9\s]/", "", $res[ $i ]);
		$words = strtolower( $words );
		$tokens =  explode( " ", $words );
		for ( $j = 0; $j < count( $tokens ); $j++) {
			$p    = 1.0 - bcdiv( levenshtein( $tokens[ $j ], $query ), max( strlen( $tokens[ $j ] ), strlen( $query ) ), 4 );
			$maxp = max( $maxp, $p );
		}
		$prob[ $i ] = $maxp;
		$maxp       = 0;
	}
	return $prob;
	
	
}

function advancedProb( $query, $res )
{
	
	$prob     = array();
	$p        = array();
	$maxp     = 0;
	$maxindex = 0;
	
	for ( $i = 0; $i < count( $res ); $i++ ) {
		$tokens = array();
		$words = preg_replace("/[^a-zA-Z0-9\s]/", "", $res[ $i ]);
		$words = strtolower( $words );
		$tokens =  explode( " ", $words );
		for ( $j = 0; $j < count( $tokens ); $j++) {
			$p[ $j ] = ( 1.0 - bcdiv( levenshtein( $tokens[ $j ], $query ), max( strlen( $tokens[ $j ] ), strlen( $query ) ), 10 ) );
			if ( $maxp < $p[ $j ] ) {
				$maxp     = $p[ $j ];
				$maxindex = $j;
			}
		}
		$sub = 0;
		for ( $k = 0; $k < count( $p ); $k++ ) {
			if ( $p[ $k ] != $p[ $maxindex ] ) {
				$sub = $sub + ( ( $p[ $k ] * $p[ $k ] ) / ( count( $p ) * count( $p ) ) );
				
			}
		}
		$prob[ $i ] =  $maxp -  $sub;
		$maxp       = 0;
		$maxindex   = 0;
	}
	return $prob;
}

function probAverage( $query, $res )
{
	
	$naive    = queryProbability( $query, $res );
	$advanced = advancedProb( $query, $res );
	$fin      = array();
	for ( $i = 0; $i < count( $naive ); $i++ ) {
		$fin[ $i ] = (( $naive[ $i ] + $advanced[ $i ] ) / 2 ) ;
	}
	return $fin;
}

	



?>
