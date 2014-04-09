<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/header.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarProfile.php'; ?>

<style>
body{
background-image: url('http://upload.wikimedia.org/wikipedia/commons/f/fd/Dr_Dog_Treasure_Island_Music_Festival.jpg');
}
</style>

<div class ='entire'>


<div class="jumbotron" id= "welcome" style="background-color: rgba(128, 128, 128, .5);">
      <div id = "splashContainer" class="container">
        <h1>Welcome, <?php echo ($_GET['user']); ?> to MusicNet!</h1>
	 
	<!-- CONTENT INSIDE P TAG -->
        <p>Information Here welcoming new user</p>
        <p><a class="btn btn-warning btn-lg" role="button" href="http://cs445.cs.umass.edu/php-wrapper/clp/profile.php" style="">Profile!</a></p>
      </div>
</div> 

<div class="container marketing">
<div class="row">

	<div class="col-lg-4">
          <img class="img-circle" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/home.png"));?>' style="width: 140px; height: 140px;">
          <h2>Check Out Your Profile!</h2>

	   <!-- CONTENT INSIDE P TAG -->
          <p>Something about your profile! Specifically, we have overview (subsection of stats), friends, playlists, and stats page via the profile</p>
          <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
        </div>

       <div class="col-lg-4">
          <img class="img-circle" src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/mic.jpg"));?>' style="width: 140px; height: 140px;">

	   <!-- CONTENT INSIDE P TAG -->
          <h2>Create Playlists!</h2>
          <p>Something about creating and sharing playlists!</p>
          <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
        </div>

    	<div class="col-lg-4">
          <img class="img-circle" src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/discover.jpg"));?>' style="width: 140px; height: 140px;">
          <h2>Discover New Music!</h2>

	   <!-- CONTENT INSIDE P TAG -->
          <p>Something about discovering new music!</p>
          <p><a class="btn btn-default" href="http://cs445.cs.umass.edu/php-wrapper/clp/discover.php" role="button">View details »</a></p>
        </div>

      </div>
</div>
</div>

<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php'; ?>