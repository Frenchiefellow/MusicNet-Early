<style><?php include '/courses/cs400/cs445/php-dirs/clp/www/bs/css/profile.css'; ?></style>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style = "margin-top: -2%;">      
<h1 class="page-header" style="margin-top: 2%;"><?php echo $_GET['user']; ?>: Profile</h1>
<div class="outline">

    <div class="row desc">

        <div class="col-lg-3 picholder profCol">
          <img class="profImg" src="data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/default.png"));?>">
          <h2 class="colHead"><?php echo $_GET['user']; ?></h2>
	  <div class="picboxinfo"> 
          <p class="colPar">Welcome to <?php echo $_GET['user']; ?>'s MusicNet Profile Page! </p>
          <p class="colPar">Here you can learn a little bit more about <?php echo $_GET['user']; ?>'s taste in music, and perhaps you'll find a common link! Take a look around, but don't be afraid to friend them. Don't 
		worry, its not creepy! We are all music lovers here! </p>
	  </div> 
	   <?php if($_SESSION['username'] == $_GET['user']){ echo '<p style="margin-top: 2%;"><a class="btn btn-success stupidButtonNotStupid" href="#" role="button">Friends!</a></p>';} 
 	   else{ echo '
	   <p style="margin-top: 2%; margin-right: 0 auto; margin-left: 0 auto;"><a class="btn btn-warning stupidButton" href="#" role="button">Friend Me!</a></p>';} ?>
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
						else if ( $gen == 0 ){
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
		<p class="colPara"> Songs Listened to:</p>
		<p class="colPara"> Songs Rated:</p>
	 	<p class="colPara"> Playlists Created: </p>
		<p class="colPara"> Friends: </p>
	</div><br>


        </div>
</div>
<h3 class='page-header listen'>Most Listened to </h3>

<div class="row desc">

	  <div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png"));?>'>
          <h2 class="colHeader">SONG NAME</h2>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Listen!</a></span>
        </div>

	  <div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png"));?>'>
          <h2 class="colHeader">SONG NAME</h2>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Listen!</a></span>
        </div>

	   <div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png"));?>'>
          <h2 class="colHeader">SONG NAME</h2>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Listen!</a></span>
        </div>

	   <div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png"));?>'>
          <h2 class="colHeader">SONG NAME</h2>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Listen!</a></span>
        </div>

	  <div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png"));?>'>
          <h2 class="colHeader">SONG NAME</h2>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Listen!</a></span>
        </div>
	 
	 <div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png"));?>'>
          <h2 class="colHeader">SONG NAME</h2>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Listen!</a></span>
        </div>


	
</div>


<h3 class='page-header listen'>Highest Rated: </h3> 

<div class ="row desc">
	
	<div class="row desc">
	<div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png"));?>'>
          <h2 class="colHeader">SONG NAME</h2>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Listen!</a></span>
        </div>

	  <div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png"));?>'>
          <h2 class="colHeader">SONG NAME</h2>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Listen!</a></span>
        </div>

	   <div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png"));?>'>
          <h2 class="colHeader">SONG NAME</h2>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Listen!</a></span>
        </div>

	   <div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png"));?>'>
          <h2 class="colHeader">SONG NAME</h2>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Listen!</a></span>
        </div>

	  <div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png"));?>'>
          <h2 class="colHeader">SONG NAME</h2>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Listen!</a></span>
        </div>
	 
	 <div class="col-lg-2 tuxedo">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/vinyl.png"));?>'>
          <h2 class="colHeader">SONG NAME</h2>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-success" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Listen!</a></span>
        </div>

	</div>

</div>
</div>

