<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          
<h1 class="page-header"><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else{ echo "undefined";}; ?>: Profile</h1>

<div class="row">
    <div class="row">
        <div class="col-lg-6" style="border: 2px solid; border-radius: 10px; background-color: #D3D3D3; left: 1%;">
          <img class="img"   src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents("/courses/cs400/cs445/php-dirs/clp/www/resources/images/girl.jpg"));?>" style="width: 140px; height: 140px;">
          <h2><?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else{ echo "undefined";}; ?></h2>
          <p>Welcome to <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else{ echo "undefined";}; ?>'s MusicNet Profile Page! </p>
          <p>Here you can learn a little bit more about <?php if(isset($_SESSION['username'])){echo $_SESSION['username'];} else{ echo "undefined";}; ?>'s taste in music, and perhaps you'll find a common link! Take a look around, but don't be afraid to friend them. Don't 
		worry, its not creepy! We are all music lovers here! </p>
	   <p><a class="btn btn-default" href="#" role="button">Friend Me!</a></p>
        </div>

        <div class="col-lg-6">
  
        </div>
         </div>

	<h3 class='page-header' style="padding-top: 1%;">Recently Listened to: </h3>
	<h3 class='page-header'>Recently Rated: </h3> 

</div>