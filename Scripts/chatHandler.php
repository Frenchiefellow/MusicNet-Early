<?
session_start();
if(isset($_SESSION['username'])){

    $text = $_POST['text'];

    //DB connection
     $stmt = $connection->prepare( 'SELECT title FROM Song WHERE songid = ?' );
    $stmt->bind_param( 's' , $_POST[ 'songID' ] );
    $stmt->execute();
    $stmt->bind_result( $name );
    $song;
    while ( $row = $stmt->fetch() ) {
        $song = $name;
    }
    $stmt->close();
    $connection->close();

    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'>(".date("g:i A").") <b>".$_SESSION['username']." on '" . $song . "'</b>: ".stripslashes(htmlspecialchars($text))."<br></div>");
    fclose($fp);
}
?>
