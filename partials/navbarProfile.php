
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://cs445.cs.umass.edu/php-wrapper/clp/splash.php" style="position:absolute;">MusicNet</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'profile.php')){echo 'class = "active"';} ?>><a href="http://cs445.cs.umass.edu/php-wrapper/clp/profile.php">Home</a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'discover.php')){echo 'class = "active"';} ?>><a href="http://cs445.cs.umass.edu/php-wrapper/clp/discover.php">Discover</a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'playlists.php')){echo 'class = "active"';} ?>><a href="http://cs445.cs.umass.edu/php-wrapper/clp/playlists.php">Playlists</a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'about.php')){echo 'class = "active"';} ?>><a href="http://cs445.cs.umass.edu/php-wrapper/clp/about.php">About Us</a></li>
		<?php if(isset($_SESSION['username'])){ echo '
             <li><a href="http://cs445.cs.umass.edu/php-wrapper/clp/logout.php">Log Out</a></li>';} ?>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search Everything!">
          </form>

	</div>        
      </div>
    </div> 
  