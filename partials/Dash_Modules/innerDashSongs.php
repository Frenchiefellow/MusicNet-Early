<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header"><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else{ echo "undefined";}; ?>: Songs</h1>

    <div class="row">

    	<!-- Column for Songs with Plays -->
    	<div class="col-sm-5" style="border: 2px solid; height: 80%; margin-right: 5%; margin-left: 6%; border-radius: 10px;">
    	<h3 class="page-header" style="text-align:center;">Songs Played:</h3>
    	<div style="background-color: #eee; border: 0px solid; border-radius: 10px; height: 90%;">
    	<?php
    	//For Each song with Plays > 0 where loginacct = this
    		// Create a row with 3 columns for an icon with a link to the song (play button), the name of song, and the the number of plays
    	?>	
    	</div>
    	</div>


    	<!-- Column for Songs with Ratings -->
    	<div class="col-sm-5" style="border: 2px solid; height: 80%; border-radius: 10px;">
    	<h3 class="page-header"  style="text-align:center;">Songs Rated:</h3>	
    	<div style="background-color: #eee; border: 0px solid; border-radius: 10px; height: 90%;">
    	<?php
    	//For Each song with Plays > 0 where loginacct = this
    		// Create a row with 3 columns for an icon with a link to the song (play button), the name of song, and the the number of plays
    	?>		
    	</div>
    	</div>

    </div>
</div>