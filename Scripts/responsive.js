function onWindowResizeResp(){
	fixSpotifySize();
	fixMap();
	fixCanvas();
}

function fixSpotifySize(){
	var spotify = $('#spot');
	var contHeight = $('#refHeight').height();
	spotify.height = contHeight * 0.70;
}

function fixMap(){
	var contHeight = $('#tplays').height();
	var map = $('#map3d');
	map.height(0.70 * contHeight);
}


function fixCanvas(){
  
    var newWidth = window.innerWidth / 3;
 
    var find = document.getElementById('containerCan');
    var find2 = document.getElementById('mid');

    if( find2 !== null){
    	$('#mid').height("45%");
    	$('#mid').width(newWidth+1);
    	$('#viz').height($('#mid').height());
    	$('#viz').width(newWidth);
    	$('#tplays').height($('#mid').height());
    	$('#tplays').width(newWidth);
    }
    
   if( find !== null ){ 
        renderer.setSize(newWidth, $('#tplays').height());
        renderer2.setSize(newWidth, $('#tplays').height());
        renderer3.setSize(newWidth, $('#tplays').height());
    }
}