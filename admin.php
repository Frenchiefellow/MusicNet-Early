<?php
if ( !isset( $_SESSION ) ) {
	session_start();
}
echo '<form action="http://avid.cs.umass.edu/projects/course-projects/Musicnet/profile.php?user=' . $_SESSION[ 'username' ] . '" class="navbar-form navbar-right" role="form" method="post">' . '<button type="submit" class="btn btn-success" >Back to Profile</button></form>';
?>

<form method="post" action="<?php
if ( isset( $_SESSION ) ) {
	$si = session_id();
	echo 'admin.php?id=' . $si;
}
?>">
<textarea name="query" cols="100" rows="5" placeholder="Enter Query, followed by ;">
</textarea><br>
<input type="submit" value="Submit" />
</form>

<?php
if ( !isset( $_SESSION ) ) {
	session_start();
}
if ( isset( $_SESSION ) ) {
	$si = session_id();
	if ( isset( $_GET[ 'id' ] ) ) {
		if ( ( $_GET[ 'id' ] == $si ) && ( $_SESSION[ 'username' ] == 'admin' ) ) {
			echo 'Authentication: True <br>';
			if ( isset( $_GET[ 'error' ] ) ) {
				if ( $_GET[ 'error' ] == "ILLEGAL_KEYWORD" ) {
					echo 'Illegal Keyword used in previous query.<br>';
				}
			}
			
			if ( isset( $_POST[ 'query' ] ) ) {
				$words = array();
				if ( contains( $_POST[ 'query' ], $words ) ) {
					header( 'Location: admin.php?id=' . $si . '&error=ILLEGAL_KEYWORD' );
					die();
				} else {
					$text  = $_POST[ 'query' ];
					$query = mysql_real_escape_string( $text );
					echo 'Query: ' . $text . "<br>\n";
					//DB CONNECTION
					if ( !$connection ) {
						die( "Couldn't connect to mysql server!<br>The error was: " . mysql_error() );
					} else {
						echo "Connection Status: Successful!<br>\n";
					}
					if ( !mysql_select_db( "Music" ) )
						die( "Couldn't select a database!<br> Error: " . mysql_error() );
					else
						echo "Database Status: Connected!<br><br>\n";
					$db        = 'Music';
					$starttime = microtime( true );
					$result    = mysql_query( $text );
					$endtime   = microtime( true );
					$totaltime = $endtime - $starttime;
					
					if ( !$result ) {
						echo 'MySQL Error: ' . mysql_error();
						exit;
					}
					
					$keys = array('delete', 'update', 'alter', 'insert' );
					if( !contains( $query, $keys ) ) {
						echo '<table border = "1" > <tbody> <tr>';
						
						$res = array();
						
						while ( $row = mysql_fetch_assoc( $result ) ) {
							$res[] = $row;
						}
						$columns = array_keys( reset( $res ) );
						
						foreach ( $columns as $col ) {
							echo "<th style='padding-left: 5px; padding-right: 5px;'>$col</th>";
						}
						echo '</tr>';
						foreach ( $res as $row ) {
							echo "<tr>";
							foreach ( $columns as $col ) {
								echo "<td style='padding-left: 5px; padding-right: 5px;'>" . $row[ $col ] . "</td>";
							}
							echo "</tr>";
						}
						echo 'QUERY STATUS: SUCCESS!';
					}
					else{
						echo 'Query Success! ' . $result . " row(s) affected!<br>";
					}
					
					echo '</tr></tbody></table><br>';
					echo "APPROXIMATE QUERY TIME: " . round( $totaltime, 3, PHP_ROUND_HALF_UP ) . " seconds<br><br>";
					
					
				}
			}
		} else {
			echo ' Authenication: False';
		}
	}
}
echo '<form action="http://avid.cs.umass.edu/projects/course-projects/Musicnet/profile.php?user=' . $_SESSION[ 'username' ] . '" class="navbar-form navbar-right" role="form" method="post">' . '<button type="submit" class="btn btn-success" >Back to Profile</button></form>';


function contains( $str, array $arr )
{
	foreach ( $arr as $a ) {
		if ( stripos( $str, $a ) !== false )
			return true;
	}
	return false;
}

?>
