<?php
$user = $_POST['username'];
$pass = $_POST['pass'];
$connection =  @new mysqli(/*removed*/);
  if (!$connection){
    die ("Couldn't connect to mysql server!<br>The error was: " . mysql_error());
  }
  else{
    echo "Connection successful!<br>\n";
  }
   if (!mysql_select_db(/*removed*/))
    die ("Couldn't select a database!<br> Error: " . mysql_error());
  else
    echo "Database selected successfully.<br>\n";
	$db = /*removed*/;
	$sql = "SELECT loginacct, password FROM User WHERE loginacct = '$user' AND password = '$pass'";
	$result = mysql_query($sql);
	
$stmt = $connection->prepare('SELECT loginacct FROM User WHERE loginacct = ? AND password = ?');
$stmt->bind_param('ss', $user, $pass);

$stmt->execute();

$stmt->bind_result($loginacct);


if($stmt->fetch() == true){

session_start();
$_SESSION['username'] = $user;
ob_start(); 
$url = "profile.php?user=" . $_SESSION['username'];
while (ob_get_status()) {
ob_end_clean();
}
header("Location: $url");
die();
}

else{
header("Location: splash.php?err=1");
die("Incorrect Info!");
}

$stmt->close();
$mysqli->close();


?>