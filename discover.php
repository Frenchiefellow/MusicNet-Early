<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/header.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarProfile.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/sidePlaceHolder.php'; ?>
<style><?php include '/courses/cs400/cs445/php-dirs/clp/www/bs/css/discover.css'; ?></style>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">    
<h2 class='page-header colHeader'>Discover a Sample of What MusicNet Has to Offer!</h2>

<div class="outline">
<h3 class='page-header colHeader'>Songs!</h3>
<div class='row desc'>
<?php 


$connection = @new mysqli( /*removed*/ );

if ( !$connection ) {
	die( "Couldn't connect to mysql server!<br>The error was: " . mysql_error() );
}
echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';  echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/note2.png")); echo '">
          <h2 class="colHead">'; echo "The Michael Rosen Lounge"; echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="http://cs445.cs.umass.edu/php-wrapper/clp/song.php?id=M1CH43LR053NL0UNG3" role="button">Listen!</a></span>
        </div>';

$stmt = $connection->query( 'SELECT title, songid FROM Song ORDER BY rand() LIMIT 5' );


while( $row = $stmt->fetch_assoc() ){
echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';  echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/note2.png")); echo '">
          <h2 class="colHead">'; echo $row[ 'title' ]; echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="'; echo 'http://cs445.cs.umass.edu/php-wrapper/clp/song.php?id=' . $row[ 'songid' ]; echo '" role="button">Listen!</a></span>
        </div>';

} 
$stmt->close();

$connection->close();
?>
</div>
</div>
<div class="outline" style='margin-top: 2%;'>
<h3 class='page-header colHeader'>Artists!</h3>
<div class='row desc'>
<?php 


$connection = @new mysqli( /*removed*/ );

if ( !$connection ) {
	die( "Couldn't connect to mysql server!<br>The error was: " . mysql_error() );
}

$stmt = $connection->query( 'SELECT artistname, artistid FROM Artist ORDER BY rand() LIMIT 6' );


while( $row = $stmt->fetch_assoc() ){

echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';  echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/singer.png")); echo '">
          <h2 class="colHead">'; echo $row[ 'artistname' ]; echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-primary" href="'; echo 'http://cs445.cs.umass.edu/php-wrapper/clp/artist.php?id=' . $row[ 'artistid' ]; echo '" role="button">View!</a></span>
        </div>';

} 
$stmt->close();

$connection->close();
?>
</div>
</div>
<div class="outline" style='margin-top: 2%;'>
<h3 class='page-header colHeader'>Albums!</h3>
<div class='row desc'>
<?php 


$connection = @new mysqli( /*removed*/ );

if ( !$connection ) {
	die( "Couldn't connect to mysql server!<br>The error was: " . mysql_error() );
}

$stmt = $connection->query( 'SELECT albumname, albumid FROM Album ORDER BY rand() LIMIT 6' );


while( $row = $stmt->fetch_assoc() ){
echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';  echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png")); echo '">
          <h2 class="colHead">'; if( $row[ 'albumname' ] == ''){ echo 'N/A'; } else{ echo $row[ 'albumname' ]; } echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-primary" href="'; echo 'http://cs445.cs.umass.edu/php-wrapper/clp/album.php?id=' . $row[ 'albumid' ]; echo '" role="button">View!</a></span>
        </div>';

} 
$stmt->close();

$connection->close();
?>
</div>
</div>
</div>
</div>


<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php'; ?>