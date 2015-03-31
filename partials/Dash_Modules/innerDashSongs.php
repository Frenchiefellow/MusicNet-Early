<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style='height: 100%'>
    <h1 class="page-header"><?php if(isset($_GET['user'])){echo $_GET['user'];} else{ echo "undefined";}; ?>: Songs</h1>

    <div class="row" style="height: 70%">

    	<!-- Column for Songs with Plays -->
    	<div class="col-sm-6" style="border: 2px solid; height: 100%; border-radius: 10px;">
    	<h3 class="page-header" style="text-align:center;">Songs Played:</h3>
    	<div style="height: 80%; overflow: auto;">
    	<?php
            //DB connection
            $user = $_GET[ 'user' ];
            $stmt = $connection->prepare( 'SELECT songid FROM UserInteraction WHERE loginacct = ? and plays > 0' );
            $stmt->bind_param( 's',  $user );
            $stmt->execute();
            $stmt->bind_result( $songs );
            $arr = array();
            while ( $stmt->fetch() ){
                 array_push( $arr, $songs );
            }
            echo '<div style="padding-top: 10px;">';
            if( count( $arr ) > 0 ){
            for( $i = 0; $i < count( $arr ); $i++ ){
                $stmt = $connection->prepare( 'SELECT title, playcount FROM Song WHERE songid = ?' );
                $stmt->bind_param( 's',  $arr[ $i ] );
                $stmt->execute();
                $stmt->bind_result( $title, $plays );
                while ( $stmt->fetch() ){
                 
                    if( ($i + 1) % 2 === 0)
                        echo '<div class="row" style="padding-top: 10px; padding-left: 10px; padding-bottom: 10px; border: 1px solid; width: 100% height: 100%; margin: auto; background-color: #eee">';
                    else
                        echo '<div class="row" style="padding-top: 10px; padding-left: 10px; padding-bottom: 10px; border: 1px solid; width: 100% height: 100%; margin: auto; background-color: #aaa">';

                    echo '<div class="col-sm-3" style="padding-top: 7px;">' .
                         '<a class="btn btn-success" href="http://avid.cs.umass.edu/projects/course-project/Musicnet/song.php?id=' . $arr[ $i ] . '">Play!</a></div>' .
                         '<div class="col-sm-6" style="text-align: center; margin:auto; padding-top: 7px;">' . $title . '</div>' .
                         '<div class="col-sm-3" style="text-align: center; padding-top: 7px;"> Plays: ' . $plays . '</div></div>';

                }
            }
            echo '</div>';
            }
            else{
                echo '<h3 style="text-align: center;"> No Songs Played!</h3>';
            }
    	//For Each song with Plays > 0 where loginacct = this
    		// Create a row with 3 columns for an icon with a link to the song (play button), the name of song, and the the number of plays
    	?>	
    	</div>
    	</div>


    	<!-- Column for Songs with Ratings -->
    	<div class="col-sm-6" style="border: 2px solid; height: 100%; border-radius: 10px;">
    	<h3 class="page-header"  style="text-align:center;">Songs Rated:</h3>	
    	<div style="height: 80%; overflow: auto;">
    	<?php
            //DB connection
            $user = $_GET[ 'user' ];
            $stmt = $connection->prepare( 'SELECT songid FROM UserInteraction WHERE loginacct = ? and rating > 0' );
            $stmt->bind_param( 's',  $user );
            $stmt->execute();
            $stmt->bind_result( $songs );
            $arr = array();
            while ( $stmt->fetch() ){
                 array_push( $arr, $songs );
            }
             echo '<div style="padding-top: 10px;">';
            if( count( $arr ) > 0 ){
            for( $i = 0; $i < count( $arr ); $i++ ){
                $stmt = $connection->prepare( 'SELECT title, rating FROM Song WHERE songid = ?' );
                $stmt->bind_param( 's',  $arr[ $i ] );
                $stmt->execute();
                $stmt->bind_result( $title, $plays );
               
                while ( $stmt->fetch() ){
                      if( ($i + 1) % 2 === 0)
                        echo '<div class="row" style="padding-top: 10px; padding-left: 10px; padding-bottom: 10px; border: 1px solid; width: 100% height: 100%; margin: auto; background-color: #eee">';
                    else
                        echo '<div class="row" style="padding-top: 10px; padding-left: 10px; padding-bottom: 10px; border: 1px solid; width: 100% height: 100%; margin: auto; background-color: #aaa">';

                    echo '<div class="col-sm-3" style="padding-top: 7px;">' .
                         '<a class="btn btn-success" href="http://avid.cs.umass.edu/projects/course-project/Musicnet/song.php?id=' . $arr[ $i ] . '">Play!</a></div>' .
                         '<div class="col-sm-6" style="text-align: center; margin:auto; padding-top: 7px;">' . $title . '</div>' .
                         '<div class="col-sm-3" style="text-align: center; padding-top: 7px;"> Rating: ' . $plays . '</div></div>';
                }
            }
            echo '</div>';
            }
            else{
                echo '<h3 style="text-align: center;"> No Songs Rated!</h3>';
            }
        //For Each song with Plays > 0 where loginacct = this
            // Create a row with 3 columns for an icon with a link to the song (play button), the name of song, and the the number of plays
        ?>  
    	</div>
    	</div>

    </div>
</div>