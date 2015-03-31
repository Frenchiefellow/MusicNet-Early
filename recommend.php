<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/Scripts/checkUser.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/header.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/navbarProfile.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/sidePlaceHolder.php'; ?>
<style><?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/bs/css/recommend.css'; ?></style>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">    
<h2 class='page-header colHeader topHead'>MusicNet thinks you might like...</h2>

<div class="outline">
<h3 class='page-header colHeader type'>These Songs, Based On the Tags of Your Other Songs</h3>
<div class='row desc'>
<?php 


//DB CONNECTION
//START WHAT CHRIS TOLD ME TO WRITE

$stmt = $connection->prepare( 'SELECT songid FROM UserInteraction WHERE loginacct = ? AND ( plays > 0 OR rating > 0 )' );
$stmt->bind_param('s', $_SESSION[ 'username' ] );
$stmt->execute();
$stmt->bind_result($sid);
$ids = array();
while($stmt->fetch()){
	array_push( $ids , $sid );
}

$stmt->close();

if( count( $ids ) > 0 ){
$tag = array(); 
for($i=0; $i<count($ids); $i++){
	$stmt = $connection->prepare('SELECT tagname FROM TaggedBy_Tags WHERE songid = ?');
	$stmt->bind_param('s', $ids[$i]);
	$stmt->execute();
	$stmt->bind_result($tags);
	while($stmt->fetch()){
		array_push($tag, $tags);
	}
}
$stmt->close();


//END WHAT CHRIS TOLD ME TO WRITE
//START TED'S CODE
$mostTagged;
$numTags = 0;
for($i=0; $i<count($tag); $i++){
	if( $tag[$i] != NULL || $tag[$i] != '' || $tag[$i] != ' '){
	$curTag = $tag[$i];
	$curNum = 0;
	for($j=0; $j<count($tag); $j++){
		if($ids[$j] = $curTag){
			$curNum++;
		}
	}
	if($curNum > $numTags){
		$numTags = $curNum;
		$mostTagged = $curTag;
	}
	}
}

//CHRIS CODE
$stmt = $connection->prepare( 'SELECT T.songid FROM TaggedBy_Tags T where T.tagname = ? AND T.weight > .5 AND T.songid NOT IN ( SELECT songid FROM UserInteraction WHERE loginacct = ? ) LIMIT 5' );
$stmt->bind_param( 'ss', $mostTagged, $_SESSION[ 'username' ] );
$stmt->execute();
$stmt->bind_result( $id );
$songid = array();
while($stmt->fetch()){
	array_push( $songid, $id );
}
$stmt->close();

$tot = array();
for($i=0; $i<count($songid); $i++){
$stmt = $connection->prepare( 'SELECT title FROM Song WHERE songid = ? ' );
$stmt->bind_param( 's', $songid[ $i ] );
$stmt->execute();
$stmt->bind_result( $title);
$counter = 0;
while($stmt->fetch()){
	 array_push( $tot, $title );
       
    }
$stmt->close();
}

for($i=0; $i<count($tot); $i++){
	echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';  echo base64_encode(file_get_contents("/nfs/avid/data1/html/projects/course-project/Musicnet/resources/images/note2.png")); echo '">
          <h2 class="colHead">'; echo $tot[ $i ]; echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="'; echo 'http://avid.cs.umass.edu/projects/course-project/Musicnet/song.php?id=' . $songid[ $i ]; echo '" role="button">Listen!</a></span>
        </div>';
    }
    echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';  echo base64_encode(file_get_contents("/nfs/avid/data1/html/projects/course-project/Musicnet/resources/images/note2.png")); echo '">
          <h2 class="colHead">'; echo "The Michael Rosen Lounge"; echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="http://avid.cs.umass.edu/projects/course-project/Musicnet/song.php?id=M1CH43LR053NL0UNG3" role="button">Listen!</a></span>
        </div>';


$connection->close();
}
else{
	for($i=0; $i<6; $i++){
		  echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';  echo base64_encode(file_get_contents("/nfs/avid/data1/html/projects/course-project/Musicnet/resources/images/note2.png")); echo '">
          <h2 class="colHead">'; echo "The Michael Rosen Lounge"; echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="http://avid.cs.umass.edu/projects/course-project/Musicnet/song.php?id=M1CH43LR053NL0UNG3" role="button">Listen!</a></span>
        </div>';

	}
}
?>
</div>
</div>
<div class="outline" style='margin-top: 2%;'>
<h3 class='page-header colHeader type'>These Artists,</h3>
<div class='row desc'>
<?php 


//DB CONNECTION
if ( !$connection ) {
	die( "Couldn't connect to mysql server!<br>The error was: " . mysql_error() );
}

$stmt = $connection->query( 'SELECT artistname, artistid FROM Artist WHERE LENGTH(artistname) > 7 ORDER BY rand() LIMIT 6' );


while( $row = $stmt->fetch_assoc() ){

echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';  echo base64_encode(file_get_contents("/nfs/avid/data1/html/projects/course-project/Musicnet/resources/images/singer.png")); echo '">
          <h2 class="colHead">'; echo $row[ 'artistname' ]; echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-primary" href="'; echo 'http://avid.cs.umass.edu/projects/course-project/Musicnet/artist.php?id=' . $row[ 'artistid' ]; echo '" role="button">View!</a></span>
        </div>';

} 
$stmt->close();

$connection->close();
?>
</div>
</div>
<div class="outline" style='margin-top: 2%;'>
<h3 class='page-header colHeader type'>And These Albums!</h3>
<div class='row desc'>
<?php 


//DB CONNECTION
if ( !$connection ) {
	die( "Couldn't connect to mysql server!<br>The error was: " . mysql_error() );
}

$stmt = $connection->query( 'SELECT albumname, albumid FROM Album WHERE LENGTH(albumname) > 7 ORDER BY rand() LIMIT 6' );



while( $row = $stmt->fetch_assoc() ){
echo '<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src="data:image/png;base64,';  echo base64_encode(file_get_contents("/nfs/avid/data1/html/projects/course-project/Musicnet/resources/images/vinyl.png")); echo '">
          <h2 class="colHead">'; if( $row[ 'albumname' ] == ''){ echo 'N/A'; } else{ echo $row[ 'albumname' ]; } echo '</h2>
          <span class= "tuxedo" style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-primary" href="'; echo 'http://avid.cs.umass.edu/projects/course-project/Musicnet/album.php?id=' . $row[ 'albumid' ]; echo '" role="button">View!</a></span>
        </div>';

} 
$stmt->close();

$connection->close();
?>
</div>
</div>
</div>
</div>


<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/bottombar.php'; ?>

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