<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://cs445.cs.umass.edu/php-wrapper/clp/splash.php" style="position:absolute">MusicNet</a>
	   <?php if(isset($_GET['err'])){ echo '<div class ="navbar-brand2" style="position: absolute; color: white;">';if($_GET['err'] == 'pass'){echo "Password's Don't match!";} if($_GET['err'] == 'lgnact'){ echo 'Login Taken!';} echo '</div>'; } ?>

        </div>
      
      </div>
    </div>