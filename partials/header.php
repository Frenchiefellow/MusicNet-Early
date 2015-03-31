<?php
header("Access-Control-Allow-Origin: *"); 
?>
<!DOCTYPE html>
<html>
<?php if(!isset($_SESSION)){session_start(); } ?>


<style>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/bs/css/bootstrap.min.css'; ?>
</style> 

<style>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/bs/css/bootstrap.css'; ?>
</style> 

<style>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/bs/css/style.css'; ?>
</style> 

<style>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/bs/css/bootstrap-responsive.css'; ?>
</style> 

<style>
<?php include '/nfs/avid/data1/html/projects/course-project/Musicnet/bs/css/dash.css'; ?>
</style> 

<script src="./Scripts/build/three.js"></script>
<script src="./Scripts/build/CanvasRenderer.js"></script>
<script src="./Scripts/build/Projector.js"></script>


<head>
<title>MusicNet</title>
</head>
<?php $url = "$_SERVER[REQUEST_URI]"; 
if(strpos($url, 'song.php')){
echo '<body style="overflow: hidden">'; 
}
else{
echo '<body>';	
}
?>
