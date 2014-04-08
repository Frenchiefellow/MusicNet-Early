<form method="post" action="<?php if(isset($_SESSION)){$si = session_id(); echo 'admin.php?id=' . $si;} ?>">
<textarea name="query" cols="100" rows="5" placeholder="Enter Query, followed by ;">
</textarea><br>
<input type="submit" value="Submit" />
</form>

<?php
session_start();
if(isset($_SESSION)){
$si = session_id();
if(isset($_GET['id'])){
if(($_GET['id'] == $si) && ($_SESSION['username'] == 'admin')){
echo 'Authentication: True <br>';
if(isset($_GET['error'])){
if($_GET['error'] == "ILLEGAL_KEYWORD"){
echo 'Illegal Keyword used in previous query. Avoid use of keywords: DELETE, INSERT, DROP. <br>';
}}

if(isset($_POST['query'])){
$words = array("drop", "delete", "insert", "show");
if(contains($_POST['query'], $words)){
header('Location: admin.php?id=' . $si . '&error=ILLEGAL_KEYWORD');
die();
}
else{
$text = $_POST['query'];
$query = mysql_real_escape_string($text);
echo 'Query: ' . $text . "<br>\n";
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
    echo "Database selected successfully.<br><br>\n";
	$db = /*removed*/;
	$starttime = microtime(true);
	$result = mysql_query($text);
	$endtime = microtime(true);
	$totaltime = $endtime - $starttime;

if (!$result) {
    echo "User does not exist\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}
while($row = mysql_fetch_assoc($result)){
    foreach($row as $cname => $cvalue){
        print "$cname: $cvalue\t";
    }
    print "<br>\r\n";
}
 echo round($totaltime, 3, PHP_ROUND_HALF_UP) . " seconds";

}
}
}
else{
echo ' Authenication: False';
}
}
}


function contains($str, array $arr)
{
    foreach($arr as $a) {
        if (stripos($str,$a) !== false) return true;
    }
    return false;
}

?>

