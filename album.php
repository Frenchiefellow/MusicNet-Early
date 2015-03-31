<?php session_start(); ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/Scripts/checkMusic.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/header.php'; ?>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/partials/navbarProfile.php'; ?>
<style>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/bs/css/cars.css'; ?>
</style>

<div id="slider" class="carousel slide" style='opacity: .8'> 
  <div class="carousel-inner">
  <div class="item active one">
  <div class="two">
   <img src="http://avid.cs.umass.edu/projects/course-project/Musicnet/resources/images/case.png" class="imgBack" />
   </div>
      <div class="carousel-caption">
        <a class="btn btn-primary">ALBUM: <?php 
	 	$alID = $_GET[ 'id' ];
		//DB CONNECTION
		$stmt = $connection->prepare( 'SELECT albumname FROM Album WHERE albumid = ?' );
		$stmt->bind_param( 's',  $alID );
		$stmt->execute();
		$stmt->bind_result( $name);
		$stmt->store_result();
		if( $stmt->num_rows > 0 ){
			while( $stmt->fetch() ){
				if( $name != ''){
					echo $name;
				}
				else{
					echo "album";
				}
			}
		}
		else{
				echo "album";
		}
		?></a>

		<?php 
	 	$alID = $_GET[ 'id' ];
		//DB CONNECTION
		$stmt = $connection->prepare( 'SELECT artistid FROM Linked_To WHERE albumid = ?' );
		$stmt->bind_param( 's',  $alID );
		$stmt->execute();
		$stmt->bind_result( $aname );
		$ida;
		while( $stmt->fetch() ){
				$ida = $aname;
		}
		
		$stmt = $connection->prepare( 'SELECT artistname FROM Artist WHERE artistid = ?' );
		$stmt->bind_param( 's',  $ida );
		$stmt->execute();
		$stmt->bind_result( $anames );
		while( $stmt->fetch() ){
				echo '<a class="btn btn-warning" href="http://avid.cs.umass.edu/projects/course-project/Musicnet/artist.php?id=' . $ida . '">BY: ' . $anames . '</a>';
			}



		?></div>



      </div>
    </div>
    </div>

    <a class="carousel-control left"  data-slide="prev"><span ></span></a>
    <a class="carousel-control right" data-slide="next"><span ></span></a>

    </div>


<div class="songContainerOuter"><br>
	<h4 class="songTitle">Songs in Album:</h4>
	<div class="songContainerInner" >
	<?php 
		$alID = $_GET[ 'id' ];
		//DB CONNECTION
		$stmt = $connection->prepare( 'SELECT songid FROM Linked_To WHERE albumid = ?' );
		$stmt->bind_param( 's',  $alID);
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
			echo '<span style="margin: auto;">No Songs in Album!</span>';
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