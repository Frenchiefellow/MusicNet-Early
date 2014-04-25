
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
         <div id="fb-root"></div>
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
          </form>'; 
         echo '<div class ="navbar-brand2" style="position: absolute; color: white;"><div class="fb-login-button" data-max-rows="1" data-size="medium" data-show-faces="false" data-auto-logout-link="false">Login/Signup</div></div>';
         echo '<script>window.localStorage.clear();</script>';
          ?>
	   <?php if(isset($_GET['err'])){ echo '<div class ="navbar-brand2" style="position: absolute; color: white;">'; if($_GET['err'] == 1){echo '<script type="text/javascript">alert("Incorrect Credentials")</script>';} elseif($_GET['err'] == 2){ echo '<script type="text/javascript">alert("User Not Found!")</script>';} elseif($_GET['err'] == 3){ echo '<script type="text/javascript">alert("Page Not Found!")</script>';} echo '</div>'; } ?>
	   <?php echo '</div>';} 
	else{
	echo '
	 <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="'; $url = "http://cs445.cs.umass.edu/php-wrapper/clp/profile.php?user=" . $_SESSION['username']; echo $url; echo '">Home</a></li>
	     <li><a id="lo" >Log Out</a></li>
	   </ul>';} ?>
   <?php if(isset($_GET['err'])){ echo '<div class ="navbar-brand2" style="position: absolute; color: white;">'; if($_GET['err'] == 1){echo '<script type="text/javascript">alert("Incorrect Credentials")</script>';} else if($_GET['err'] == 2){ echo '<script type="text/javascript">alert("User Not Found!")</script>';} echo '</div>'; } ?>
	  <?php echo '</div>'; ?>

    </div>
    
   </div>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>

function onAuthenticated(data) {
  FB.api('/me', function(response) {
      if (response.name) localStorage.username = response.name;
      if (response.gender) localStorage.gender = response.gender;
      if (response.hometown) localStorage.home = response.hometown;
      if (response.id) localStorage.profID = response.id;
      $.ajax({
        		type: 'POST',
        		url: 'auth.php?',
        		data: 'fb=' + true  + '&name=' + localStorage.username + '&gender=' + localStorage.gender + '&location=' + localStorage.home + '&fid=' + localStorage.profID, 
        		cache: false,
        		error: function( e ){
        		alert( e );
        		},
        		success: function( response ){ 
              window.localStorage.removeItem('localStorage.username');
              window.localStorage.removeItem('localStorage.gender');
              window.localStorage.removeItem('localStorage.home');
        		  var lists =  new Array();
              lists = response.split("*|*|*");
              
      			if(lists[ 0 ] == 'new' ){
      				window.location.href = 'newuser.php?user=' + lists[ 1 ] + '_FB'; 
      			}
      			else if( lists[ 0 ] == 'returning' ){
      				window.location.href = 'profile.php?user=' + lists[ 1 ] + '_FB';
      			}
            window.localStorage.setItem('Userid', 1);
        		}

   			}); 
    });
};

window.fbAsyncInit = function() {
    FB.init({
      appId      : '1485350621679008',                        
      status     : true,   
      xfbml      : true                                  
    });

  FB.Event.subscribe('auth.authResponseChange', function(response) {
    //console.log(response);
   
    if (response.status === 'connected') {

      if(window.localStorage.getItem('Userid') == null){
       
      onAuthenticated(response.authResponse);
    
      }
     

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
   
   
     if(window.localStorage.Userid == null){
      onAuthenticated(response.authResponse);
    }
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

    return;  });
</script>