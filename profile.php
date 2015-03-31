<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/Scripts/checkUser.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/header.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/navbarProfile.php'; ?>

<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/sideBarProfile.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/Dash_Modules/innerDashPro.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/bottombar.php'; ?>

<?php
 if( $_GET[ 'user' ] == $_SESSION[ 'username'] ){
 	echo '<script>' .
 		 "$.ajax({
        type: 'POST',
        url: 'Scripts/notifications.php?',
        data: 'name=' + '" . $_SESSION[ 'username' ] . "', 
        cache: false,
        error: function( e ){
        alert( e );
        },
        success: function( response ){
         var lists =  new Array();
         if( response != ''){
         lists = response.split('*|*|*');
     	}
         if( lists.length >= 1 ){
        for( var i = 0; i < lists.length; i++ ){
      		alert('Notification: ' +  lists[ i ] );
      	}	
      	}
        }
    }); </script>";
 }
 ?>
