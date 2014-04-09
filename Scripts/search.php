<?php

if(!isset($_SESSION)){
session_start();
}


if(isset($_GET['query'])){

$query = $_GET['query'];

$connection = @new mysqli(/*Removed*/);
 if (!$connection){
    die ("Couldn't connect to mysql server!<br>The error was: " . mysql_error());
  }

//STRING INPUT
if(!is_numeric($query)){

//USER CHUNK
echo '<h4 class="page-header">Users</h4>';
$stmt = $connection->prepare('SELECT U.loginacct, U.username, U.userloc FROM User U WHERE U.loginacct = ?'); //Add username, location
if(!$stmt){ echo $connection->error;}
$stmt->bind_param('s', $query);

$stmt->execute();
$stmt->bind_result($log, $username, $userloc);


while($row = $stmt->fetch()){
    printf ("%s %s %s\n", $log, $username, $userloc);
}


//SONG CHUNK
echo '<h4 class="page-header" style ="margin-top: 2%;">Songs</h4>';
/*$stmt = $connection->prepare('SELECT U.title, U.year FROM Song U WHERE U.title = ?'); 
if(!$stmt){ echo $connection->error;}
$stmt->bind_param('s', $query);

$stmt->execute();
$stmt->bind_result($title, $year);


while($row = $stmt->fetch()){
    printf ("%s %i\n", $title, $year);
}*/

//ARTIST CHUNK
echo '<h4 class="page-header" style ="margin-top: 2%;">Artists</h4>';
/*$stmt = $connection->prepare('SELECT U.artistname FROM Artist U WHERE U.artistname = ?'); 
if(!$stmt){ echo $connection->error;}
$stmt->bind_param('s', $query);

$stmt->execute();
$stmt->bind_result($name);


while($row = $stmt->fetch()){
    printf ("%s\n", $name);
}*/

//ALBUM CHUNK
echo '<h4 class="page-header" style ="margin-top: 2%;">Albums</h4>';
/*$stmt = $connection->prepare('SELECT U.albumname FROM Album U WHERE U.albumname = ?'); 
if(!$stmt){ echo $connection->error;}
$stmt->bind_param('s', $query);

$stmt->execute();
$stmt->bind_result($name);


while($row = $stmt->fetch()){
    printf ("%s\n", $name);
}*/

}

//NUMERIC INPUT
if(is_numeric($query)){

//SONG CHUNK
echo '<h4 class="page-header" style ="margin-top: 2%;">Songs</h4>';
/*$stmt = $connection->prepare('SELECT U.title, U.year FROM Song U WHERE U.year = ? OR U.songid = ?'); 
if(!$stmt){ echo $connection->error;}
$stmt->bind_param('ii', $query, $query);

$stmt->execute();
$stmt->bind_result($title, $year);


while($row = $stmt->fetch()){
    printf ("%s %i\n", $title, $year);
}*/

//ARTIST CHUNK
echo '<h4 class="page-header" style ="margin-top: 2%;">Artists</h4>';
/*$stmt = $connection->prepare('SELECT U.artistname FROM Artist U WHERE U.artistid = ?'); 
if(!$stmt){ echo $connection->error;}
$stmt->bind_param('i', $query);

$stmt->execute();
$stmt->bind_result($name);


while($row = $stmt->fetch()){
    printf ("%s\n", $name);
}*/

//ALBUM CHUNK
echo '<h4 class="page-header" style ="margin-top: 2%;">Albums</h4>';
/*$stmt = $connection->prepare('SELECT U.albumname FROM Album U WHERE U.albumid = ?'); 
if(!$stmt){ echo $connection->error;}
$stmt->bind_param('i', $query);

$stmt->execute();
$stmt->bind_result($name);


while($row = $stmt->fetch()){
    printf ("%s\n", $name);
}*/
}


}
$stmt->close();

?>
