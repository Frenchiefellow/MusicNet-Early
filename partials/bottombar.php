<div class="navbar navbar-inverse navbar-fixed-bottom" role="navigation">
      <div class="container">
        <div class="navbar-footer">
	    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

	   <?php
	  	if( isset( $_SESSION[ 'username' ] ) ){
	    	if($_SESSION['username'] == 'admin'){
			 	echo '<a class="navbar-brand" href="'; $si = session_id(); $url = "http://avid.cs.umass.edu/projects/course-project/Musicnet/admin.php?id=" . $si; echo $url; echo '" style="position:absolute;">ADMIN</a>';}}
	   	elseif ( !isset( $_SESSION[ 'username' ] ) ){
	   		echo '<a class="navbar-brand" href="http://avid.cs.umass.edu/projects/course-project/Musicnet/about.php" style="position:absolute;">About Us</a>';
	   	}

	   		?>

          <a class="navbar-brand2" href="http://www.github.com/frenchiefellow" style="position:absolute; ">CLP Productions</a>
        </div>
      </div>
</div>

</body>
</html>