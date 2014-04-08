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
session_destroy();
}

//Information from the form 
$login = $_POST['loginacct'];
$user = $_POST['username'];
$pass = $_POST['password'];
$cpas = $_POST['conpassword'];
$age = $_POST['age'];
$loc = $_POST['location'];
$gen = $_POST['Gender'];

//Test connection to my Database
$connection = @new mysqli(/*removed*/);
  if (!$connection){
    die ("Couldn't connect to mysql server!<br>The error was: " . mysql_error());
  }
  else{
    echo "Connection successful!<br>\n";
  }

$stmt = $connection->prepare('SELECT loginacct FROM User WHERE loginacct = ?');
$stmt->bind_param('s', $login);

$stmt->execute();

$stmt->bind_result($loginacct);



//If we find some tuple, alert user  and redirect them to sign in page
if($stmt->fetch() == true){

header('Location: login.php?err=lgnact');
die();

}

else{

//Make sure password and confirm password are the same, else alert the user they are different
if(strcmp($pass, $cpas) !=0 ){
header('Location: login.php?err=pass');
die();
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
$quer ="INSERT INTO User".
 	"(loginacct, username, password, age, ismale, issuper, userloc)".
	"VALUES ('$login' ,'$user', '$pass', '$age', '$gender', 0, '$loc')";
if (!mysql_query($quer))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added"; 

//start a new session, store username inside for varius purposes, and redirect to newuser.php
session_start();
$_SESSION['username'] = $login;
ob_start(); 
$url = "newuser.php?user=" . $_SESSION['username'];
while (ob_get_status()) {
ob_end_clean();
}
header("Location: $url");
die();

}
}




$stmt->close();

?>