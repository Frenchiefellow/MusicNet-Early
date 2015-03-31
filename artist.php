<?php session_start(); ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/header.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/navbarProfile.php'; ?>
<style>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/bs/css/cars.css'; ?>
</style>


<div id="slider" class="carousel slide" style='opacity: .8'> 
  <div class="carousel-inner" >
  <div class="item active one" >
  <div  class="two">
   <img src="http://avid.cs.umass.edu/projects/course-project/Musicnet/resources/images/guitar_2.jpg"  class="imgBack" />
   </div>
      <div class="carousel-caption">
        <a class="btn btn-primary" style="font-size: 150%;">ARTIST: 
	 <?php 
	 	$artID = $_GET[ 'id' ];
		//DB CONNECTION
		$song = $_GET[ 'id' ];
		$stmt = $connection->prepare( 'SELECT artistname FROM Artist WHERE artistid = ?' );
		$stmt->bind_param( 's',  $artID);
		$stmt->execute();
		$stmt->bind_result( $name);
		while( $stmt->fetch() ){
			echo $name;
		}
		?>
		</a>
      </div>
    </div>

	 <?php 
	 	$artID = $_GET[ 'id' ];
		//DB CONNECTION
		$stmt = $connection->prepare( 'SELECT count( albumid ), albumid FROM Linked_To WHERE artistid = ?' );
		$stmt->bind_param( 's',  $artID);
		$stmt->execute();
		$stmt->bind_result( $numAlb, $albumID );
		$album = array();
		$noAlb;
		while($row = $stmt->fetch()){
			$noAlb = $numAlb;
			array_push( $album, $albumID );
		}
		if( $noAlb > 0 ){
			for( $i = 0; $i < count( $album ); $i++ ){
					$stmt = $connection->prepare( 'SELECT albumname FROM Album WHERE albumid = ?' );
					$stmt->bind_param( 's',  $album[ $i ] );
					$stmt->execute();
					$stmt->bind_result( $name );
					while($row = $stmt->fetch()){
						if( $name == '' ){
							$name = "Album";
						}
						echo '<div class="item one" ><div href="http://avid.cs.umass.edu/projects/course-project/Musicnet/album.php?id=' . $album[ $i ] . '" class="two" ><img src="http://avid.cs.umass.edu/projects/course-project/Musicnet/resources/images/case.png" class="imgBack2" ></div><div class="carousel-caption"><a style="font-size: 150%;" class="btn btn-primary" href="http://avid.cs.umass.edu/projects/course-project/Musicnet/album.php?id=' . $album[ $i ] . '">ALBUM: ' . $name . '</a></div></div>';
					}		
		}

		}

		?>
  </div>
    <a class="carousel-control left" href="#slider" data-slide="prev"><span class="glyphicon glyphicon-chevron-left" > Prev</span></a>
    <a class="carousel-control right" href="#slider" data-slide="next"><span class="glyphicon glyphicon-chevron-right"> Next</span></a>
</div>


<div class="songContainerOuter"><br>
	<h4 class="songTitle">Songs by Artist:</h4>
	<div class="songContainerInner" >
	<?php 
		$artID = $_GET[ 'id' ];
		//DB CONNECTION
		$stmt = $connection->prepare( 'SELECT songid FROM Linked_To WHERE artistid = ?' );
		$stmt->bind_param( 's',  $artID);
		$stmt->execute();
		$stmt->bind_result( $song );
		$stmt->store_result();
		$sIDs = array();
		if( $stmt->num_rows > 0 ){
			while($row = $stmt->fetch()){
				array_push( $sIDs, $song );
			}
		}
		else{
			echo '<span style="margin: auto;">No Songs by Artist!</span>';
		}

		for( $i = 0; $i < count( $sIDs ); $i++ ){
			$stmt = $connection->prepare( 'SELECT title FROM Song WHERE songid = ?' );
			$stmt->bind_param( 's',  $sIDs[ $i ] );
			$stmt->execute();
			$stmt->bind_result( $title );
			while($row = $stmt->fetch()){
				echo '<a href="http://avid.cs.umass.edu/projects/course-project/Musicnet/song.php?id=' . $sIDs[ $i ] . '">' . $title . '</a><br>';
			}
		}


	?>
	</div>
</div>



<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/bottombar.php'; ?>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://avid.cs.umass.edu/projects/course-project/Musicnet/bs/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){
    $('.carousel').carousel({
      interval: 10000
    });
  });
</script>