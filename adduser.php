<?php 
$user = $_POST['username'];
$pass = $_POST['password'];
$cpas = $_POST['conpassword'];
$age = $_POST['age'];
$loc = $_POST['location'];
$gen = $_POST['Gender'];

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
	$db = /*removed*/;
	$sql = "Select * From User where username = '$user'";
	$result = mysql_query($sql);

if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

if(mysql_num_rows($result) > 0){
?>
 <script type="text/javascript">
 alert("Username taken!");
	history.back();
</script>
<?php
}
else{
if(strcmp($pass, $cpas) == 1){
?>
 <script type="text/javascript">
 alert("Passwords do not match!");
	history.back();
</script>
<?php
}
else{

$gender;
if($gen !== "male"){
$gender = 0;
}
else{
$gender = 1;
}


$quer ='INSERT INTO User (loginacct, username, password, age, ismale, issuper, userloc) VALUES ("$user","$user", "$password", "$a", "$gender", "$loc")';
if (!mysql_query($quer))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added"; 
}
}




mysql_free_result($result);
?>