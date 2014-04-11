<?php include '/courses/cs400/cs445/php-dirs/clp/www/Scripts/checkMusic.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/header.php'; ?>
<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/navbarProfile.php'; ?>
<style>
#ytplayer{
display: none;
}
</style>

<audio controls id="music"><source src="" type="audio/mpeg">Your browser does not support this audio format.</audio>
<div>Plays: </div>
<div id="res"><?php 
		$connection = @new mysqli( /*removed*/ );
		$song = $_GET[ 'id' ];
		$stmt = $connection->prepare( 'SELECT playcount FROM Song WHERE songid = ?' );
		$stmt->bind_param( 's',  $song);
		$stmt->execute();
		$stmt->bind_result( $plays );
		while($stmt->fetch()){
		if (is_null( $row ) )
		echo $row[ 0 ];
		else
		echo '0';
		}
		?></div>


<script type="text/javascript">
document.getElementById("music").addEventListener('play', incrementPlays);

var plays = document.getElementById("res").innerHTML;

function incrementPlays() {
    plays++;
    document.getElementById("res").innerHTML = plays;
}
</script>




<?php include '/courses/cs400/cs445/php-dirs/clp/www/partials/bottombar.php'; ?>

<!--SOAAABI12A8C13615F-->