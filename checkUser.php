<?php
$name = $_GET['user'];
$connection = mysql_connect("cs445sql", "crpeters", "EL159crp");
  if (!$connection){
    die ("Couldn't connect to mysql server!<br>The error was: " . mysql_error());
  }
  else{
    echo "Connection successful!<br>\n";
  }
   if (!mysql_select_db("clp"))
    die ("Couldn't select a database!<br> Error: " . mysql_error());
  else
    echo "Database selected successfully.<br>\n";
	$db = 'clp';
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
header("Location: splash.php?err=2");
die();

}
mysql_free_result($result);


?>

