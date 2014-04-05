
<div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
	     <li><a class = "user"><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else{ echo "undefined";}; ?></a></li>
            <li class="active"><a href="#">Overview</a></li>
            <li><a href="#">Friends</a></li>
            <li><a href="#">Playlists</a></li>
            <li><a href="#">Songs</a></li>
            <li><a href="">Stats</a></li>
          </ul>
    
        </div>