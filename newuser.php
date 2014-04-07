<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/header.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarProfile.php'; ?>

<style>
body{
background-image: url('http://farm4.staticflickr.com/3186/3049227706_67fce65d4e_o.jpg');
}
</style>

<div class ='entire'>


<div class="jumbotron" id= "welcome" style="background-color: rgba(128, 128, 128, .5);">
      <div id = "splashContainer" class="container">
        <h1>Welcome, <?php echo ($_GET['user']); ?> to MusicNet!</h1>
        <p>Information Here</p>
        <p><a class="btn btn-warning btn-lg" role="button" href="http://cs445.cs.umass.edu/php-wrapper/clp/profile.php" style="">Profile!</a></p>
      </div>
</div> 
</div>

<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php'; ?>