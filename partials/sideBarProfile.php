<div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
	     <li><a class = "user"><?php echo $_GET['user']; ?> </a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'profile.php')){echo 'class = "active"';} ?>><a href="<?php $url = "http://avid.cs.umass.edu/projects/course-project/Musicnet/profile.php?user=" . $_GET['user']; echo $url; ?>">Overview</a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'friends.php')){echo 'class = "active"';} ?>><a href="<?php $url = "http://avid.cs.umass.edu/projects/course-project/Musicnet/friends.php?user=" . $_GET['user']; echo $url; ?>">Friends</a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'Playlists.php')){echo 'class = "active"';} ?>><a href="<?php $url = "http://avid.cs.umass.edu/projects/course-project/Musicnet/profilePlaylists.php?user=" . $_GET['user']; echo $url; ?>">Playlists</a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'Songs.php')){echo 'class = "active"';} ?>><a href="<?php $url = "http://avid.cs.umass.edu/projects/course-project/Musicnet/profileSongs.php?user=" . $_GET['user']; echo $url; ?>">Songs</a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'stats.php')){echo 'class = "active"';} ?>><a href="<?php $url = "http://avid.cs.umass.edu/projects/course-project/Musicnet/stats.php?user=" . $_GET['user']; echo $url; ?>">Stats</a></li>
          </ul>
	   <ul class="nav nav-sidebar"></ul>

	   <ul class="nav nav-sidebar" style="margin-top: 90%;">
	     <li><a class = "user1">Options</a></li>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'refer.php')){echo 'class = "active"';} ?>><a href="<?php $url = "http://avid.cs.umass.edu/projects/course-project/Musicnet/refer.php"; echo $url; ?>">Refer a Friend!</a></li>
  	   </ul>

    
        </div>