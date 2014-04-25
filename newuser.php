<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/header.php'; ?>
<style>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/bs/css/newuser.css'; ?>
</style>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarProfile.php'; ?>




<div class="jumbotron topfit">
      <div id = "splashContainer" class="container">
      <?php if( strpos( $_GET[ 'user' ], '_FB' ) ){

        echo '<h1>Welcome to MusicNet, ' . preg_replace( "/_FB/", "", $_GET['user'] ) . '!</h1>' .
        '<p>Congratulations ' .  preg_replace( "/_FB/", "", $_GET['user'] ) . '!' .
        "You've just joined a community of over a million music lovers and counting, all via Facebook! You can rate, play, and tag hundreds of thousands of your favorite songs.
        Don't have a hundred thousand favorite songs? No problem! You'll discover all of the things MusicNet has to offer&mdash;from your favorite songs, 
        a new artist, or even a genre you've never heard of. At MusicNet, we understand that there's more to music than just listening to music. 
        Scroll down to explore all that MusicNet has to offer!</p>";
        }
        else{
        echo '<h1>Welcome to MusicNet, ' . $_GET['user'] . '!</h1>' .
        '<p>Congratulations ' . $_GET['user'] . '!' .
        "You've just joined a community of over a million music lovers and counting. You can rate, play, and tag hundreds of thousands of your favorite songs.
        Don't have a hundred thousand favorite songs? No problem! You'll discover all of the things MusicNet has to offer&mdash;from your favorite songs, 
        a new artist, or even a genre you've never heard of. At MusicNet, we understand that there's more to music than just listening to music. 
        Scroll down to explore all that MusicNet has to offer!</p>";
        }
        ?>
        <p><a class="btn btn-warning btn-lg" role="button" href="http://cs445.cs.umass.edu/php-wrapper/clp/profile.php" style="">Profile!</a></p>
      </div>
</div> 


<div class="row desc">

  <div class="col-lg-4" style="margin-bottom: 5%;">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/home.png"));?>'>
          <h2 class="colHead">Check Out Your Profile!</h2>
          <p class="colPar">What does your music say about you? View the songs you listened to, friends you added, and playlists you created, in your profile.</p>
         <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-primary" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=' . $_SESSION['username'];?>" role="button">Profile!</a></span>
        </div>

       <div class="col-lg-4" style="margin-bottom: 5%;">
          <img class="img-circle Cimg" src='data:image/png;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/play.png"));?>'>
          <h2 class="colHead">Create Playlists!</h2>
          <p class="colPar">Looking for that perfect combination of tunes to get you through your homework? 
          Click here to create, share, and discover great playlists!</p>
         <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-primary" href="<?php echo 'http://cs445.cs.umass.edu/php-wrapper/clp/profilePlaylists.php?user=' . $_SESSION['username'];?>" role="button">Playlists!</a></span>
        </div>

      <div class="col-lg-4" style="margin-bottom: 5%;">
          <img class="img-circle Cimg" src='data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/discover.jpg"));?>'>
          <h2 class="colHead">Discover New Music!</h2>
          <p class="colPar">You'll never have to worry about listening to the same old songs again, <?php echo ($_GET['user']); ?>!. Discover to find all sorts of new songs to listen to!</p>
        <span style="display:inline;"><a style = "padding:5px; margin:0;" class="btn btn-primary" href="http://cs445.cs.umass.edu/php-wrapper/clp/discover.php" role="button">Discover!</a></span>
       </div>
  </div>
</div>



<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php'; ?>