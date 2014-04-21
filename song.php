<?php include '/courses/cs400/cs445/php-dirs/clp/www/Scripts/checkMusic.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/header.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarProfile.php'; ?>

<style>
html, body {
	height: 100%;
	width: 100%;
	margin: auto;
	overflow: auto;
	min-height: 100%;
	padding-bottom: 40px;
	background-image: url('http://www.psdgraphics.com/file/music-equalizer.jpg');
	background-size:  100%;
}
</style>


<div style="height: 65%; ">
<div class="jumbotron" style="position: relative; text-align: center; margin: auto; overflow: auto; width: 100; background-color: rgba(128, 128, 128, .7)">
<div style="border: 10px solid black; height: 120px; border-radius: 10px; background-color: black;">
<div style="height: 120px;">
<div class="col-sm-2" style="margin: auto; background-color: #FC1501; border-left: 2px solid #eee; border-top: 2px solid #eee; border-bottom: 2px solid #eee; border-radius: 10px 0px 0px 10px"><br><br>
<div style="color: white;">Total Plays: </div>
<div id="res" style="color: white;"><?php 
		$connection = @new mysqli( /*removed*/ );
		$song = $_GET[ 'id' ];
		$stmt = $connection->prepare( 'SELECT playcount FROM Song WHERE songid = ?' );
		$stmt->bind_param( 's',  $song);
		$stmt->execute();
		$stmt->bind_result( $plays );
		while($row = $stmt->fetch()){
		if( !is_null( $plays ) ){
		echo $plays;
		}
		else{	
		echo 0;
		}
		}
		?></div><br><br>
</div>



<?php
if( isset( $_SESSION[ 'username' ] ) ){
	$id = $_GET[ 'id' ];
	echo '<div class="col-sm-2" style="background-color: #FFFF00; border-top: 2px solid #eee; border-bottom: 2px solid #eee; padding-bottom: 6px;">';
	echo '<a onclick="updatePlaylists(\'' . $id . '\')"><img src="http://cs445.cs.umass.edu/groups/clp/www/resources/images/button.png" style="width=80px; height: 80px;"></a><br>';
	echo '<a onclick="updatePlaylists(\'' . $id . '\')" class="btn btn-success">Add to Playlist!</a>'; 
}
else{
	echo '<div class="col-sm-2" style="background-color: #FFFF00; border-top: 2px solid #eee; border-bottom: 2px solid #eee; padding-bottom: 6px;">';
	echo "<br><br><a href='http://cs445.cs.umass.edu/php-wrapper/cl/splash.php' class='btn btn-warning'>Log In to <br> Add to Playlist!</a><br><br>";
}
?>

</div>
<div class="col-sm-4" style="background-color: #4EEE94; padding-bottom: 5px; border-top: 2px solid #eee; border-bottom: 2px solid #eee;">
<div><?php 
		$connection = @new mysqli( /*removed*/ );
		$song = $_GET[ 'id' ];
		$stmt = $connection->prepare( 'SELECT title FROM Song WHERE songid = ?' );
		$stmt->bind_param( 's',  $song );
		$stmt->execute();
		$stmt->bind_result( $title );
		while($row = $stmt->fetch()){
		echo $title . " by:  <a href='http://cs445.cs.umass.edu/php-wrapper/clp/artist.php?id="; 
		}
		$stmt = $connection->prepare( 'select A.artistname, A.artistid from Artist A, Linked_To L where L.songid = ? and L.artistid = A.artistid' );
		$stmt->bind_param( 's',  $song );
		$stmt->execute();
		$stmt->bind_result( $name, $aID );
		while($row = $stmt->fetch()){
		echo $aID . "'>" . $name . "</a>";
		}


		?></div><br>
<audio controls id="music" source src="" type="audio/mpeg" style="width: 100%;">Your browser does not support this audio format.</audio>
<br><br><div> <?php 
		$stmt = $connection->prepare( 'select A.albumname, A.albumid from Album A, Linked_To L where L.songid = ? and L.albumid = A.albumid' );
		$stmt->bind_param( 's',  $song );
		$stmt->execute();
		$stmt->bind_result( $name, $aID );
		while($row = $stmt->fetch()){
			if( $name != '' ){
				echo "<a href='http://cs445.cs.umass.edu/php-wrapper/clp/album.php?id=" . $aID . "'>" . $name . "</a>";
			}
			else{
				echo "<a href='http://cs445.cs.umass.edu/php-wrapper/clp/album.php?id=" . $aID . "'>ALBUM</a>";
			}
		}



		?></div>
</div>


		<?php 

		$Logged = true;
		$prevRate = 0;
		if( !isset ( $_SESSION[ 'username' ] ) ){
			$Logged = false;
		}
		$stmt = $connection->prepare( 'select rating from UserInteraction where songid = ? and loginacct = ?' );
		$stmt->bind_param( 'ss',  $song, $_SESSION[ 'username' ] );
		$stmt->execute();
		$stmt->bind_result( $rating );
		$stmt->store_result();

		if( $stmt->num_rows > 0 ){
			while( $row = $stmt->fetch() ){
				$prevRate = $rating;
			}
		}
		else{
			$prevRate = 0;
		}

		
		if ( $Logged === true ){
		echo '<div class="col-sm-2" style="background-color: #007FFF; padding-bottom: 10px; border-top: 2px solid #eee; border-bottom: 2px solid #eee; "><br>';
		echo '<form method="post" action="' . $_SERVER['REQUEST_URI'] .'">
		<label for="rating">Rating:</label><br>';
		if( $prevRate != 0){
		echo '<select id="ratings" name="rating" onchange="UpdateRating(this, 0 );">';
		}
		else{
			echo '<select id="ratings" name="rating" onchange="UpdateRating(this, 1);">';
		}
		if( $prevRate == 0 ){
		echo '<option value="norating" '; 
			echo 'selected="selected"';
		
		echo '>No Rating</option>';
		}
		echo '<option value="1" ';
		if( $prevRate == 1 ){
			echo 'selected="selected"';
		}
		echo '>1</option>' .
		'<option value="2" ';
		if( $prevRate == 2 ){
			echo 'selected="selected"';
		}
		echo '>2</option>' .
		'<option value="3" ';
		if( $prevRate == 3 ){
			echo 'selected="selected"';
		}
		echo '>3</option>' .
		'<option value="4" ';
		if( $prevRate == 4 ){
			echo 'selected="selected"';
		}
		echo '>4</option>' .
		'<option value="5" ';
		if( $prevRate == 5 ){
			echo 'selected="selected"';
		}
		 echo '>5</option>';
		}
		else{
			echo '<div class="col-sm-2" style="background-color: #007FFF; padding-bottom: 26px; border-top: 2px solid #eee; border-bottom: 2px solid #eee; "><br>';
			echo "<br><a href='http://cs445.cs.umass.edu/php-wrapper/cl/splash.php' class='btn btn-warning'>Log In to Rate!</a>";
		}
		?>
	</select>
</form><br><br>
		
</div>

<div class ='col-sm-2' style="margin: auto; background-color:  #9A32CD; border-top: 2px solid #eee; border-bottom: 2px solid #eee; border-right: 2px solid #eee; border-radius: 0px 10px 10px 0px"><br><br>
<div style="color: white;">Average Rating: </div>
<div id="rate" style="color: white;"><?php 
		$connection = @new mysqli( /*removed*/ );
		$song = $_GET[ 'id' ];
		$stmt = $connection->prepare( 'SELECT rating FROM Song WHERE songid = ?' );
		$stmt->bind_param( 's',  $song);
		$stmt->execute();
		$stmt->bind_result( $rating );
		while($row = $stmt->fetch()){
		if( !is_null( $rating ) ){
		echo number_format( $rating, 1 );
		}
		else{	
		echo 0;
		}
		}
		$connection->close();
		$stmt->close();
		?></div> <br><br>
</div>
</div>
</div>

</div>
</div>

<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/chat.php'; ?>




<script type="text/javascript">
document.getElementById("music").addEventListener('play', incrementPlays);
var songid = window.location.search.substring( 4 );
var plays = document.getElementById("res").innerHTML;

function incrementPlays() {
    plays++;
    //Update the plays in the database
   $.ajax({
        type: 'POST',
        url: 'Scripts/update.php?',
        data: 'songI=' + songid + '&totplays=' + plays, 
        cache: false,
        error: function( e ){
        alert( e );
        },
        success: function( response4 ){
      	document.getElementById("res").innerHTML = response4;
        }
    }); 
}
</script>



<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php'; ?>

<!--SODGVGW12AC9075A8D-->

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src='http://cs445.cs.umass.edu/groups/clp/www/Scripts/updates.js'></script>