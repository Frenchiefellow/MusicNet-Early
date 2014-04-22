<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header"><?php if(isset($_GET['user'])){echo $_GET['user'];} else{ echo "undefined";}; ?>: Friends</h1>

    <div class="row" style="border: 2px solid;border-radius: 10px; padding-top: 1%;">
    <div class="col-sm-6" style="border-right: 2px solid; height: 80%;">
    <h3 class="page-header" style="text-align: center;">Following: </h3>
    <div style="background-color: #eee; border: 0px solid; border-radius: 10px; height: 90%; overflow: auto;">
    <?php
     		$connection = @new mysqli( /*removed*/ );
            $user = $_GET[ 'user' ];
            $stmt = $connection->prepare( 'SELECT loginacct2 FROM Friends WHERE loginacct1 = ?' );
            $stmt->bind_param( 's',  $user );
            $stmt->execute();
            $stmt->bind_result( $following );
            $follow = array();
             while ( $stmt->fetch() ){
                 array_push( $follow, $following );
            }
             echo '<div style="padding-top: 10px;">';
             if( count( $follow ) > 0 ){
            for( $i = 0; $i < count( $follow ); $i++ ){
                    echo '<div class="row" style="padding-top: 10px; padding-left: 10px; padding-bottom: 10px; border: 1px solid; width: 100% height: 100%; margin: auto;">'.
                         '<div class="col-sm-3" style="padding-top: 7px;">' .
                         '<a class="btn btn-success" href="http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $follow[ $i ] . '"><img src="http://cs445.cs.umass.edu/groups/clp/www/resources/images/default.png" style="width: 100%; height: 100px;" /></a></div>' .
                         '<div class="col-sm-9" style="text-align: center; margin:auto; padding-top: 7px;"><a class="btn btn-primary" style="width: 100%; height: 115px;" href="http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $follow[ $i ] . '"><h1>' . $follow[ $i ] . '</h1></a></div></div>';
       
                }
            	 echo '</div>';
            }
            else{
                echo '<h3 style="text-align: center;"> Not Following Anyone!</h3>';
            }

    ?>
    </div>
    </div>

    <div class="col-sm-6" style="height: 80%;">
    <h3 class="page-header" style="text-align: center;">Followers: </h3>
    <div style="background-color: #eee; border: 0px solid; border-radius: 10px; height: 90%; overflow: auto;">
     <?php
     		$connection = @new mysqli( /*removed*/ );
            $user = $_GET[ 'user' ];
            $stmt = $connection->prepare( 'SELECT loginacct2 FROM Friends WHERE loginacct2 = ?' );
            $stmt->bind_param( 's',  $user );
            $stmt->execute();
            $stmt->bind_result( $following );
            $follow = array();
             while ( $stmt->fetch() ){
                 array_push( $follow, $following );
            }
             echo '<div style="padding-top: 10px;">';
             if( count( $follow ) > 0 ){
            for( $i = 0; $i < count( $follow ); $i++ ){
                    echo '<div class="row" style="padding-top: 10px; padding-left: 10px; padding-bottom: 10px; border: 1px solid; width: 100% height: 100%; margin: auto;">'.
                         '<div class="col-sm-3" style="padding-top: 7px;">' .
                         '<a class="btn btn-success" href="http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $follow[ $i ] . '"><img src="http://cs445.cs.umass.edu/groups/clp/www/resources/images/default.png" style="width: 100%; height: 100px;" /></a></div>' .
                         '<div class="col-sm-9" style="text-align: center; margin:auto; padding-top: 7px;"><a class="btn btn-primary" style="width: 100%; height: 115px;" href="http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $follow[ $i ] . '"><h1>' . $follow[ $i ] . '</h1></a></div></div>';
       
                }
            	 echo '</div>';
            }
            else{
                echo '<h3 style="text-align: center;"> Not Followed By Anyone!</h3>';
            }

    ?>
    </div>
    </div>
</div>