<?php
$name = $_SERVER[ 'REQUEST_URI' ];
if ( strpos( $name, 'discover.php' ) ) {
echo ' <div class="col-sm-3 col-md-2 sidebar2" >';
}
elseif ( strpos( $name, 'recommend.php' ) ) {
echo ' <div class="col-sm-3 col-md-2 sidebar2" >';
}
else{
echo ' <div class="col-sm-3 col-md-2 sidebar">';
}
?>
          <ul class="nav nav-sidebar">
	    <li>.</li>
	    <?php 
	    $name = $_SERVER[ 'REQUEST_URI' ];
	    if ( strpos( $name, 'discover.php' ) ){ echo '
	    <li><a class="btn btn-primary" href="'; $url = "http://avid.cs.umass.edu/projects/course-project/Musicnet/discover.php"; echo $url; echo '">Discover New Music!</a></li>';} ?>

          </ul>
    
        </div>