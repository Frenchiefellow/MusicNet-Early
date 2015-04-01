<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://avid.cs.umass.edu/projects/course-project/Musicnet/splash.php" style="position:absolute;">MusicNet</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
       <?php if ( isset ( $_SESSION[ 'username' ] ) ) { echo '
            <li '; $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'profile.php')){echo 'class = "active"';} echo '><a href="'; $url = "http://avid.cs.umass.edu/projects/course-project/Musicnet/profile.php?user=" . $_SESSION['username']; echo $url; echo '">Home</a></li>';} ?>
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'discover.php')){echo 'class = "active"';} ?>><a href="http://avid.cs.umass.edu/projects/course-project/Musicnet/discover.php">Discover</a></li>
       <?php if(isset($_SESSION['username'])){ 
        echo '<li '; $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'recommend.php')){echo 'class = "active"';} echo '><a href="'; $url =" http://avid.cs.umass.edu/projects/course-project/Musicnet/recommend.php?user=" . $_SESSION[ 'username' ]; echo $url; echo '">Recommend</a></li>'; 
        echo '
            <li '; $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'playlists.php')){echo 'class = "active"';} echo '><a href="http://avid.cs.umass.edu/projects/course-project/Musicnet/playlists.php?user=' . $_SESSION[ 'username' ] . '">Playlists</a></li>'; } ?>
            
            <li <?php $url = "$_SERVER[REQUEST_URI]"; if(strpos($url, 'about.php')){echo 'class = "active"';} ?>><a href="http://avid.cs.umass.edu/projects/course-project/Musicnet/about.php">About Us</a></li>
    <?php if(isset($_SESSION['username'] ) && strpos( $_SESSION[ 'username' ], '_FB')){ echo '
            <li><a id="lo">Log Out</a></li>';} 
            else if(isset($_SESSION['username'])){
             echo '<li><a id="log">Log Out</a></li>';}
            else{
             echo '<li><a href="http://avid.cs.umass.edu/projects/course-project/Musicnet/splash.php">Log In</a></li>';}
            
              ?>
          </ul>
          <form class="navbar-form navbar-right" method="get" action="http://avid.cs.umass.edu/projects/course-project/Musicnet/search.php?query=">
            <input type="search" class="form-control" placeholder="Search Everything!" name="query">
          </form>

  </div>        
      </div>
    </div> 
<div id="fb-root"></div>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>

window.fbAsyncInit = function() {
   
    FB.init({
      appId      : '1485350621679008',                    
      status     : true,   
      xfbml      : true                                 
    });
    
  FB.Event.subscribe('auth.authResponseChange', function(response) {
    //console.log(response);
    
    if (response.status === 'connected') {

     
     

    } else if (response.status === 'not_authorized') {

     
      FB.login(function(response) {
        if (response.authResponse) {
           
      } else {
     
        
      }
    });
    } else {
      
      
      FB.login(function(response) {
        if (response.authResponse) {

    

      } else {
      
        
      }
    });
    }
  }); 

FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
   
   
   
  } else if (response.status === 'not_authorized') {
    

  } else {
    
    
  }
});
FB.logout(function(response) {
  
});


};

  // Load the SDK asynchronously
  (function(d, s, id){
   var js, fjs = d.getElementsByTagName(s)[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement(s); js.id = id;
   js.src = "//connect.facebook.net/en_US/all.js";
   fjs.parentNode.insertBefore(js, fjs);
 }(document, 'script', 'facebook-jssdk'));

  
  

  // Load the SDK asynchronously
  (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
 }(document));

 
  
</script>

<script>
$( '#lo' ).click(function(){
 if(typeof FB.logout == 'function'){
        if (FB.getAuthResponse()) {
         FB.logout(function(response) { 

            $.ajax({
            type: 'POST',
            url: 'logout.php',
            data: 'fbl=' + true, 
            cache: false,
            error: function( e ){
            alert( e );
            },
            success: function( response ){ 
            window.localStorage.clear();
            window.location.href = 'splash.php';
            }
          });

          }); 
         return;
        }  
    };
    return;  
  });

$( '#log' ).click(function(){

    $.ajax({
            type: 'POST',
            url: 'logout.php',
            data: 'fbl=' + false, 
            cache: false,
            error: function( e ){
            alert( e );
            },
            success: function( response ){ 
            window.localStorage.clear();
            window.location.href = 'splash.php';
            }
          });
});
  
</script>
  