

<?php
include '/courses/cs400/cs445/php-dirs/clp/www/partials/headerNoNav.php';
?>

<?php
include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarPlain.php';
?>


<div id="holder" class="jumbotron" style="position: relative; margin-top: 20%;"></div>

<?php
include '/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php';
?> 



<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>

//Grab the data from local storage
var lists = JSON.parse( window.localStorage.getItem( 'lists') );
var song = window.localStorage.getItem( 'song');

//Append the html with radio buttons (selectors) for all the playlists they have
var html =  '<label for="checks">Choose one Playlist to add the Song to:</label><br>';
	for(var i = 0; i < lists.length; i++ ){
		html += '<input type="radio" name="list" value="' + lists[ i ] +'">' + lists[ i ] + '<br>';
	}
	html+= '<br>';


//Append the previous variable ^^^ to the holder div
document.getElementById( "holder" ).innerHTML = html;


var val;

//If a playlist is checked, add the song to the playlist
$('input:radio[name=list]').click(function() {
  val = $('input:radio[name=list]:checked').val();
  if( val !== undefined ){
	$.ajax({
        type: 'POST',
        url: 'Scripts/update.php?',
        data: 'playlist=' + val + '&s=' + song,
        cache: false,
        error: function( e ){
        alert( e );
        },
        success: function( response3 ){
        alert( response3 );
        //Close window after sucessfully adding and clear the local storage
        window.localStorage.clear();
        window.close();
        }
    }); 
	}

});



</script>
