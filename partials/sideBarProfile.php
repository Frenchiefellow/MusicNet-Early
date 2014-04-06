

<div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
	     <li><a class = "user"><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else{ echo "undefined";}; ?></a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'profile.php')){echo 'class = "active"';} ?>><a href="http://cs445.cs.umass.edu/php-wrapper/clp/profile.php">Overview</a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'friends.php')){echo 'class = "active"';} ?>><a href="http://cs445.cs.umass.edu/php-wrapper/clp/friends.php">Friends</a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'Playlists.php')){echo 'class = "active"';} ?>><a href="http://cs445.cs.umass.edu/php-wrapper/clp/profilePlaylists.php">Playlists</a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'Songs.php')){echo 'class = "active"';} ?>><a href="http://cs445.cs.umass.edu/php-wrapper/clp/profileSongs.php">Songs</a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'stats.php')){echo 'class = "active"';} ?>><a href="http://cs445.cs.umass.edu/php-wrapper/clp/stats.php">Stats</a></li>
          </ul>
    
        </div>