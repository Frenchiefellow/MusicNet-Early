<div id='lyrics'>
<h4 style="color: white; text-align: center">Lyrics:</h4>
<div id="lyBod"></div>
<div style="text-align: center">
<div >Due to current restrictions, we can only display the first 150 characters of the lyrics.</div>
<a id="u" class='btn btn-primary'>Read More Lyrics Here!</a></div>

</div>
<script>
var songname = $('#songname').text().split(' by: ');
  			$.ajax({
        		type: 'GET',
        		url: 'http://api.lyricsnmusic.com/songs?api_key=245315de0331dae5d17e451177ff2f&q=' + songname[1].substring(1, songname[1].length).replace(/[^A-Za-z0-9 ]/, "") + "%20" + songname[0].replace(/[^A-Za-z0-9 ]/, "").toLowerCase(),
        		dataType: 'jsonp', 
        		error: function( e ){
        	
        		},
        		success: function( response ){
        			console.dir(response);
        			if( response['data'][0]['context'] != null ){
        			$( '#lyBod').append( '<div id="text">' + response['data'][0]['context'] + '</div>');
        			}
        			else{
        				$( '#lyBod').append( '<div id="text">' + response['data'][0]['snippet'] + '</div>');
        			}
        			$( '#u').attr("href", response['data'][0]['url']);
        			$( '#text').css('color', "white");

        		}
        	});
</script>





<script>

var plays = document.getElementById( 'res' ).innerHTML;
if( plays > 0 ){
	$( '#lyrics' ).attr("style", "position: relative; border: 1px solid #eee; border-radius: 10px; width: 35%; height: 50%; margin-top: 2%; float: right; background-color: #eee; background-color: rgba(128, 128, 128, .7);" );
	$( '#lyBod' ).attr( "style", "height: 70%; width: 90%; margin: auto; padding-top: 2%;" );
}
else{
	$( '#lyrics' ).attr("style", "position: relative; border: 1px solid #eee; border-radius: 10px; width: 35%; height: 50%;  margin: auto; margin-top: 2%; background-color: #eee; background-color: rgba(128, 128, 128, .7)" );
	$( '#lyBod' ).attr( "style", "height: 70%; width: 90%; margin: auto; padding-top: 2%;" );
}
</script>
