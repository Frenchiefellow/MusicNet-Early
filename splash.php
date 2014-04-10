<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/headerNoNav.php'; ?> 
<style>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/bs/css/splash.css'; ?>
</style> 


<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarSplash.php'; ?> 


<div class="jumbotron" id= "welcome" style="background-color: rgba(128, 128, 128, .6);">
      <div id = "splashContainer" class="container">
        <h1>Welcome to MusicNet!</h1>
        <p style = 'font-size: 150%;'>MusicNet is the premier Social Network for all your music needs! 
        We are a community of over a million music lovers and counting. Rate, play, and tag hundreds of thousands of your favorite songs.
        Don't have a hundred thousand favorite songs? No problem! MusicNet makes it easy to discover songs&mdash;from your favorite artist, a new artist, or even a genre you've never heard of.
        At MusicNet, we understand that there's more to music than just listening to music. Join today to find out why over a million other people choose MusicNet!</p>
        <p><a class="btn btn-warning btn-lg" role="button" href="http://cs445.cs.umass.edu/php-wrapper/clp/login.php">Sign Up!</a></p>
      </div>
</div> 


<div class="row desc">
        <div class="col-lg-4" style="margin-bottom: auto;">
          <img class="img-circle Cimg" src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/discover.jpg"));?>'>
          <h2 class="colHead">Discover New Music!</h2>
          <p class="colPar">With MusicNet, you never have to worry about listening to the same old songs. Discover all sorts of new songs to listen to!</p>
          <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-primary" href="http://cs445.cs.umass.edu/php-wrapper/clp/discover.php" role="button">Discover!</a></span>
        </div>

        <div class="col-lg-4" style="margin-bottom: auto;">
          <img class="img-circle Cimg" src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/concert.jpg"));?>'>
          <h2 class="colHead">Recommended for You!</h2>
          <p class="colPar">From the tags of songs that you liked, we crafted a list of other songs we think you might like too!</p>
          <span style="display:inline;"><a style = "padding:5px; margin:0;"  class="btn btn-primary" href="http://cs445.cs.umass.edu/php-wrapper/clp/login.php" role="button">Sign Up First!</a></span>
        </div>

        <div class="col-lg-4" style="margin-bottom: auto;">
          <img class="img-circle Cimg" src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/girl.jpg"));?>'>
          <h2 class="colHead">Connect With Friends!</h2>
          <p class="colPar">What's better than listening to music? Sharing it with your friends! Click here to connect with other MusicNet patrons.</p>
           <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-primary" href="http://cs445.cs.umass.edu/php-wrapper/clp/login.php" role="button">Sign Up First!</a></span style="display:inline;">
        </div>
      </div>
</div>



<?php include "/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php"; ?> 




