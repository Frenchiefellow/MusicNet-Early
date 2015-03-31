<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/header.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/navbarProfile.php'; ?>

<style>
#jazz, #rain{
  display: none;
}
html, body{
  background-image: url('http://avid.cs.umass.edu/projects/course-project/Musicnet/resources/images/fireplace.jpg');
  background-size: 100%;
  opacity: .95;
  
}
</style>

<div style="position: fixed; right: -25%; margin-top: -15%; z-index: -99; width: 100%; height: 100%; opacity: .15">
  <iframe frameborder="0" height="100%" width="100%" 
    src="https://youtube.com/embed/eyU3bRy2x44?autoplay=1&controls=0&showinfo=0&autohide=1&iv_load_policy=3">
  </iframe>
</div>

 <iframe frameborder="0" id="jazz" height="100%" width="100%" 
    src="https://youtube.com/embed/HMnrl0tmd3k?autoplay=1">
  </iframe>

   <iframe frameborder="0" id="rain" height="100%" width="100%" 
    src="https://youtube.com/embed/xoirXUhEpIo?autoplay=1">
  </iframe>

  <div>
  <img src="http://avid.cs.umass.edu/projects/course-project/Musicnet/resources/images/rosen.png"  style="position: relative; margin: auto; width: 30%; height: 30%; opacity: .6"/>
  </div>


<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/bottombar.php'; ?>