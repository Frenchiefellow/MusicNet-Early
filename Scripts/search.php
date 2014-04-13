<?php

if ( !isset( $_SESSION ) ) {
	session_start();
}

echo '<style>html, body{height: 100%;}</style>';

if ( isset( $_GET[ 'query' ] ) ) {
	
	$query1     = strtolower( $_GET[ 'query' ] . "%" );
	$query      = strtolower( $_GET[ 'query' ] );
	$connection = @new mysqli( /*removed*/ );
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
		$stmt = $connection->prepare( 'SELECT U.loginacct, U.username, U.userloc FROM User U WHERE U.loginacct like ? or U.username like ? or U.userloc like ? LIMIT 50' );
		if ( !$stmt ) {
			echo $connection->error;
		}
		$stmt->bind_param( 'sss', $query1, $query1, $query1 );
		
		$stmt->execute();
		$stmt->bind_result( $log, $username, $userloc );
		
		
		if ( !isset( $_POST[ 'order' ] ) || $_POST[ 'order' ] == 'alpha' ) {
			echo '<div style="position: relative; height:13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			while ( $row = $stmt->fetch() ) {
				$url  = "http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=" . $log;
				$html = '<a href="' . $url . '">';
				printf( $html . '%s</a></br>', $log );
			}
			echo '</div>';
		} else {
			$arr     = array();
			$results = array();
			$name    = array();
			$loc     = array();
			$l       = 0;
			$u       = 0;
			$ul      = 0;
			$sorter;
			
			while ( $row = $stmt->fetch() ) {
				array_push( $arr, $log );
				array_push( $name, $username );
				array_push( $loc, $userloc );
			}
			foreach ( $arr as $s ) {
				$l = $l + ( ( levenshtein( $s, $query ) / max( strlen( $s ), strlen( $query ) ) ) );
			}
			foreach ( $name as $s ) {
				$u = $u + ( ( levenshtein( $s, $query ) / max( strlen( $s ), strlen( $query ) ) ) );
			}
			foreach ( $loc as $s ) {
				$ul = $ul + ( ( levenshtein( $s, $query ) / max( strlen( $s ), strlen( $query ) ) ) );
			}
			
			$maxp = min( ( $l / count( $arr ) ), ( $u / count( $name ) ), ( $ul / count( $loc ) ) );
			
			if ( $maxp == ( $l / count( $arr ) ) ) {
				$prob   = probAverage( $query, $arr );
				//echo 'login';
				$sorter = 'Login Account';
			} elseif ( $maxp == ( $u / count( $name ) ) ) {
				$prob   = probAverage( $query, $name );
				//echo 'username';
				$sorter = 'Name';
				
			} elseif ( $maxp == ( $ul / count( $loc ) ) ) {
				$prob   = probAverage( $query, $loc );
				//echo 'location';
				$sorter = 'User Location';
				
				
			}
			
			
			
			for ( $i = 0; $i < count( $arr ); $i++ ) {
				array_push( $results, array(
					 $arr[ $i ],
					$prob[ $i ],
					$name[ $i ],
					$loc[ $i ] 
				) );
			}
			array_multisort( $prob, SORT_DESC, $results );
			echo '<div style="font-weight: bold;">Sorting By: ' . $sorter . '</div>';
			echo '<div style="position: relative; height: 13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			for ( $i = 0; $i < count( $results ); $i++ ) {
				$url  = "http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=" . $results[ $i ][ 0 ];
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
		$stmt = $connection->prepare( 'SELECT S.title, S.songid FROM Song S WHERE S.title like ? LIMIT 50' );
		if ( !$stmt ) {
			echo $connection->error;
		}
		$stmt->bind_param( 's', $query1 );
		
		$stmt->execute();
		$stmt->bind_result( $title, $sID );
		
		
		if ( !isset( $_POST[ 'order1' ] ) || $_POST[ 'order1' ] == 'alpha' ) {
			echo '<div style="position: relative; height: 13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			while ( $row = $stmt->fetch() ) {
				$url  = "http://cs445.cs.umass.edu/php-wrapper/clp/song.php?id=" . $sID;
				$html = '<a href="' . $url . '">';
				printf( $html . '%s</a></br>', $title );
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
			echo '<div style="position: relative; height: 13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			for ( $i = 0; $i < count( $results ); $i++ ) {
				$url  = "http://cs445.cs.umass.edu/php-wrapper/clp/song.php?id=" . $results[ $i ][ 2 ];
				$html = '<a href="' . $url . '">';
				echo $html . $results[ $i ][ 0 ] . "</a> <div style='float: right;'>Probability: " . ( number_format( ( $results[ $i ][ 1 ] * 100 ), 0 ) ) . "%</div><br>";
				
				
				
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
		$stmt = $connection->prepare( 'SELECT A.artistname, A.artistid FROM Artist A WHERE A.artistname like ? LIMIT 50' );
		if ( !$stmt ) {
			echo $connection->error;
		}
		$stmt->bind_param( 's', $query1 );
		
		$stmt->execute();
		$stmt->bind_result( $name, $aID );
		
		
		if ( !isset( $_POST[ 'order2' ] ) || $_POST[ 'order2' ] == 'alpha' ) {
			echo '<div style="position: relative; height: 13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			while ( $row = $stmt->fetch() ) {
				$url  = "http://cs445.cs.umass.edu/php-wrapper/clp/artist.php?id=" . $aID;
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
				$url  = "http://cs445.cs.umass.edu/php-wrapper/clp/artist.php?id=" . $results[ $i ][ 2 ];
				$html = '<a href="' . $url . '">';
				echo $html . $results[ $i ][ 0 ] . "</a> <div style='float: right;'>Probability: " . ( number_format( ( $results[ $i ][ 1 ] * 100 ), 0 ) ) . "%</div><br>";
				
				
				
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
		$stmt = $connection->prepare( 'SELECT A.albumname, A.albumid FROM Album A WHERE A.albumname like ? LIMIT 50' );
		if ( !$stmt ) {
			echo $connection->error;
		}
		$stmt->bind_param( 's', $query1 );
		
		$stmt->execute();
		$stmt->bind_result( $name, $aID );
		
		
		if ( !isset( $_POST[ 'order3' ] ) || $_POST[ 'order3' ] == 'alpha' ) {
			echo '<div style="position: relative; height: 13%; overflow: auto; background-color: #eee; border: 2px solid;">';
			while ( $row = $stmt->fetch() ) {
				$url  = "http://cs445.cs.umass.edu/php-wrapper/clp/album.php?id=" . $aID;
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
				$url  = "http://cs445.cs.umass.edu/php-wrapper/clp/album.php?id=" . $results[ $i ][ 2 ];
				$html = '<a href="' . $url . '">';
				echo $html . $results[ $i ][ 0 ] . "</a> <div style='float: right;'>Probability: " . ( number_format( ( $results[ $i ][ 1 ] * 100 ), 0 ) ) . "%</div><br>";
				
				
				
			}
			echo '</div>';
			
		}
	}
	
	
	
	
	
	
	
	
	//NUMERIC INPUT
	if ( is_numeric( $query ) ) {
		
		//SONG CHUNK
		echo '<h4 class="page-header" style="margin-top: 1%">Songs by Year</h4>';
		
		//SQL INJECTION PREVENTION START
		$stmt = $connection->prepare( 'SELECT S.title, S.year, S.songid FROM Song S WHERE S.year = ? LIMIT 50' );
		if ( !$stmt ) {
			echo $connection->error;
		}
		$stmt->bind_param( 'i', $query1 );
		
		$stmt->execute();
		$stmt->bind_result( $title, $year, $sID );
		
		
		if ( !isset( $_POST[ 'order1' ] ) || $_POST[ 'order1' ] == 'alpha' ) {
			echo '<div style="position: relative; height: 80%; overflow: auto; background-color: #eee; border: 2px solid;">';
			while ( $row = $stmt->fetch() ) {
				$url  = "http://cs445.cs.umass.edu/php-wrapper/clp/song.php?id=" . $sID;
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
		$tok    = strtok( strtolower( $res[ $i ] ), " " );
		do {
			$tokens[] = $tok;
			$tok      = strtok( " " );
		} while ( $tok !== false );
		foreach ( $tokens as $s ) {
			$p    = 1.0 - bcdiv( levenshtein( $s, $query ), max( strlen( $s ), strlen( $query ) ), 4 );
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
		$tokenized = array();
		$tok       = strtok( strtolower( $res[ $i ] ), " " );
		do {
			$tokenized[] = $tok;
			$tok         = strtok( " " );
		} while ( $tok !== false );
		for ( $j = 0; $j < count( $tokenized ); $j++ ) {
			$p[ $j ] = ( 1.0 - bcdiv( levenshtein( $tokenized[ $j ], $query ), max( strlen( $tokenized[ $j ] ), strlen( $query ) ), 5 ) );
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
		$prob[ $i ] = ( $maxp - $sub );
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
		$fin[ $i ] = ( ( $naive[ $i ] + $advanced[ $i ] ) / 2 );
	}
	return $fin;
}




?>
