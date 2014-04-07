<?php
if(!isset($_SESSION)){
session_start();
}
session_start();
$name = $_GET['user'];
$connection = mysql_connect(/*removed*/));
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
	$sql = "SELECT loginacct FROM User WHERE loginacct = '$name'";
	$result = mysql_query($sql);

if (!$result) {
    echo "User does not exist\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

if(mysql_num_rows($result) > 0){

}
else{
if(isset($_SESSION)){
header("Location: refer.php?user=" .$_SESSION['username'] . "&friend=" .  $name);
die();
}
else{
header("Location: splash.php?err=2");
die();
}


}
mysql_free_result($result);


?>

