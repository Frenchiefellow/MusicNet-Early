
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://cs445.cs.umass.edu/php-wrapper/clp/splash.php" style="position:absolute; ">MusicNet</a>
        </div>
	<?php if(!isset($_SESSION['username'])){echo'
        <div class="navbar-collapse collapse">
		 
          <form action="http://cs445.cs.umass.edu/php-wrapper/clp/auth.php" class="navbar-form navbar-right" role="form" method="post">
            <div class="form-group">
              <input type="text" placeholder="Login Account" name="username" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" placeholder="Password" name="pass" class="form-control">
            </div>
            <button type="submit" class="btn btn-success" >Sign in</button>
          </form>'; ?>
	   <?php if(isset($_GET['err'])){ echo '<div class ="navbar-brand2" style="position: absolute; color: white;">'; if($_GET['err'] == 1){echo 'Incorrect Credentials!';} else if($_GET['err'] == 2){ echo 'User Not Found!';} else if($_GET['err'] == 3){ echo 'Page Not Found!';}echo '</div>'; } ?>
	   <?php echo '
        </div>';} 
	else{
	echo '
	 <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="'; $url = "http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=" . $_SESSION['username']; echo $url; echo '">Home</a></li>
	     <li><a href="http://cs445.cs.umass.edu/php-wrapper/clp/logout.php">Log Out</a></li>
	   </ul>'; ?>
   <?php if(isset($_GET['err'])){ echo '<div class ="navbar-brand2" style="position: absolute; color: white;">'; if($_GET['err'] == 1){echo 'Incorrect Credentials!';} else if($_GET['err'] == 2){ echo 'User Not Found!';} echo '</div>'; } ?>
	  <?php echo '
	</div>';}?>

      </div>
    </div>

