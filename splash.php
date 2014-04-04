<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/headerNoNav.php'; ?> 
<style>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/bs/css/splash.css'; ?>
</style> 
<div>

<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarSplash.php'; ?> 

<?php
  $connection = mysql_connect(/*removed*/);
  if (!$connection){
    die ("Couldn't connect to mysql server!<br>The error was: " . mysql_error());
  }
  else{
    echo "Connection successful!<br>\n";
  }
?>

<div class="jumbotron" id= "welcome" style="background-color: rgba(128, 128, 128, .5);">
      <div id = "splashContainer" class="container">
        <h1>Welcome to MusicNet!</h1>
        <p>Information Here</p>
        <p><a class="btn btn-warning btn-lg" role="button" href="http://cs445.cs.umass.edu/php-wrapper/clp/login.php" style="">Sign Up!</a></p>
      </div>
</div> 
	<div class="container">

	</div>



<?php include "/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php"; ?> 

</div>


