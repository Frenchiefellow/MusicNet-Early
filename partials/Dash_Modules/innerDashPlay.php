<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header" style="float:left;"><?php if(isset($_GET['user'])){echo $_GET['user'];} else{ echo "undefined";}; ?>: Playlists</h1>
    <?php 
    	if( $_GET[ 'user' ] == $_SESSION[ 'username' ] ){
    		echo '<a style ="float: right; margin-top: .2%"; id="newplaylist" class="btn btn-warning">New</a>';
    	}

    ?>

    <div class="row">

    	
    	<div class="col-sm-12" style="border: 2px solid #eee; height: 80%; border-radius: 10px; background-color: white;">
    	<?php
    		if( isset( $_GET[ 'id' ] ) ){

    			$id = $_GET[ 'id' ];
    			$user = $_GET[ 'user' ];
    			$connection = @new mysqli( /*removed*/ );

				$stmt = $connection->prepare( 'SELECT playlistname FROM Playlist WHERE playlistid = ?' );
            	$stmt->bind_param( 's',  $id );
            	$stmt->execute();
            	$stmt->bind_result( $pname );
            	while ( $stmt->fetch() ){
                	echo '<a style ="float: left; margin-top: .2%; margin-left: 1.5%" href="http://cs445.cs.umass.edu/php-wrapper/clp/profilePlaylists.php?user=' . $user . '" class="btn btn-warning">Back</a><h3 class="page-header" style="text-align: center; padding-top: 5px; margin-right: 5%;">Playlist: ' . $pname . '</h3>' .
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
                         '<a class="btn btn-success" href="http://cs445.cs.umass.edu/php-wrapper/clp/song.php?id=' . $lists[ $i ] . '">Play!</a></div>' .
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
    			$connection = @new mysqli( /*removed*/ );
            	$user = $_GET[ 'user' ];
           		$stmt = $connection->prepare( 'SELECT playlistid FROM Created WHERE loginacct = ?' );
            	$stmt->bind_param( 's',  $user );
            	$stmt->execute();
            	$stmt->bind_result( $ids );
            	$lists = array();
            	while ( $stmt->fetch() ){
                	array_push( $lists, $ids );
           		}

           		echo '<div id="tableHolder" style="padding-top: 10px;">';
            	if( count( $lists ) > 0 ){
           		for( $i = 0; $i < count( $lists ); $i++ ){

           			$stmt = $connection->prepare( 'SELECT playlistname, trackno FROM Playlist WHERE playlistid = ?' );
            		$stmt->bind_param( 's',  $lists[ $i ] );
            		$stmt->execute();
            		$stmt->bind_result( $name, $tracks );
            		$names = array();
            		while ( $stmt->fetch() ){
            			 array_push( $names, $name );
            			 echo '<div class="row" id="row' . $i . '" style="padding-top: 0px; padding-left: 10px; padding-bottom: 10px; border: 2px solid #808080; background-color: #f5f5f5; border-radius: 10px; width: 90%; margin: auto; margin-top: .5%;">'.
                         '<div class="col-sm-2" style="padding-top: 7px;">' .
                         '<a class="btn btn-success" href="http://cs445.cs.umass.edu/php-wrapper/clp/profilePlaylists.php?user=' . $user . '&id=' . $lists[ $i ] . '">Open!</a></div>' .
                         '<div class="col-sm-6" id="pname' . $i . '" style="text-align: center; margin:auto; padding-top: 10px; font-size: 150%">Playlist Name: ' . $name . '</div>' .
                         '<div class="col-sm-2" style="text-align: center; padding-top: 10px; font-size: 150%"> Tracks: ' . $tracks . '</div>' .
                         '<div class="col-sm-1" style="text-align: center; padding-top: 7px;"><a id="delete' . $i . '" class="btn btn-danger">Delete</a></div>'
                         ;

            		}
            		$stmt->close();

            		
            		
            		$stmt = $connection->prepare( 'SELECT * FROM PlayLikes WHERE playlistid = ? AND loginacct = ?' );
            		$stmt->bind_param( 'ss',  $lists[ $i ], $_SESSION[ 'username' ] );
            		$stmt->execute();
            		$stmt->store_result();
            		if( $stmt->num_rows > 0 ){
            			echo '<div class="col-sm-1" style="text-align: center; padding-top: 7px;"><a id="unlike' . $i . '" class="btn btn-success">Unlike!</a></div></div>';
            		}
            		else{
            			echo '<div class="col-sm-1" style="text-align: center; padding-top: 7px;"><a id="like' . $i . '" class="btn btn-primary">Like!</a></div></div>';
            		}
            		$stmt->close();
            	
            		echo "<script>
            			$( '#like" . $i . "' ).click( function(){
	
						var name = $( '#pname" . $i . "' ).text().split('Playlist Name: ');
					
						
						$.ajax({
                    		type: 'POST',
                    		url: 'Scripts/update.php?',
                    		data: 'like=' + name[ 1 ] ,
                    		cache: false,
                    		error: function( e ){
                    		alert( e );
                    		},
                    		success: function( response2 ){
                    		alert( response2 );
                    		window.location.reload();
                    		}
                		}); 
			
						}); 

						$( '#delete" . $i . "' ).click( function(){
	
						var name = $( '#pname" . $i . "' ).text().split('Playlist Name: ');

								$.ajax({
					                    type: 'POST',
					                    url: 'Scripts/update.php?',
					                    data: 'delete=' + name[ 1 ] ,
					                    cache: false,
					                    error: function( e ){
					                    alert( e );
					                    },
					                    success: function( response2 ){
					                    alert( response2 );
					                    window.location.reload();
					                    }
					                }); 
								
						});

						$( '#unlike" . $i . "' ).click( function(){
	
						var name = $( '#pname" . $i . "' ).text().split('Playlist Name: ');

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
			
						});


					</script>";

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
<script type="text/javascript">
var numrow = $('#tableHolder').children().length;




$( '#newplaylist' ).click( function(){
			var name = prompt( "Please Enter a Name for the Playlist", "Playlist" );
			if(name != null){
			$.ajax({
                    type: 'POST',
                    url: 'Scripts/update.php?',
                    data: 'newpname=' + name + "&user=" + window.location.search.substring( 6 ),
                    cache: false,
                    error: function( e ){
                    alert( e );
                    },
                    success: function( response2 ){
                    alert( response2 );
                    window.location.reload();
                    }
                }); 
			}
});




</script>