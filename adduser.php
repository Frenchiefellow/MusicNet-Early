<?php 

//Destroys session if user is already signed in
if(isset($_SESSION)){
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_unset();
session_destroy()
}

//Information from the form 
$user = $_POST['username'];
$pass = $_POST['password'];
$cpas = $_POST['conpassword'];
$age = $_POST['age'];
$loc = $_POST['location'];
$gen = $_POST['Gender'];

//Test connection to my Database
$connection = mysql_connect(/*removed*/);
  if (!$connection){
    die ("Couldn't connect to mysql server!<br>The error was: " . mysql_error());
  }
  else{
    echo "Connection successful!<br>\n";
  }

//Test connect to Project Database
   if (!mysql_select_db(/*removed*/))
    die ("Couldn't select a database!<br> Error: " . mysql_error());
  else
    echo "Database selected successfully.<br>\n";

//Define the query; Searches for Users with desired input
	$db = /*removed*/;
	$sql = "Select * From User where username = '$user'";
	$result = mysql_query($sql);

//If we can't find a table
if (!$result) {
    echo "DB Error, could not list tables\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

//If we find some tuple, alert user with JavaScript Alert and redirect them to sign in page
if(mysql_num_rows($result) > 0){
?>
 <script type="text/javascript">
 alert("Username taken!");
	history.back();
</script>
<?php
}

else{
//Make sure password and confirm password are the same, else JavaScript alert the user they are different
if(strcmp($pass, $cpas) == 1){
?>
 <script type="text/javascript">
 alert("Passwords do not match!");
	history.back();
</script>
<?php
}
else{
//Define the boolean for gender
$gender;
if($gen !== "male"){
$gender = 0;
}
else{
$gender = 1;
}

//Insert the tuple into the User table
$quer ='INSERT INTO User (loginacct, username, password, age, ismale, issuper, userloc) VALUES ("$user","$user", "$password", "$age", "$gender", 0, "$loc")';
if (!mysql_query($quer))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added"; 

//start a new session, store username inside for varius purposes, and redirect to newuser.php
session_start();
$_SESSION['username'] = $user;
header('Location: newuser.php');
die();

}
}




mysql_free_result($result);
?>