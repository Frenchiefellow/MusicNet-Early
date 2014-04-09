<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/headerNoNav.php'; ?> 
<style>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/bs/css/splash.css'; ?>
</style> 
<div>

<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarSplash.php'; ?> 


<div class="jumbotron" id= "welcome" style="background-color: rgba(128, 128, 128, .6);">
      <div id = "splashContainer" class="container">
        <h1>Welcome to MusicNet!</h1>

	 <!-- CONTENT INSIDE P TAG -->
        <p>MusicNet is the premier Social Network for all your music needs! Write a generic description here!</p>
        <p><a class="btn btn-warning btn-lg" role="button" href="http://cs445.cs.umass.edu/php-wrapper/clp/login.php" style="">Sign Up!</a></p>
      </div>
</div> 
<div class="container marketing">
<div class="row">
        <div class="col-lg-4">
          <img class="img-circle" src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/discover.jpg"));?>' style="width: 140px; height: 140px;">

          <h2>Discover New Music!</h2>
	   <!-- CONTENT INSIDE P TAG -->
          <p>Something about discovering new music</p>
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
          <img class="img-circle" src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/girl.jpg"));?>' style="width: 140px; height: 140px;">
          <h2>Connect With Friends!</h2>

	   <!-- CONTENT INSIDE P TAG -->
          <p>Something about connecting/making</p>
          <p><a class="btn btn-default" href="#" role="button">View details »</a></p>
        </div>
      </div>
</div>



<?php include "/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php"; ?> 

</div>


