<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/Scripts/checkUser.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/header.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/navbarProfile.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/sidePlaceHolder.php'; ?>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style='height: 100%'>
    <h1 class="page-header" style="float:left;"><?php if(isset($_GET['user'])){echo $_GET['user'];} else{ echo "undefined";}; ?>: Liked Playlists</h1>
  
    <div class="row" style="height: 100%">

    	<div class="col-sm-12" style="border: 2px solid #eee; height: 80%; border-radius: 10px; background-color: white;">
    	<?php
    		if( isset( $_GET[ 'id' ] ) ){

    			$id = $_GET[ 'id' ];
    			$user = $_GET[ 'user' ];
                //DB CONNECTION
				$stmt = $connection->prepare( 'SELECT playlistname FROM Playlist WHERE playlistid = ?' );
            	$stmt->bind_param( 's',  $id );
            	$stmt->execute();
            	$stmt->bind_result( $pname );
            	while ( $stmt->fetch() ){
                	echo '<a style ="float: left; margin-top: .2%; margin-left: 1.5%" href="http://avid.cs.umass.edu/projects/course-project/Musicnet/profilePlaylists.php?user=' . $user . '" class="btn btn-warning">Back</a><h3 class="page-header" style="text-align: center; padding-top: 5px; margin-right: 5%;">Playlist: ' . $pname . '</h3>' .
                	'<div style="background-color: #428bca; border: 0px solid; border-radius: 10px; height: 90%; margin-top: 1.5%; overflow: auto;">';
           		}
           		$stmt->close();


           		$stmt = $connection->prepare( 'SELECT songid FROM Contains WHERE playlistid = ?' );
            	$stmt->bind_param( 's',  $id );
            	$stmt->execute();
            	$stmt->bind_result( $ids );
            	$lists = array();
            	while ( $stmt->fetch() ){
                	array_push( $lists, $ids );
           		}
           		echo '<div style="padding-top: 10px;">';
            	if( count( $lists ) > 0 ){
           		for( $i = 0; $i < count( $lists ); $i++ ){

           			$stmt = $connection->prepare( 'SELECT title, rating FROM Song WHERE songid = ?' );
            		$stmt->bind_param( 's',  $lists[ $i ] );
            		$stmt->execute();
            		$stmt->bind_result( $name, $rate );
            		while ( $stmt->fetch() ){
            			 echo '<div class="row" style="padding-top: 0px; padding-left: 10px; padding-bottom: 10px; border: 2px solid #808080; background-color: #f5f5f5; border-radius: 10px; width: 90%; margin: auto; margin-top: .5%;">'.
                         '<div class="col-sm-3" style="padding-top: 7px;">' .
                         '<a class="btn btn-success" href="http://avid.cs.umass.edu/projects/course-project/Musicnet/song.php?id=' . $lists[ $i ] . '">Play!</a></div>' .
                         '<div class="col-sm-6" style="text-align: center; margin:auto; padding-top: 10px; font-size: 150%">' . $name . '</div>' .
                         '<div class="col-sm-3" style="text-align: center; padding-top: 10px; font-size: 150%">Rating: ' . $rate . '</div></div>';
            		}
           		}
    			echo '</div>';
            }
            else{
                echo '<h3 style="text-align: center;"> No Songs in Playlist!</h3>';
                echo '</div>';
            }
            $stmt->close();
            $connection->close();
    		}
    		else{
    			echo '<div style="background-color: #428bca; border: 0px solid; border-radius: 10px; height: 95%; margin-top: 1.5%; overflow: auto;">';

                //DB CONNECTION
            	$user = $_GET[ 'user' ];

           		$stmt = $connection->prepare( 'SELECT playlistid FROM PlayLikes WHERE loginacct = ?' );
            	$stmt->bind_param( 's',  $_SESSION[ 'username' ] );
            	$stmt->execute();
            	$stmt->bind_result( $ids );
            	$lists = array();
            	while ( $stmt->fetch() ){
                	array_push( $lists, $ids );
           		}
           		$stmt->close();

           

           		echo '<div style="padding-top: 10px;">';
            	if( count( $lists ) > 0 ){
           		for( $i = 0; $i < count( $lists ); $i++ ){

           			$stmt = $connection->prepare( 'SELECT playlistname, trackno FROM Playlist WHERE playlistid = ?' );
            		$stmt->bind_param( 's',  $lists[ $i ] );
            		$stmt->execute();
            		$stmt->bind_result( $name, $tracks );
            		while ( $stmt->fetch() ){
            			
                        
            			 echo '<div class="row" style="padding-top: 0px; padding-left: 10px; padding-bottom: 10px; border: 2px solid #808080; background-color: #f5f5f5; border-radius: 10px; width: 90%; margin: auto; margin-top: .5%;">'.
                         '<div class="col-sm-2" style="padding-top: 7px;">' .
                         '<a class="btn btn-success" href="http://avid.cs.umass.edu/projects/course-project/Musicnet/profilePlaylists.php?user=' . $user . '&id=' . $lists[ $i ] . '">Open!</a></div>' .
                         '<div class="col-sm-6" id="pname' .$i .'" style="text-align: center; margin:auto; padding-top: 10px; font-size: 150%">Name: ' . $name . '</div>' .
                         '<div class="col-sm-3" style="text-align: center; padding-top: 10px; font-size: 150%"> Tracks: ' . $tracks . '</div>'
                         ;
                         echo '<div class="col-sm-1" style="text-align: center; padding-top: 7px; right: 20px;"><a id="unlike' . $i . '" class="btn btn-success">Unlike!</a></div></div>';
            		}
            		$stmt->close();

            
            	
            		
            		echo "<script>$( '#unlike" . $i . "' ).click( function(){
	
					var name = $( '#pname" . $i . "' ).text().split('Name: ');

						$.ajax({
			                    type: 'POST',
			                    url: 'Scripts/update.php?',
			                    data: 'unlike=' + name[ 1 ] ,
			                    cache: false,
			                    error: function( e ){
			                    alert( e );
			                    },
			                    success: function( response2 ){
			                    alert( response2 );
			                    window.location.reload();
			                    }
			                }); 
			
				}); </script>";

            		

           		}

           		
    			echo '</div>';
            }
            else{
                echo '<h3 style="text-align: center;"> No Playlists!</h3>';
                echo '</div>';
            }
            $connection->close();
    	}
    	?>
    	</div>
    	</div>
    </div>

</div>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>


<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/sideBarProfile.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/bottombar.php'; ?>

