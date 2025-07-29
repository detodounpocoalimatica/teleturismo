<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.25, maximum-scale=0.25>
	<meta name="authoring-tool" content="Adobe_Animate_CC">
	<title>index</title>

	<?php
	session_start();

	if (isset($_SESSION['reserva']))
	{
		if ($_SESSION['reserva']=="Reservar Puesto") echo '<script>alert("Su puesto ha sido reservado correctamente");</script>';             	
    	else if ($_SESSION['reserva']=="Reservar 3 meses") echo '<script>alert("Su reserva de 3 meses se realizó correctamente");</script>';    	
    	else if ($_SESSION['reserva']=="Reservar 6 meses") echo '<script>alert("Su reserva de 6 meses se realizó correctamente");</script>';
    	else if ($_SESSION['reserva']=="Reservar 1 año") echo '<script>alert("Su reserva de 1 año se realizó correctamente");</script>';
    	$_SESSION['reserva']="";
	}

	if(isset($_POST['reservar_puesto'])) reservar("Reservar Puesto");	

	if(isset($_POST['reservar_3_meses'])) reservar("Reservar 3 meses");

	if(isset($_POST['reservar_6_meses'])) reservar("Reservar 6 meses");

	if(isset($_POST['reservar_1_anyo'])) reservar("Reservar 1 año");

	function reservar($reserva)
	{		
        if (isset($_SESSION['logueado']) and ($_SESSION['logueado']==true))
        {
			$_SESSION['reserva']=$reserva; 			

 			include 'BaseDeDatos.php';
            $db = new BaseDeDatos();
            if ($db->buscar_tarjetas_de_usuario($_SESSION['usuario_email']))
            {
            	if ($reserva=="Reservar Puesto")
            	{
            		$db->solicitud_de_precompra_viaje($_SESSION['usuario_email'], 1);
            		echo '<script>alert("Su puesto ha sido reservado correctamente");</script>';
            	}           	
            	else if ($reserva=="Reservar 3 meses")
            	{
            		$db->solicitud_de_precompra_viaje($_SESSION['usuario_email'], 2);
            		echo '<script>alert("Su reserva de 3 meses se realizó correctamente");</script>';
            	}           	
            	else if ($reserva=="Reservar 6 meses")
            	{
					$db->solicitud_de_precompra_viaje($_SESSION['usuario_email'], 3);
					echo '<script>alert("Su reserva de 6 meses se realizó correctamente");</script>';
            	}            	
            	else if ($reserva=="Reservar 1 año")
            	{
					$db->solicitud_de_precompra_viaje($_SESSION['usuario_email'], 4);
					echo '<script>alert("Su reserva de 1 año se realizó correctamente");</script>';
            	}
            }
            else
            {
            	header('Location: tarjeta_index.html');
            }
        }
        else echo '<script>alert("Es necesario loguerse para poder realizar una reserva");</script>';
	}

	?>

	<style>
	#animation_container
	{
		margin:auto;
	}
</style>

<link rel="stylesheet" href="boostrup/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="estilo.css">
<link rel="stylesheet" type="text/css" href="cookies.css">

<script src="createjs-2015.11.26.min.js"></script>
<script src="index.js?1531083106861"></script>
<script>
	var canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
	function init() {
		canvas = document.getElementById("canvas");
		anim_container = document.getElementById("animation_container");
		dom_overlay_container = document.getElementById("dom_overlay_container");
		var comp=AdobeAn.getComposition("A9A45CB02CD3804F99DC7FDA95CD6CBC");
		var lib=comp.getLibrary();
		var loader = new createjs.LoadQueue(false);
		loader.installPlugin(createjs.Sound);
		loader.addEventListener("fileload", function(evt){handleFileLoad(evt,comp)});
		loader.addEventListener("complete", function(evt){handleComplete(evt,comp)});
		var lib=comp.getLibrary();
		loader.loadManifest(lib.properties.manifest);
	}
	function handleFileLoad(evt, comp) {
		var images=comp.getImages();	
		if (evt && (evt.item.type == "image")) { images[evt.item.id] = evt.result; }	
	}
	function handleComplete(evt,comp) {
	//This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
	var lib=comp.getLibrary();
	var ss=comp.getSpriteSheet();
	var queue = evt.target;
	var ssMetadata = lib.ssMetadata;
	for(i=0; i<ssMetadata.length; i++) {
		ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
	}
	exportRoot = new lib.index();
	stage = new lib.Stage(canvas);	
	//Registers the "tick" event listener.
	fnStartAnimation = function() {
		stage.addChild(exportRoot);
		createjs.Ticker.setFPS(lib.properties.fps);
		createjs.Ticker.addEventListener("tick", stage)
		stage.addEventListener("tick", handleTick)
		function handleTick(event) {
			var cameraInstance = exportRoot.___camera___instance;
			if(cameraInstance)
			{
				var stageCenter = { 'x' : lib.properties.width/2, 'y' : lib.properties.height/2 };
				if(cameraInstance._off != null && cameraInstance._off == true)
					exportRoot.transformMatrix = new createjs.Matrix2D();
				else
				{
					if(cameraInstance.pinToObject !== undefined)
					{
						cameraInstance.x = cameraInstance.pinToObject.x + cameraInstance.pinToObject.pinOffsetX;
						cameraInstance.y = cameraInstance.pinToObject.y + cameraInstance.pinToObject.pinOffsetY;
					}
					var mat = cameraInstance.getMatrix();
					mat.tx -= stageCenter.x;
					mat.ty -= stageCenter.y;
					var inverseMat = mat.invert();
					inverseMat.prependTransform(stageCenter.x, stageCenter.y, 1, 1, 0, 0, 0, 0, 0);
					inverseMat.appendTransform(-stageCenter.x, -stageCenter.y, 1, 1, 0, 0, 0, 0, 0);
					exportRoot.transformMatrix = inverseMat;
				}
			}
		}
	}	    
	//Code to support hidpi screens and responsive scaling.
	function makeResponsive(isResp, respDim, isScale, scaleType) {		
		var lastW, lastH, lastS=1;		
		window.addEventListener('resize', resizeCanvas);		
		resizeCanvas();		
		function resizeCanvas() {			
			var w = lib.properties.width, h = lib.properties.height;			
			var iw = window.innerWidth, ih=window.innerHeight;			
			var pRatio = window.devicePixelRatio || 1, xRatio=iw/w, yRatio=ih/h, sRatio=1;			
			if(isResp) {                
				if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {                    
					sRatio = lastS;                
				}				
				else if(!isScale) {					
					if(iw<w || ih<h)						
						sRatio = Math.min(xRatio, yRatio);				
				}				
				else if(scaleType==1) {					
					sRatio = Math.min(xRatio, yRatio);				
				}				
				else if(scaleType==2) {					
					sRatio = Math.max(xRatio, yRatio);				
				}			
			}			
			canvas.width = w*pRatio*sRatio;			
			canvas.height = h*pRatio*sRatio;
			canvas.style.width = dom_overlay_container.style.width = anim_container.style.width =  w*sRatio+'px';				
			canvas.style.height = anim_container.style.height = dom_overlay_container.style.height = h*sRatio+'px';
			stage.scaleX = pRatio*sRatio;			
			stage.scaleY = pRatio*sRatio;			
			lastW = iw; lastH = ih; lastS = sRatio;            
			stage.tickOnUpdate = false;            
			stage.update();            
			stage.tickOnUpdate = true;		
		}
	}
	makeResponsive(true,'width',true,1);	
	AdobeAn.compositionLoaded(lib.properties.id);
	fnStartAnimation();
}
function playSound(id, loop) {
	return createjs.Sound.play(id, createjs.Sound.INTERRUPT_EARLY, 0, 0, loop);
}
</script>
<!-- write your code here -->
</head>
<body onload="init();" style="margin:0px;">

	<div class="contenedor">			
		<nav>
			<ul id="menu_de_la_cabecera">		
				<li><a id="li_activo" class="enlaces_de_la_cabecera" href="index.php" >INICIO</a></li>
				<li><a class="enlaces_de_la_cabecera" href="tecnoexcursiones.php" >TECNOEXCURSIONES</a></li>
				<li><a class="enlaces_de_la_cabecera" href="login.php" >LOGIN</a></li>
				<li><a class="enlaces_de_la_cabecera" href="registro.html" >REGISTRO</a></li>
				<li><a class="enlaces_de_la_cabecera" href="contacto.php" >CONTACTO</a></li>						
			</ul>
		</nav>
	</div>


	<div id="animation_container" style="background-color:rgba(255, 255, 255, 1.00); width:1920px; height:606px">
		<canvas id="canvas" width="1920" height="606" style="position: absolute; display: block; background-color:rgba(255, 255, 255, 1.00);"></canvas>
		<div id="dom_overlay_container" style="pointer-events:none; overflow:hidden; width:1920px; height:606px; position: absolute; left: 0px; top: 0px; display: block;">
		</div>
	</div>

	<form action="index.php" method="post">
		<div class="container-fluid">

			<div class="row">

				<div class="col-12 col-sm-6 col-md-4 col-lg-3">

					<div class="row">
						<div class="offset-1 col-10">				

							<div class="card bg-transparent">
								<img class="card-img-top" src="images/robot1.png" alt="Card image cap">
								<div class="card-body">
									<h5 class="card-title blanco"><b>Reserva puesto</b></h5>
									<p class="card-text alto blanco">Reserva tu puesto en la cola para probar antes que nadie nuestros viajes desde casa, en caso de que realices un prepago recivirás un 20% de descuento</p>							
								</div>
								<button type="submit" class="btn btn-primary btn-lg" name="reservar_puesto">Reserva puesto</button>
							</div>

						</div>

					</div>

				</div>

				<div class="col-12 col-sm-6 col-md-4 col-lg-3">

					<div class="row">
						<div class="offset-1 col-10">
							<div class="card bg-transparent">
								<img class="card-img-top" src="images/robot2.png" alt="Card image cap">
								<div class="card-body">
									<h5 class="card-title blanco"><b>Reserva 3 meses</b></h5>
									<p class="card-text alto blanco">Reserva ya 3 meses de servicio y obtiene un 30% de descuesnto</p>
								</div>
								<button type="submit" class="btn btn-primary btn-lg" name="reservar_3_meses">Reserva 3 meses</button>
							</div>

						</div>

					</div>

				</div>

				<div class="col-12 col-sm-6 col-md-4 col-lg-3">

					<div class="row">
						<div class="offset-1 col-10">

							<div class="card bg-transparent">
								<img class="card-img-top" src="images/robot3.png" alt="Card image cap">
								<div class="card-body">
									<h5 class="card-title blanco"><b>Reserva 6 meses</b></h5>
									<p class="card-text alto blanco">Reserva ya 6 meses de servicio y obtiene un 40% de descuesnto</p>			
								</div>
								<button type="submit" class="btn btn-primary btn-lg" name="reservar_6_meses">Reserva 6 meses</button>							
							</div>

						</div>

					</div>

				</div>    

				<div class="col-12 col-sm-6 col-md-4 col-lg-3">

					<div class="row">
						<div class="offset-1 col-10">

							<div class="card bg-transparent">
								<img class="card-img-top" src="images/robot4.png" alt="Card image cap">
								<div class="card-body">
									<h5 class="card-title blanco"><b>Reserva 1 año</b></h5>
									<p class="card-text alto blanco">Reserva ya 1 año de servicio y obtiene un 50% de descuesnto</p>			
								</div>
								<button type="submit" class="btn btn-primary btn-lg" name="reservar_1_anyo">Reserva 1 año</button>							
							</div>

						</div>

					</div>

				</div>

			</div> 

		</div>

	</form>

	<script src="jquery-3.3.1.js"></script>
	<script src="js.cookie.js"></script>
	<script src="cookies.js"></script>
	<script src="boostrup/popper.min.js"></script>
	<script src="boostrup/js/bootstrap.min.js"></script>

</body>
</html>