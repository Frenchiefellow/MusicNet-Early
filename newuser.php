<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/header.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarProfile.php'; ?>

<style>
body{
background-image: url('http://upload.wikimedia.org/wikipedia/commons/f/fd/Dr_Dog_Treasure_Island_Music_Festival.jpg');
}
.colHead {
color: white;
margin-left: 1%; 
text-align: center; 
text-shadow: -1px 0 black, 0 2px black, 2px 0 black, 0 -1px black;
}

.colPar{
color: white; 
text-align: center; 
text-shadow: -1px 0 black, 0 2px black, 2px 0 black, 0 -1px black; 
font-size: 125%;
}
</style>


<div class="jumbotron"  style="background-color: rgba(128, 128, 128, .5); margin-top: -2%;">
      <div id = "splashContainer" class="container">
        <h1>Welcome to MusicNet, <?php echo ($_GET['user']); ?>!</h1>
        <p>Congratulations <?php echo ($_GET['user']); ?>!
        You've just joined a community of over a million music lovers and counting. You can rate, play, and tag hundreds of thousands of your favorite songs.
        Don't have a hundred thousand favorite songs? No problem! You'll discover all of the things MusicNet has to offer&mdash;from your favorite songs, 
        a new artist, or even a genre you've never heard of. At MusicNet, we understand that there's more to music than just listening to music. 
        Scroll down to explore all that MusicNet has to offer!</p>
        <p><a class="btn btn-warning btn-lg" role="button" href="http://cs445.cs.umass.edu/php-wrapper/clp/profile.php" style="">Profile!</a></p>
      </div>
</div> 


<div class="row" style="margin-top: 5%; margin-left: .5%; width: 99%">

  <div class="col-lg-4" style="margin-bottom: 5%;">
          <img class="img-circle" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/home.png"));?>' style="width: 200px; height: 200px; margin-left: 33%;">
          <h2 class="colHead">Check Out Your Profile!</h2>
          <p class="colPar">What does your music say about you? View the songs you listened to, friends you added, and playlists you created, in your profile.</p>
          <p><a style="margin-left: 42%;" class="btn btn-primary" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Profile!</a></p>
        </div>

       <div class="col-lg-4" style="margin-bottom: 5%;">
          <img class="img-circle" src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/mic.jpg"));?>' style="width: 200px; height: 200px; margin-left: 35%;">
          <h2 class="colHead">Create Playlists!</h2>
          <p class="colPar">Looking for that perfect combination of tunes to get you through your homework? 
          Click here to create, share, and discover great playlists!</p>
          <p><a style="margin-left: 42%;" class="btn btn-primary" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profilePlaylists.php?user=' . $_SESSION['username'];?>" role="button">Playlists!</a></p>
        </div>

      <div class="col-lg-4" style="margin-bottom: 5%;">
          <img class="img-circle" src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/discover.jpg"));?>' style="width: 200px; height: 200px; margin-left: 33%;">
          <h2 class="colHead">Discover New Music!</h2>
          <p class="colPar">You'll never have to worry about listening to the same old songs again, <?php echo ($_GET['user']); ?>!. Discover to find all sorts of new songs to listen to!</p>
          <p><a style="margin-left: 42%;" class="btn btn-primary" href="http://cs445.cs.umass.edu/php-wrapper/clp/discover.php" role="button">Discover!</a></p>
        </div>
  </div>
      </div>



<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php'; ?>