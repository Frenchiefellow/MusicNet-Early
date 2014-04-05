<?php
$user = $_POST['username'];
$pass = $_POST['pass'];
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
	$sql = "SELECT username, password FROM User WHERE username = '$user' AND password = '$pass'";
	$result = mysql_query($sql);

if (!$result) {
    echo "User does not exist\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_row($result)) {
    echo "Table: {$row[0]}\n";
    echo "Table: {$row[1]}\n";
 
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