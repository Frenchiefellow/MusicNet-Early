

<div id='tplays'>
<div id="map3d" ></div>


<?php 
//DB connection
$id = $_GET[ 'id' ];
$stmt = $connection->prepare( 'SELECT userloc, U.loginacct FROM User U, UserInteraction I WHERE U.loginacct = I.loginacct AND I.songid = ? and U.userloc is not NULL AND I.plays > 0 and U.userloc != "UMASS" LIMIT 50' );
$stmt->bind_param( 's', $id );
$stmt->execute();
$stmt->bind_result( $location, $login);
while( $stmt->fetch() ){
echo '<div class="locations" style="display:none">' . $location .  '</div>';
}
$stmt->close();
$connection->close();
?>
</div>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script>
/*google.load("earth", "1", {"other_params":"sensor=true_or_false"});

function init() {
  google.earth.createInstance('map3d', initCB, failureCB);

}

function initCB(instance) {
   ge = instance;
   ge.getWindow().setVisibility(true);
   var lat;
   var lng;

   var leng = $('.locations').length;
   for( var i = 0; i < leng; i++ ){
   $.ajax({
        		type: 'GET',
        		url: 'https://maps.googleapis.com/maps/api/geocode/json?address=' + $('.locations')[ i ].innerHTML  + '&sensor=false&key=AIzaSyB8dXZZC4uyQSesH8Cizu9bkIqsrsqW3kk',
        		datatype: 'jsonp', 
        		error: function( e ){
        		alert( e );
        		},
        		success: function( response ){
        		//console.dir(response);
      			lat = response['results'][0]['geometry']['location']['lat'];
      			lng = response['results'][0]['geometry']['location']['lng'];

			   var placemark = ge.createPlacemark('');

			   var icon = ge.createIcon('');
				icon.setHref('http://maps.google.com/mapfiles/kml/paddle/red-circle.png');
				var style = ge.createStyle('');
				style.getIconStyle().setIcon(icon);
				style.getIconStyle().setScale(3.0);
				placemark.setStyleSelector(style);

			   var point = ge.createPoint('');
			   point.setLatitude( lat );
			   point.setLongitude( lng );
			   placemark.setGeometry(point);
			   ge.getFeatures().appendChild(placemark);
			   var pointer = ge.getView().copyAsLookAt(ge.ALTITUDE_RELATIVE_TO_GROUND);
			   pointer.setLatitude( 39.5 );
			   pointer.setLongitude( -98.35 );
			   pointer.setAltitude( pointer.getRange() * -0.7);
			   ge.getView().setAbstractView( pointer );
			 
        		}
   			}); 
	}



}



google.setOnLoadCallback(init);*/
</script>

<script>
$(document).ready(function(){
	setSizes();
});
function setSizes(){
var plays = document.getElementById( 'res' ).innerHTML;
	if( plays > 0 ){
		$( '#tplays ').attr("style", "position: relative; width: 33.33%; height: 52%; float: left;" );
		$( '#map3d' ).attr( "style", "height: 75%; width: 90%; margin: auto; padding-top: 2%;" );
	}
	else{
		$( '#tplays ').attr("style", "position: relative; width:33.34%; height: 52%;  margin: auto;" );
		$( '#map3d' ).attr( "style", "height: 75%; width: 90%; margin: auto; padding-top: 2%; display:none;" );
}
};
</script>