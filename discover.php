<?php
include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/header.php';
?>
<?php
include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/navbarProfile.php';
?>
<?php
include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/sidePlaceHolder.php';
?>
<style><?php
include '/nfs/avid/data1/html/projects/course-project/Musicnet/bs/css/discover.css';
?></style>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="height: 30%">    
<h2 class='page-header colHeader topHead'>Discover a Sample of What MusicNet Has to Offer!</h2>

<div class="outline">
<h3 class='page-header colHeader type'>Songs!</h3>
<div class='row desc'>
<?php


//DB CONNECTION
if( !$connection ) {
	die( "Couldn't connect to mysql server!<br>The error was: " . mysql_error() );
}
echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';
echo base64_encode( file_get_contents( "/nfs/avid/data1/html/projects/course-project/Musicnet/resources/images/note2.png" ) );
echo '">
          <h2 class="colHead">';
echo "The Michael Rosen Lounge";
echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="http://avid.cs.umass.edu/projects/course-project/Musicnet/song.php?id=M1CH43LR053NL0UNG3" role="button">Listen!</a></span>
        </div>';

$stmt = $connection->query( 'SELECT title, songid FROM Song WHERE duration > 180 AND playcount > 5 ORDER BY rand() LIMIT 5' );


while( $row = $stmt->fetch_assoc() ) {
	echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';
	echo base64_encode( file_get_contents( "/nfs/avid/data1/html/projects/course-project/Musicnet/resources/images/note2.png" ) );
	echo '">
          <h2 class="colHead">';
	echo $row[ 'title' ];
	echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="';
	echo 'http://avid.cs.umass.edu/projects/course-project/Musicnet/song.php?id=' . $row[ 'songid' ];
	echo '" role="button">Listen!</a></span>
        </div>';
	
}
$stmt->close();

$connection->close();
?>
</div>
</div>
<div class="outline" style='margin-top: 2%;'>
<h3 class='page-header colHeader type'>Artists!</h3>
<div class='row desc'>
<?php


//DB CONNECTION
if( !$connection ) {
	die( "Couldn't connect to mysql server!<br>The error was: " . mysql_error() );
}

$stmt = $connection->query( 'SELECT artistname, artistid FROM Artist WHERE LENGTH(artistname) > 7 ORDER BY rand() LIMIT 6' );


while( $row = $stmt->fetch_assoc() ) {
	
	echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';
	echo base64_encode( file_get_contents( "/nfs/avid/data1/html/projects/course-project/Musicnet/resources/images/singer.png" ) );
	echo '">
          <h2 class="colHead">';
	echo $row[ 'artistname' ];
	echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-primary" href="';
	echo 'http://avid.cs.umass.edu/projects/course-project/Musicnet/artist.php?id=' . $row[ 'artistid' ];
	echo '" role="button">View!</a></span>
        </div>';
	
}
$stmt->close();

$connection->close();
?>
</div>
</div>
<div class="outline" style='margin-top: 2%;'>
<h3 class='page-header colHeader type'>Albums!</h3>
<div class='row desc'>
<?php


//DB CONNECTION
if( !$connection ) {
	die( "Couldn't connect to mysql server!<br>The error was: " . mysql_error() );
}

$stmt = $connection->query( 'SELECT albumname, albumid FROM Album WHERE LENGTH(albumname) > 7 ORDER BY rand() LIMIT 6' );


while( $row = $stmt->fetch_assoc() ) {
	echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';
	echo base64_encode( file_get_contents( "/nfs/avid/data1/html/projects/course-project/Musicnet/resources/images/vinyl.png" ) );
	echo '">
          <h2 class="colHead">';
	if( $row[ 'albumname' ] == '' ) {
		echo 'N/A';
	} else {
		echo $row[ 'albumname' ];
	}
	echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-primary" href="';
	echo 'http://avid.cs.umass.edu/projects/course-project/Musicnet/album.php?id=' . $row[ 'albumid' ];
	echo '" role="button">View!</a></span>
        </div>';
	
}
$stmt->close();

$connection->close();
?>
</div>
</div>
</div>
</div>


<?php
include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/bottombar.php';
?>

<script>
$(document).ready(function(){
	$('.Cimg').height("35%").width("35%");
	$('body').css('overflow', 'hidden');
	$('h2').css('margin', '0');
	$('.colHead').css('font-size', '0.9em');
	$('.type').css({'font-size' :'1.2em', 'margin-bottom' : '5px'});
	$('.topHead').css({'margin': '', 'font-size' : '1.5em'});
	$('.btn').css({'font-size' : '.75em'});

});
</script>
