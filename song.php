
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


<div style="height: 75%; ">
<div class="jumbotron" style="position: relative; text-align: center; margin: auto; overflow: hidden; width: 100; height: 240px; background-color: rgba(128, 128, 128, .7);">
<div style="border: 10px solid black; height: 120px; border-radius: 10px; background-color: black;">
<div style="height: 134px;">
<div class="col-sm-2" style="margin: auto; background-color: #FC1501; border-left: 2px solid #eee; border-top: 2px solid #eee; border-bottom: 2px solid #eee; border-radius: 10px 0px 0px 10px; height: 134px;"><br><br>
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
	echo '<div class="col-sm-2" style="background-color: #FFFF00; border-top: 2px solid #eee; border-bottom: 2px solid #eee; height: 134px">';
	echo '<a onclick="updatePlaylists(\'' . $id . '\')"><img src="http://cs445.cs.umass.edu/groups/clp/www/resources/images/button.png" style="width=80px; height: 80px;"></a><br>';
	echo '<a onclick="updatePlaylists(\'' . $id . '\')" class="btn btn-success">Add to Playlist!</a>'; 
}
else{
	echo '<div class="col-sm-2" style="background-color: #FFFF00; border-top: 2px solid #eee; border-bottom: 2px solid #eee; height: 134px">';
	echo "<br><br><a href='http://cs445.cs.umass.edu/php-wrapper/clp/splash.php' class='btn btn-warning'>Log In to <br> Add to Playlist!</a><br><br>";
}
?>

</div>
<div class="col-sm-4" id="sHold" style="background-color: #4EEE94; padding-bottom: 5px; border-top: 2px solid #eee; border-bottom: 2px solid #eee;">
<div id="songname"><?php 
		$connection = @new mysqli( /*removed*/ );
		$song = $_GET[ 'id' ];
		$stmt = $connection->prepare( 'SELECT title FROM Song WHERE songid = ?' );
		$stmt->bind_param( 's',  $song );
		$stmt->execute();
		$stmt->bind_result( $title );
		while($row = $stmt->fetch()){
		echo substr( $title, 0 , 50) . " by:  <a href='http://cs445.cs.umass.edu/php-wrapper/clp/artist.php?id="; 
		}
		$stmt = $connection->prepare( 'SELECT A.artistname, A.artistid FROM Artist A, Linked_To L WHERE L.songid = ? AND L.artistid = A.artistid' );
		$stmt->bind_param( 's',  $song );
		$stmt->execute();
		$stmt->bind_result( $name, $aID );
		while($row = $stmt->fetch()){
		echo $aID . "'>" .  substr( $name, 0 , 20) . "</a>";
		}


		?></div>
<div id='player'>
</div>
<div><?php 
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
		echo '<div class="col-sm-2" style="background-color: #007FFF; height: 134px; border-top: 2px solid #eee; border-bottom: 2px solid #eee; "><br>';
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
			echo '<div class="col-sm-2" style="background-color: #007FFF; height: 134px; border-top: 2px solid #eee; border-bottom: 2px solid #eee; "><br>';
			echo "<br><a href='http://cs445.cs.umass.edu/php-wrapper/clp/splash.php' class='btn btn-warning'>Log In to Rate!</a>";
		}
		?>
	</select>
</form><br><br>
		
</div>

<div class ='col-sm-2' style="margin: auto; background-color:  #9A32CD; border-top: 2px solid #eee; border-bottom: 2px solid #eee; border-right: 2px solid #eee; border-radius: 0px 10px 10px 0px; height: 134px;"><br><br>
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
<?php
	$connection = @new mysqli( /*removed*/ );
	$stmt = $connection->query( 'SELECT songid FROM Song ORDER BY rand() LIMIT 1' );
	while( $row = $stmt->fetch_assoc() ){
		echo '<br><a class="btn btn-danger" style=" margin-top: .3%;" href="http://cs445.cs.umass.edu/php-wrapper/clp/song.php?id=' . $row[ 'songid' ] . '">Random Song!</a>';
	}
	$stmt->close();
	$connection->close();


?>
</div>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/earth.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/lyrics.php'; ?>
</div>

<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/chat.php'; ?>




<script type="text/javascript">
function fetchSpotify() {
    var songname = $('#songname').text().split(' by: ');


  
    $.ajax({
        type: 'GET',
        url: 'http://ws.spotify.com/search/1/track.json?q=' + songname[0].replace(/[^A-Za-z0-9 ]/, "").toLowerCase(),
        error: function (e) {

        },
        success: function (resp) {
        	console.dir(resp);
            var title;
            if (songname[1].indexOf(";") > -1) {
                title = songname[1].substring(1, songname[1].indexOf(';'));
            } else {
                title = songname[1].substring(1, songname[1].length).replace(/[^A-Za-z0-9 ]/, "");
            }
                 
            var link;
            
            for (var i = 0; i < resp['tracks'].length; i++) {
            	
            	title.toLowerCase()
                if (resp['tracks'][i]['artists'][0]['name'].replace(/[^A-Za-z0-9 ]/, "").toLowerCase() === title.toLowerCase()) {
                    link = resp['tracks'][i]['href'];
                    break;
                }
            }
            if (link != null) {


                var node = document.createElement('iframe');
                node.id = 'spot';
                node.setAttribute('style', 'width: 100%;');
                node.setAttribute('height', '80');
                node.setAttribute('z-index', '2');
                node.setAttribute('name', 'spty');
                node.setAttribute('src', 'https://embed.spotify.com/?uri=' + link);
                node.setAttribute('frameborder', '0');
                node.setAttribute('autoplay', '1');
                node.setAttribute('allowtransparency', 'true');

                var textnode = document.createTextNode("");
                node.appendChild(textnode);

                document.getElementById('player').appendChild(node);

                incrementPlay();



            } else {
            	
                $.ajax({
                    type: 'GET',
                    url: 'http://ws.spotify.com/search/1/track.json?q=' + songname[0].replace(/[^A-Za-z0-9 ]/, "").toLowerCase(),
                    error: function (e) {

                    },
                    success: function (resp) {

                        var title = songname[1].substring(1, songname[1].length).replace(/[^A-Za-z0-9 ]/, "");


                        var link;
                        for (var i = 0; i < resp['tracks'].length; i++) {
                            if (resp['tracks'][i]['artists'][0]['name'].replace(/[^A-Za-z0-9 ]/, "").toLowerCase() === title.replace(/[^A-Za-z0-9 ]/, "").toLowerCase()) {
                                link = resp['tracks'][i]['href'];
                                break;
                            }
                        }
                        if (link != null) {


                            var node = document.createElement('iframe');
                            node.id = 'spot';
                            node.setAttribute('style', 'width: 100%;');
                            node.setAttribute('height', '80');
                            node.setAttribute('z-index', '2');
                            node.setAttribute('name', 'spty');
                            node.setAttribute('src', 'https://embed.spotify.com/?uri=' + link);
                            node.setAttribute('frameborder', '0');
                            node.setAttribute('autoplay', '1');
                            node.setAttribute('allowtransparency', 'true');

                            var textnode = document.createTextNode("");
                            node.appendChild(textnode);

                            document.getElementById('player').appendChild(node);

                            incrementPlay();

                        } else {
                            var t;
                            if (songname[1].indexOf(";") > -1) {
                                t = songname[1].substring(0, songname[1].indexOf(';'));
                            } else {
                                t = songname[1].substring(1, songname[1].length).replace(/[^A-Za-z0-9 ]/, "");
                            }


                            $.ajax({
                                type: 'GET',
                                url: 'http://ws.spotify.com/search/1/track.json?q=' + songname[0].replace(/[^A-Za-z0-9 ]/, "").toLowerCase() + " " + t,
                                error: function (e) {

                                },
                                success: function (resp) {
                                    var title;
                                    if (songname[1].indexOf(";") > -1) {
                                        title = songname[1].substring(1, songname[1].indexOf(';'));
                                    } else {
                                        title = songname[1].substring(1, songname[1].length).replace(/[^A-Za-z0-9 ]/, "");
                                    }
                                    var link;
                                    for (var i = 0; i < resp['tracks'].length; i++) {
                                        if (resp['tracks'][i]['artists'][0]['name'].replace(/[^a-z0-9]+|\s+/gmi, " ").toLowerCase().indexOf(title.toLowerCase()) > -1) {
                                            link = resp['tracks'][i]['href'];
                                            break;
                                        }
                                    }
                                    if (link != null) {


                                        var node = document.createElement('iframe');
                                        node.id = 'spot';
                                        node.setAttribute('style', 'width: 100%;');
                                        node.setAttribute('height', '80');
                                        node.setAttribute('z-index', '2');
                                        node.setAttribute('name', 'spty');
                                        node.setAttribute('src', 'https://embed.spotify.com/?uri=' + link);
                                        node.setAttribute('frameborder', '0');
                                        node.setAttribute('autoplay', '1');
                                        node.setAttribute('allowtransparency', 'true');

                                        var textnode = document.createTextNode("");
                                        node.appendChild(textnode);

                                        document.getElementById('player').appendChild(node);

                                        incrementPlay();



                                    } else {
                                        var node = document.createElement('audio');
                                        node.id = 'music';
                                        node.setAttribute('type', 'audio/mpeg');
                                        node.setAttribute('style', 'width: 100%; height: 60px;');
                                        node.setAttribute('src', 'http://cs445.cs.umass.edu/groups/clp/www/resources/sounds/nosong.ogg');
                                        node.setAttribute('controls', '');
                                        var textnode = document.createTextNode("Your browser does not support this audio format.");
                                        node.appendChild(textnode);
                                        document.getElementById('player').appendChild(node);
                                        $('#player').after('<br>');

                                        document.getElementById("music").addEventListener('play', incrementPlays);
                                        var songid = window.location.search.substring(4);
                                        var plays = document.getElementById("res").innerHTML;




                                        function incrementPlays() {
                                            plays++;
                                            //Update the plays in the database
                                            $.ajax({
                                                type: 'POST',
                                                url: 'Scripts/update.php?',
                                                data: 'songI=' + songid + '&totplays=' + plays,
                                                cache: false,
                                                error: function (e) {
                                                    alert(e);
                                                },
                                                success: function (response4) {
                                                    document.getElementById("res").innerHTML = response4;
                                                }
                                            });
                                        }

                                    }
                                }
                            });
                        }
                    }

                });

            }
        }
    });
}


$(document).ready(function () {
    fetchSpotify();

});
</script>
<script type="text/javascript">
function incrementPlay() {
			var songid = window.location.search.substring( 4 );
			var plays = document.getElementById("res").innerHTML;

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