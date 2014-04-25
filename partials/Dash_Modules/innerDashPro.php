

<style><?php include '/courses/cs400/cs445/php-dirs/clp/www/bs/css/profile.css'; ?></style>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style = "margin-top: -2%;">      
<h1 class="page-header" style="margin-top: 2%;"><?php echo $_GET['user']; ?>: Profile</h1>
<div class="outline">

    <div class="row desc">

        <div class="col-lg-3 picholder profCol">
        <?php
        	$them = $_GET[ 'user' ];
        	$you = $_SESSION[ 'username' ];
        	$connection = @new mysqli( /*removed*/ );
        	$stmt = $connection->prepare( 'SELECT FBid FROM User WHERE loginacct = ?' );
			$stmt->bind_param( 's',  $them );
			$stmt->execute();
			$stmt->bind_result( $id );
			$FB = '';
			while( $stmt->fetch() ){
				if( $id != NULL){
					$FB = $id;
				}
				else{
					$FB = '';
				}
			}
			
			if( $FB != ''){
				echo '<img class="profImg" id="picture" src="https://graph.facebook.com/' . $FB . '/picture?type=large">';
			}
			else{
				echo '<img class="profImg" id="picture" src="http://cs445.cs.umass.edu/groups/clp/www/resources/images/default.png">';
			}

			?>
       
          	<h2 class="colHead"><?php echo $_GET['user']; ?></h2>
	  	  	<div class="picboxinfo"> 
          	<p class="colPar">Welcome to <?php echo $_GET['user']; ?>'s MusicNet Profile Page! </p>
          	<p class="colPar">Here you can learn a little bit more about <?php echo $_GET['user']; ?>'s taste in music, and perhaps you'll find a common link! Take a look around, but don't be afraid to friend them. Don't 
						      worry, its not creepy! We are all music lovers here! </p>
	  		</div> 
	   
	   <?php 
	   	$you = $_SESSION[ 'username' ];
		$them = $_GET[ 'user' ];
	    $connection = @new mysqli( /*removed*/ );
		$stmt = $connection->prepare( 'SELECT * FROM Friends WHERE ( loginacct1 = ? AND loginacct2= ? )' );
		$stmt->bind_param( 'ss',  $you, $them );
		$stmt->execute();
		$stmt->store_result();
		$check = 0;
		$check2 = 0;
		if( $stmt->num_rows > 0 ){
			$check = 1;
		}
		$stmt->close();

		$stmt = $connection->prepare( 'SELECT * FROM Friends WHERE ( loginacct1 = ? AND loginacct2 = ? )' );
		$stmt->bind_param( 'ss', $them, $you );
		$stmt->execute();
		$stmt->store_result();
		if( $stmt->num_rows > 0 ){
			$check2 = 1;
		}
		$stmt->close();

		$check3;
		if( $check == 1 && $check2 == 1){
			$check3 = 3;
		}
		elseif( $check == 1 && $check2 == 0){
			$check3 = 1;
		}
		elseif( $check == 0 && $check2 == 1){
			$check3 = 2;
		}
		elseif( $check == 0 && $check2 == 0){
			$check3 = 0;
		}


	   if( isset( $_SESSION[ 'username' ] ) ){
	   if( $_SESSION[ 'username' ] == $_GET[ 'user' ] || $check3 == 1 ){ echo '<p style="margin-top: 2%;"><a class="btn btn-success stupidButtonNotStupid" href="#" role="button">Following!</a></p>';} 
 	 
	   else if( $check3 == 0 ) { 
	  	echo '<div id="Follow">'.
	   '<p style="margin-top: 2%; margin-right: 0 auto; margin-left: 0 auto;"><p class="btn btn-warning stupidButton" id="friend" role="button">Follow Me!</p></p></div>';
	   }
	  else if( $check3 == 2) { 
	  echo '<div id="Following">'.
	   '<p style="margin-top: 2%; margin-right: 0 auto; margin-left: 0 auto;"><p class="btn btn-warning stupidButton" id="friend" role="button">Following You!</p></p></div>';
	   }
	   else if( $check3 == 3 ) { 
	  echo '<div>'.
	   '<p style="margin-top: 2%; margin-right: 0 auto; margin-left: 0 auto;"><p class="btn btn-warning stupidButton" role="button">Followers!</p></p></div>';
	   }


	   else { echo '
	   <p style="margin-top: 2%; margin-right: 0 auto; margin-left: 0 auto;"><a class="btn btn-danger stupidButton" href="http://cs445.cs.umass.edu/php-wrapper/clp/login.php" role="button">Sign Up!</a></p>';
		} 
	}
	?>

        </div>

        <div class="col-lg-8 aboutbox profCol">
	 <h2 class="aboutitle colHead">About <?php echo $_GET['user']; ?>:</h2>
	 <h3 class="coltitle">Basic Information:</h3>
	 <div class="outlineAbout">
		<p class="colPara"> Name: 	<?php 
					    	$connection = @new mysqli( /*removed*/ );
						$song = $_GET[ 'user' ];
						$stmt = $connection->prepare( 'SELECT username FROM User WHERE loginacct = ?' );
						$stmt->bind_param( 's',  $_GET['user']);
						$stmt->execute();
						$stmt->bind_result( $username );
						while ( $stmt->fetch() ){
						echo $username;
						}
						?></p>
	 	<p class="colPara"> Age:	<?php 
					    	$connection = @new mysqli( /*removed*/ );
						$song = $_GET[ 'user' ];
						$stmt = $connection->prepare( 'SELECT age FROM User WHERE loginacct = ?' );
						$stmt->bind_param( 's',  $_GET['user']);
						$stmt->execute();
						$stmt->bind_result( $age );
						while ( $stmt->fetch() ){
						if ( $age == 0)
						echo 'Not Provided';
						else
						echo $age;
						}
						?></p> </p>
        	<p class="colPara"> Gender: <?php 
					    	$connection = @new mysqli( /*removed*/ );
						$song = $_GET[ 'user' ];
						$stmt = $connection->prepare( 'SELECT ismale FROM User WHERE loginacct = ?' );
						$stmt->bind_param( 's',  $_GET['user']);
						$stmt->execute();
						$stmt->bind_result( $gen );
						while ( $stmt->fetch() ){
						if( $gen == 1 ){
						echo 'Male';
						}
						else if ( is_null( $gen ) ) {
						echo 'No Answer';
						}
						else {
						echo 'Female';
						}
						}
						?></p> </p>
	 	<p class="colPara"> Location:<?php 
					    	$connection = @new mysqli( /*removed*/ );
						$song = $_GET[ 'user' ];
						$stmt = $connection->prepare( 'SELECT userloc FROM User WHERE loginacct = ?' );
						$stmt->bind_param( 's',  $_GET['user']);
						$stmt->execute();
						$stmt->bind_result( $loc );
						while ($stmt->fetch()){
						if( $loc != '' )
						echo ' ' . $loc;
						else
						echo ' Not Provided';
						}
						?></p> </p>  
        </div><br>
	<h3 class="coltitle">Music Net Information:</h3>
	<div class="outlineAbout">
		<p class="colPara"> Songs Listened to: <?php 
					    	$connection = @new mysqli( /*removed*/ );
						$song = $_GET[ 'user' ];
						$stmt = $connection->prepare( 'SELECT count( plays ) FROM UserInteraction  WHERE loginacct = ? AND plays > 0' );
						$stmt->bind_param( 's',  $_GET['user']);
						$stmt->execute();
						$stmt->bind_result( $plays );
						while ($stmt->fetch()){
						if( $plays != 0 )
						echo ' ' . $plays;
						else
						echo 0;
						}
						?></p>
		<p class="colPara"> Songs Rated: <?php 
					    	$connection = @new mysqli( /*removed*/ );
						$song = $_GET[ 'user' ];
						$stmt = $connection->prepare( 'SELECT ratings FROM User WHERE loginacct = ?' );
						$stmt->bind_param( 's',  $_GET['user']);
						$stmt->execute();
						$stmt->bind_result( $rates );
						while ($stmt->fetch()){
						if( $rates != 0 )
						echo ' ' . $rates;
						else
						echo 0;
						}
						?></p>
	 	<p class="colPara"> Playlists Created: <?php 
					    	$connection = @new mysqli( /*removed*/ );
						$song = $_GET[ 'user' ];
						$stmt = $connection->prepare( 'SELECT count(*) FROM Created WHERE loginacct = ?' );
						$stmt->bind_param( 's',  $_GET['user']);
						$stmt->execute();
						$stmt->bind_result( $playlists );
						while ($stmt->fetch()){
						if( $playlists != '' )
						echo ' ' . $playlists;
						else
						echo 0;
						}
						?></p>
		<p class="colPara"> Followers: <?php 
					    	$connection = @new mysqli( /*removed*/ );
						$song = $_GET[ 'user' ];
						$stmt = $connection->prepare( 'SELECT count(*) FROM Friends WHERE loginacct2= ?' );
						$stmt->bind_param( 's',  $_GET['user'] );
						$stmt->execute();
						$stmt->bind_result( $friends );
						while ($stmt->fetch()){
						if( $friends != '' )
						echo ' ' . $friends;
						else
						echo 0;
						}
						?></p>
	</div><br>


        </div>
</div>
<h3 class='page-header listen'>Most Listened to </h3>

<div class="row desc">
	<?
		$connection = @new mysqli( /*removed*/ );
        $user = $_GET[ 'user' ];
        $stmt = $connection->prepare( 'SELECT songid FROM UserInteraction WHERE loginacct = ? and plays > 0 ORDER BY plays LIMIT 6' );
        $stmt->bind_param( 's',  $user );
        $stmt->execute();
        $stmt->bind_result( $songs );
        $arr = array();
        while ( $stmt->fetch() ){
            array_push( $arr, $songs );
        }

        if( count( $arr ) > 0 ){

        	$size = ( ( 12 - ( count( $arr ) * 2 ) ) / 2 );

            if( $size != 0 ){
           		echo '<div class="col-lg-' . $size . ' tuxedo"></div>';
            }
             for( $i = 0; $i < count( $arr ); $i++ ){
                $stmt = $connection->prepare( 'SELECT title FROM Song WHERE songid = ?' );
                $stmt->bind_param( 's',  $arr[ $i ] );
                $stmt->execute();
                $stmt->bind_result( $title );
                while ( $stmt->fetch() ){
                    echo '<div class="col-lg-2 tuxedo">'.
         				 '<img class="img-circle Cimg" src="http://cs445.cs.umass.edu/groups/clp/www/resources/images/vinyl.png" />' .
         				 '<h2 class="colHeader">' . $title . '</h2>' .
          				 '<span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="http://cs445.cs.umass.edu/php-wrapper/clp/song.php?id=' . $arr[ $i ] . '" role="button">Listen!</a></span>' .
       					 '</div>';
                }
            }

            if( $size != 0 ){
            	echo '<div class="col-lg-' . $size . ' tuxedo"></div>';
            }
        }

        else{
        	echo '<h2 style="text-align: center">No Songs Played!</h2>';
        
        }

  
            
    ?>
	 
</div>


<h3 class='page-header listen'>Highest Rated: </h3> 

<div class ="row desc">
	
	<div class="row desc">
	<?
		$connection = @new mysqli( /*removed*/ );
        $user = $_GET[ 'user' ];
        $stmt = $connection->prepare( 'SELECT songid FROM UserInteraction WHERE loginacct = ? and rating > 0 ORDER BY rating desc LIMIT 6' );
        $stmt->bind_param( 's',  $user );
        $stmt->execute();
        $stmt->bind_result( $songs );
        $arr = array();
        while ( $stmt->fetch() ){
            array_push( $arr, $songs );
        }
            if( count( $arr ) > 0 ){

        	$size = ( ( 12 - ( count( $arr ) * 2 ) ) / 2 );

            if( $size != 0 ){
           		echo '<div class="col-lg-' . $size . ' tuxedo"></div>';
            }
             for( $i = 0; $i < count( $arr ); $i++ ){
                $stmt = $connection->prepare( 'SELECT title FROM Song WHERE songid = ?' );
                $stmt->bind_param( 's',  $arr[ $i ] );
                $stmt->execute();
                $stmt->bind_result( $title );
                while ( $stmt->fetch() ){
                    echo '<div class="col-lg-2 tuxedo">'.
         				 '<img class="img-circle Cimg" src="http://cs445.cs.umass.edu/groups/clp/www/resources/images/vinyl.png" />' .
         				 '<h2 class="colHeader">' . $title . '</h2>' .
          				 '<span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="http://cs445.cs.umass.edu/php-wrapper/clp/song.php?id=' . $arr[ $i ] . '" role="button">Listen!</a></span>' .
       					 '</div>';
                }
            }

            if( $size != 0 ){
            	echo '<div class="col-lg-' . $size . ' tuxedo"></div>';
            }
        }
            else{
            	echo '<h2 style="text-align: center">No Songs Played!</h2>';
            	echo '</div>';
            }

  
            
    ?>

	</div>

</div>
</div>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript">
$( '#friend' ).click( function(){
	$.ajax({
                    type: 'POST',
                    url: 'Scripts/addFriends.php?',
                    data: 'user=' + window.location.search.substring( 6 ),
                    cache: false,
                    error: function( e ){
                    alert( e );
                    },
                    success: function( response2 ){
                    alert( response2 );
                    var html = '<p style="margin-top: 2%;"><a class="btn btn-success stupidButtonNotStupid" href="#" role="button">Following!</a></p>';
                    var html2 = '<p style="margin-top: 2%; margin-right: 0 auto; margin-left: 0 auto;"><p class="btn btn-warning stupidButton" role="button">Followers!</p></p></div>';
                    if( $("#Follow").length ) {
                    document.getElementById( 'Follow' ).innerHTML = html;
                	}
                	if( $("#Following").length ) {
                    document.getElementById( 'Following' ).innerHTML = html2;
               		 }
                    }
                }); 
});


</script>

<script>
/*
var src = 'https://graph.facebook.com/' + localStorage.getItem( 'profID' ) + '/picture?type=large';
$(document).ready(function(){
	$('#picture').attr('src', src);
});*/

</script>
