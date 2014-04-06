<?php
$user = $_POST['username'];
$pass = $_POST['pass'];
$connection = mysql_connect(/*removed*/);
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
	$db = '/*removed*/';
	$sql = "SELECT username, password FROM User WHERE username = '$user' AND password = '$pass'";
	$result = mysql_query($sql);

if (!$result) {
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

if(mysql_num_rows($result) > 0){
session_start();
$_SESSION['username'] = $user;
header('Location: profile.php');
die();
}

else{
?>
 <script type="text/javascript">
 alert("Invalid Credentials!");
	history.back();
</script>
<?php
}

mysql_free_result($result);


?>
