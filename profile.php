<?php include '/courses/cs400/cs445/php-dirs/clp/www/Scripts/checkUser.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/header.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarProfile.php'; ?>

<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/sideBarProfile.php'; ?>
<?php include  '/courses/cs400/cs445/php-dirs/clp/www/partials/Dash_Modules/innerDashPro.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php'; ?>

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
