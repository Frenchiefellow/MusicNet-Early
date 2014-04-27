<div id="map3d" style="height: 250px; width: 607px; margin: auto; padding-top: 2%;"></div>

<?php 
$connection = @new mysqli( "cs445sql", "crpeters", "EL159crp", "clp" );
$id = $_GET[ 'id' ];
$stmt = $connection->prepare( 'SELECT userloc, U.loginacct FROM User U, UserInteraction I WHERE U.loginacct = I.loginacct AND I.songid = ? and U.userloc is not NULL' );
$stmt->bind_param( 's', $id );
$stmt->execute();
$stmt->bind_result( $location, $login);
while( $stmt->fetch() ){
echo '<div class="locations" style="display:none">' . $location .  '</div><br>';
}
$stmt->close();
$connection->close();
?>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script>
google.load("earth", "1", {"other_params":"sensor=true_or_false"});

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
        		url: 'https://maps.googleapis.com/maps/api/geocode/json?address=' + $('.locations')[ i ].innerHTML  + '&sensor=false&key=AIzaSyAA-p8I6Sob67KnZhNkkKyHZ6c6yRWZ_AU',
        		datatype: 'jsonp', 
        		error: function( e ){
        		alert( e );
        		},
        		success: function( response ){
        		console.dir(response);
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

function failureCB(errorCode) {
}


google.setOnLoadCallback(init);
</script>