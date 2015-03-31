var songName;
var url;
var mode;
var context = new AudioContext();
var buf;
var src;
var evented;
var analysizer;
var array;
var pauseTime;
var startTime, started;
var paused;
var sampleSize = 2048;
var X = 128,
	X2,
	X3, 
    spacing = Math.floor(window.innerWidth / X * 2.30),
    spacing2,
    spacing3,
    Y = 1,
    Y2,
    Y3;
var song = false;
var container, container2, container3, stats;
var camera, camera2, camera3, scene, scene2, camera3, renderer, renderer2, renderer3;

var particles, particles2, particle, particle2, count = 0;

var mouseX = 0,
    mouseY = 0;

var windowHalfX = window.innerWidth / 2;
var windowHalfY = window.innerHeight / 2;

var canvasColored = "00000";
var intial;
var parts, finaled;
var isColored;
var infinityMode = false;
var count = 0;
var randX;
var rocker;
var state;
var radius, angle;

function IntializeVisualizer(url, type) {
    supported();
    createPlayButton(url);


}

function supported() {
    if (!window.WebGLRenderingContext) {
        alert("GET WEBGL FOOL");
        return;
    }

    try {
        window.AudioContext = window.AudioContext || window.webkitAudioContext;
        audioContext = new window.AudioContext();
    } catch (e) {
        alert("GET WEBAUDIO");
        return;
    }
}

function loadSong(url) {
		console.log(url);
		var requester = new XMLHttpRequest();
		requester.open("GET", url, true);
		requester.responseType = 'arraybuffer';

		requester.onload = function() {
			context.decodeAudioData(requester.response, function(buffer) {
				buf = buffer;
				play(0);
			});
		}
		requester.send();
}

// Functionality for Playing the song 
function play(val) {
		song = true;
		src = context.createBufferSource();
		src.buffer = buf;

		analysizer = context.createAnalyser();
		analysizer.fftSize = sampleSize;

		src.connect(analysizer);
		analysizer.connect(context.destination);
		src.start(0);

		animate();
}

function createPlayButton(url){
	
  	doInitCSS();
  	var mid = $('#mid');
    var play = document.createElement('img');
    play.className = 'playButton';
    play.src = "http://avid.cs.umass.edu/projects/course-project/Musicnet/resources/images/play.png";
    play.style.cssText = ' position: absolute;top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%); width: 33%; height: 50%; cursor: pointer';
    play.title = "Click here to sample the Visualizer for the Song!";
    mid.append(play);
  

    $('.playButton').click( function(){
         Intialize3D();
         loadSong(url);
    });
   
}
function doInitCSS(){

  	var viz = $('#viz');
    var tplays = $("#tplays");
    var location = $('#tplays');
    var mid = $('#mid');
    var newHeight = location.height();
    var newWidth = window.innerWidth / 3;
    viz.css({"height" : newHeight, "width" : newWidth,  "background-color" : "black" , "margin" : "0 auto",  "position" : "relative", "float" : "right", "display" : "inline-block", "vertical-align" : "top"});
    tplays.css({"height" : newHeight, "width" : newWidth,  "background-color" : "black" , "margin" : "0 auto", "display" : "inline-block", "vertical-align" : "top", "float" : "left"});
    mid.css({"display" : "inline-block", "height" : newHeight, "width" : newWidth + 2,  "background-color" : "black" , "margin" : "auto", "position" : "fixed", "float" : "center", "vertical-align" : "top" });
}

   
function Intialize3D() {

    var playButton = $('.playButton');
    var PI2 = Math.PI * 2;
    var canvasColor = '#000000';

    playButton.remove();
    vizOne(PI2, canvasColor);
    vizTwo(PI2, canvasColor);
    vizThree(PI2, canvasColor);
    fixCanvas();

}

//First Visualizer: Ball Type
function vizOne(PI2, canvasColor){
	container = document.createElement('div');
    container.id = 'containerCan';
    container.title = 'Click to go to the Visualizer!';
    container.onclick = function(){
        window.open("http://webvisualizer.herokuapp.com");
    };
    $('#viz').append(container);
    $('#containerCan').css("cursor","pointer");

    camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 10000);
    camera.position.z = 1000;
    scene = new THREE.Scene();

    particles = new Array();
    var i = 0;
    var colored = Math.ceil(Math.random() * (255 - X) + 1);

    for (var ix = 0; ix < X; ix++) {
        for (var iy = 0; iy < Y; iy++) {
            recolor = rainbowColors(colored, (X));
            var material = new THREE.SpriteCanvasMaterial({
                color: recolor.toString(),
                program: function(context) {
                    context.beginPath();
                    context.arc(0, 0, 0.5, 0, PI2, true);
                    context.fill();
                }

            });
            colored++;
            initial = colored;

            particle = particles[i++] = new THREE.Sprite(material);
            particle.position.x = ix * spacing - ((X * spacing) / 2);
            particle.position.z = iy - ((Y) / 2);
            particle.scale.x = particle.scale.y = Math.floor(window.innerWidth / X);
            scene.add(particle);

        }

    }
    renderer = new THREE.CanvasRenderer();
    renderer.setSize(430, 175);
    renderer.setClearColor(canvasColor, 1);
    container.appendChild(renderer.domElement);
}

//Second Visualizer: Bar Type
function vizTwo(PI2, canvasColor){
	container2 = document.createElement('div');
    container2.id = 'containerCan2';
    container2.title = 'Click to go to the Visualizer!';
    container2.onclick = function(){
        window.open("http://webvisualizer.herokuapp.com");
    };
    $('#tplays').append(container2);
    $("#map3d").remove();
    $('.locations').remove();
    $('#containerCan2').css("cursor","pointer");

    camera2 = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 10000);
    camera2.position.z = 1000;

    scene2 = new THREE.Scene();

	X2 = 33, Y2 = 27;
        particles2 = new Array(X2);
            for( var i = 0; i < X2; i++){
                particles2[i] = new Array();
            }
        
            spacing2 = Math.floor(window.innerWidth / X2 * 1.5);

            for (var ix = 0; ix < X2; ix++) {
                for (var iy = 0; iy < Y2; iy++) {
                    
                    var material2 = new THREE.SpriteCanvasMaterial({
                        color: "rgb(0, 0, 0)",
                        program: function(context) {
                            context.beginPath();
                            context.rect(0, 0 , (window.innerWidth / X2), window.innerHeight / (Y2*2));
                            context.fill();
                            


                        }

                    });
                    

                    particle2 = particles2[ix][iy] = new THREE.Sprite(material2);
                    particle2.position.x = ix * spacing2 - ((X2 * spacing2) / 2) + 50;
                    particle2.position.y = -700 + (50*iy);
                    //particle.position.z = iy - ((Y) / 2);
                    if( ix !== (X2-2))
                        scene2.add(particle2);
            

                }

            }
            renderer2 = new THREE.CanvasRenderer();
            renderer2.setClearColor(canvasColor, 1);
            container2.appendChild(renderer2.domElement);
}

//Third Visualizer: Web Type
function vizThree(PI2, canvasColor){
 	container3 = document.createElement('div');
    container3.id = 'containerCan3';
   	container3.title = 'Click to go to the Visualizer!';
    container3.onclick = function(){
        window.open("http://webvisualizer.herokuapp.com");
    };
    $('#mid').append(container3);
    $('#containerCan3').css("cursor","pointer");

    camera3 = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 10000);
    camera3.position.z = 1000;

    scene3 = new THREE.Scene();

    X3 = 500, Y3 = 1;

	particles3 = new Array(X3);
	for (var i = 0; i < X3; i++) {
		particles3[i] = new Array();
	}

	spacing3 = Math.floor(window.innerWidth / X3 * .75);
	radius = (spacing3 - ((X3 * spacing3) / 2));
	camera3 = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 1, 10000);
	camera3.position.z = 1000;
	scene3 = new THREE.Scene();
	var color = Math.ceil(Math.random() * (255 - 50) + 1);;
	var colored3 = rainbowColors(color, Y)
	var geometry = new THREE.Geometry();
	for (var ix = 0; ix < X3; ix++) {
		for (var iy = 0; iy < Y3; iy++) {
			if (ix % 25 === 0) {
				color -= 25;
				colored3 = rainbowColors(color, Y3)
				radius = radius * 1.25;
			}
			var material3 = new THREE.SpriteCanvasMaterial({
				color: colored3.toString(),
				program: function(context) {
					context.beginPath();
					context.arc(0, 0, 0.5, 0, PI2, true);
					context.fill();

				}

			});

			particle3 = particles3[ix][iy] = new THREE.Sprite(material3);

			particle3.position.x = ix + radius * Math.cos(angle);
			particle3.position.y = iy + radius * Math.sin(angle);
			particle3.position.z = iy - ((Y3) / 2);
			particle3.scale.x = particle3.scale.y = 18;

			scene3.add(particle3);
			geometry.vertices.push(particle3.position);
			angle += 15 * Math.PI / 180;

		}

	}

	var lines = new THREE.Line(geometry, new THREE.LineBasicMaterial({
		color: 0xffffff,
		opacity: 0.5
	}));
	scene3.add(lines);


    
    renderer3 = new THREE.CanvasRenderer();
   	renderer3.setClearColor(canvasColor, 1);
    container3.appendChild(renderer3.domElement);
}


// Records mouse positions on Mouse events (hover)
function onDocumentMouseMove(event) {

    mouseX = event.clientX - windowHalfX;
    mouseY = event.clientY - windowHalfY;

}

function onDocumentTouchStart(event) {

    if (event.touches.length === 1) {

        event.preventDefault();

        mouseX = event.touches[0].pageX - windowHalfX;
        mouseY = event.touches[0].pageY - windowHalfY;

    }

}

function onDocumentTouchMove(event) {

    if (event.touches.length === 1) {

        event.preventDefault();

        mouseX = event.touches[0].pageX - windowHalfX;
        mouseY = event.touches[0].pageY - windowHalfY;

    }

}

// Animates the Canvas
function animate( state ) {

    requestAnimationFrame(animate);
    render( );

}

function render(  ) {

       	updatePositions();
        barRender( false );
        webRender();
}

function barRender( rocker ){
        var data = new Uint8Array(sampleSize);
        analysizer.getByteFrequencyData(data);

        var sampleRate = Math.floor(sampleSize / X2);
        var val;
        var maxCap = 250;
        camera2.position.x += (mouseX - camera2.position.x) * .05;
        camera2.position.y += (-mouseY - camera2.position.y) * .05;
        camera2.lookAt(scene.position);
        var colored = 40;
        for (var ix = 0; ix < (X2-1); ix++) {
            for (var iy = 0; iy < Y2; iy++) {
                val = data[ix + sampleRate];
    
                var percentage = ( val / maxCap);
                var position = Math.round( Y2 * percentage);
                var colorInit = Math.round( 13 * percentage);

                if( position == iy)
                    particles2[ix][iy].material.color.set(rainbowColors(40-colorInit, 1));
                else if( iy > position)
                    particles2[ix][iy].material.color.set("rgb(0,0,0)");
                else
                    particles2[ix][iy].material.color.set( rainbowColors(colored, 1));
                    if( iy % 2 == 0)
                    colored--;

                if( rocker === true ){
                    var currentSeconds = Date.now();
                    camera2.rotation.x = Math.sin( currentSeconds * 0.0005 ) * 0.2;
                    camera2.rotation.y = Math.sin( currentSeconds * 0.0003 ) * 0.2;
                    
                }
            }
            colored = 40;
        }       
        renderer2.render(scene2, camera2);
}


function webRender() {
	var data = new Uint8Array(sampleSize);
	analysizer.getByteFrequencyData(data);
	angle = 15 * Math.PI / 180;
	var sampleRate = Math.floor(sampleSize / X3);
	radius = (spacing3 - ((X3 * spacing3) / 2));
	camera3.position.x += (mouseX - camera.position.x) * .05;
	camera3.position.y += (-mouseY - camera.position.y) * .05;
	camera3.lookAt(scene3.position);

	for (var ix = 0; ix < X3; ix++) {
		for (var iy = 0; iy < Y3; iy++) {
			val = data[ix + sampleRate] / 1000;
			if (ix % 26 === 0)
				radius = radius * 1.25;
			if( val < .10){
				particles3[ix][iy].position.x = ((val/2) * radius) * Math.cos(angle);
				particles3[ix][iy].position.y = ((val/2) * radius) * Math.sin(angle);
			}
			else if( val > 0.10 && val < .20){
				particles3[ix][iy].position.x = (val * radius) * Math.cos(angle);
				particles3[ix][iy].position.y = (val * radius) * Math.sin(angle);
			}
			else{
				particles3[ix][iy].position.x = ((1.5*val) * radius) * Math.cos(angle);
				particles3[ix][iy].position.y = ((1.5*val) * radius) * Math.sin(angle);
			}

			angle += 15 * Math.PI / 180;
		}
	}

	var currentSeconds = Date.now();
	camera3.rotation.x = Math.sin(currentSeconds * 0.0005) * 0.2;
	camera3.rotation.y = Math.sin(currentSeconds * 0.0003) * 0.2;
	camera3.rotation.z = Math.sin(currentSeconds * 0.0003) * 0.8;

	renderer3.render(scene3, camera3);
}

function updatePositions() {

    var data = new Uint8Array(sampleSize);
    analysizer.getByteFrequencyData(data);

    var sampleRate = Math.floor(sampleSize / Math.max(X, Y));

    var i = 0;

    for (var ix = 0; ix < X; ix++) {
        for (var iy = 0; iy < Y; iy++) {
            var xX =(600 - data[ix + sampleRate] * 4);
            particle = particles[i++];
            particle.position.y = xX;

        }

    }

    renderer.render(scene, camera);

}

// Produces the next RGB color value for any given color (recursion returns a gradient)
function rainbowColors(n, step) {
    var i = (n * 255 / step);
    var r = Math.round(Math.sin(0.024 * i + 0) * 127 + 128);
    var g = Math.round(Math.sin(0.024 * i + 2) * 127 + 128);
    var b = Math.round(Math.sin(0.024 * i + 4) * 127 + 128);

    return 'rgb(' + r + ',' + g + ',' + b + ')';

};
