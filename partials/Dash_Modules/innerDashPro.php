<style><?php include '/courses/cs400/cs445/php-dirs/clp/www/bs/css/profile.css'; ?></style>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style = "margin-top: -1%;">      
<h1 class="page-header"><?php echo $_GET['user']; ?>: Profile</h1>
<div class="outline">

    <div class="row">
        <div class="col-lg-3 picholder">
          <img class="img" src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/guitar_2.jpg"));?>" style="width: 200px; height: 200px; border: 2px solid; border-radius: 2px; margin-top: 2%">
          <h2 style="position: relative;"><?php echo $_GET['user']; ?></h2>
	  <div class="picboxinfo"> 
          <p>Welcome to <?php echo $_GET['user']; ?>'s MusicNet Profile Page! </p>
          <p>Here you can learn a little bit more about <?php echo $_GET['user']; ?>'s taste in music, and perhaps you'll find a common link! Take a look around, but don't be afraid to friend them. Don't 
		worry, its not creepy! We are all music lovers here! </p>
	  </div> 
	   <?php if($_SESSION['username'] == $_GET['user']){ echo '<p style="margin-top: 2%;"><a class="btn btn-success" href="#" role="button">Friends!</a></p>';} 
 	   else{ echo '
	   <p style="margin-top: 2%;"><a class="btn btn-primary" href="#" role="button">Friend Me!</a></p>';} ?>
        </div>
        <div class="col-lg-8 aboutbox">
	 <h2 class="aboutitle">About <?php echo $_GET['user']; ?>:</h2>
  
        </div>

        </div>
<div class="row listen">
	<h3 class='page-header'>Recently Listened to: </h3>
</div>
<div class ="row rated">
	<h3 class='page-header'>Recently Rated: </h3> 

</div>
</div>
</div>
