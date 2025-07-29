<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=0.25, maximum-scale=0.25>
<meta name="authoring-tool" content="Adobe_Animate_CC">
<title>tecnoexcursiones</title>

	<?php

	session_start();

	if (isset($_SESSION['compra_harware']))
	{
		if ($_SESSION['compra_harware']=="One Plus 6 Black Mirror") echo '<script>alert("Hemos registrado su compra de One Plus 6 Black Mirror");</script>';
    	else if ($_SESSION['compra_harware']=="MSI GT75 Titan") echo '<script>alert("Hemos registrado su compra de MSI GT75 Titan");</script>'; 
    	else if ($_SESSION['compra_harware']=="GA-X99-SOC Champion") echo '<script>alert("Hemos registrado su compra de GA-X99-SOC Champion");</script>';
    	else if ($_SESSION['compra_harware']=="Nvidia Geforce GTX 1080 TI") echo '<script>alert("Hemos registrado su compra de Nvidia Geforce GTX 1080 TI");</script>';
    	$_SESSION['compra_harware']="";
	}

	if(isset($_POST['One_Plus_6_Black_Mirror'])) comprar_harware("One Plus 6 Black Mirror");	

	if(isset($_POST['MSI_GT75_Titan'])) comprar_harware("MSI GT75 Titan");

	if(isset($_POST['GA-X99-SOC_Champion'])) comprar_harware("GA-X99-SOC Champion");

	if(isset($_POST['Nvidia_Geforce_GTX_1080_TI'])) comprar_harware("Nvidia Geforce GTX 1080 TI");

	function comprar_harware($compra_harware)
	{		
        if (isset($_SESSION['logueado']) and ($_SESSION['logueado']==true))
        {
			$_SESSION['compra_harware']=$compra_harware; 			

 			include 'BaseDeDatos.php';
            $db = new BaseDeDatos();

            if ($db->buscar_tarjetas_de_usuario($_SESSION['usuario_email']))
            {
            	if ($compra_harware=="One Plus 6 Black Mirror")
            	{
            		$db->solicitud_de_compra_hardware($_SESSION['usuario_email'], 1);
            		echo '<script>alert("Hemos registrado su compra de One Plus 6 Black Mirror");</script>';
            	}           	
            	else if ($compra_harware=="MSI GT75 Titan")
            	{
            		$db->solicitud_de_compra_hardware($_SESSION['usuario_email'], 2);
            		echo '<script>alert("Hemos registrado su compra de MSI GT75 Titan");</script>';
            	}           	
            	else if ($compra_harware=="GA-X99-SOC Champion")
            	{
					$db->solicitud_de_compra_hardware($_SESSION['usuario_email'], 3);
					echo '<script>alert("Hemos registrado su compra de GA-X99-SOC Champion");</script>';
            	}            	
            	else if ($compra_harware=="Nvidia Geforce GTX 1080 TI")
            	{
					$db->solicitud_de_compra_hardware($_SESSION['usuario_email'], 4);
					echo '<script>alert("Hemos registrado su compra de Nvidia Geforce GTX 1080 TI");</script>';
            	}
            }
            else
            {
            	header('Location: tarjeta_tecnoexcursiones.html');
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
<script src="tecnoexcursiones.js?1531303771388"></script>

<script>
var canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
function init() {
	canvas = document.getElementById("canvas");
	anim_container = document.getElementById("animation_container");
	dom_overlay_container = document.getElementById("dom_overlay_container");
	var comp=AdobeAn.getComposition("1B00FF8C43FD3A4FBD3446E065A07CD5");
	var lib=comp.getLibrary();
	createjs.MotionGuidePlugin.install();
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
	exportRoot = new lib.tecnoexcursiones();
	stage = new lib.Stage(canvas);	
	//Registers the "tick" event listener.
	fnStartAnimation = function() {
		stage.addChild(exportRoot);
		createjs.Ticker.setFPS(lib.properties.fps);
		createjs.Ticker.addEventListener("tick", stage)
		stage.addEventListener("tick", handleTick)
		function getProjectionMatrix(totalDepth) {
			var focalLength = 528.25;
			var projectionCenter = { x : lib.properties.width/2, y : lib.properties.height/2 };
			var scale = (totalDepth + focalLength)/focalLength;
			var scaleMat = new createjs.Matrix2D;
			scaleMat.a = 1/scale;
			scaleMat.d = 1/scale;
			var projMat = new createjs.Matrix2D;
			projMat.tx = -projectionCenter.x;
			projMat.ty = -projectionCenter.y;
			projMat = projMat.prependMatrix(scaleMat);
			projMat.tx += projectionCenter.x;
			projMat.ty += projectionCenter.y;
			return projMat;
		}
		function handleTick(event) {
			var focalLength = 528.25;
			var cameraInstance = exportRoot.___camera___instance;
		if(cameraInstance !== undefined && cameraInstance.pinToObject !== undefined)
		{
			cameraInstance.x = cameraInstance.pinToObject.x + cameraInstance.pinToObject.pinOffsetX;
			cameraInstance.y = cameraInstance.pinToObject.y + cameraInstance.pinToObject.pinOffsetY;
			if(cameraInstance.pinToObject.parent !== undefined && cameraInstance.pinToObject.parent.depth !== undefined)
				cameraInstance.depth = cameraInstance.pinToObject.parent.depth + cameraInstance.pinToObject.pinOffsetZ;
		}
			for(child in exportRoot.children)
			{
				var layerObj = exportRoot.children[child];
				if(layerObj == cameraInstance)
					continue;
					if(layerObj.currentFrame != layerObj.parent.currentFrame)
					{
						layerObj.gotoAndPlay(layerObj.parent.currentFrame);
					}
				var matToApply = new createjs.Matrix2D;
				var cameraMat = new createjs.Matrix2D;
				var totalDepth = layerObj.layerDepth ? layerObj.layerDepth : 0;
				var cameraDepth = 0;
				if(cameraInstance && !layerObj.isAttachedToCamera)
				{
					var stageCenter = { 'x' : lib.properties.width/2, 'y' : lib.properties.height/2 };
					var mat = cameraInstance.getMatrix();
					mat.tx -= stageCenter.x;
					mat.ty -= stageCenter.y;
					cameraMat = mat.invert();
					cameraMat.prependTransform(stageCenter.x, stageCenter.y, 1, 1, 0, 0, 0, 0, 0);
					cameraMat.appendTransform(-stageCenter.x, -stageCenter.y, 1, 1, 0, 0, 0, 0, 0);
					if(cameraInstance.depth)
						cameraDepth = cameraInstance.depth;
				}
				if(layerObj.depth)
				{
					totalDepth = layerObj.depth;
				}
				//Offset by camera depth
				totalDepth -= cameraDepth;
				if(totalDepth < -focalLength)
				{
					matToApply.a = 0;
					matToApply.d = 0;
				}
				else
				{
					if(layerObj.layerDepth)
					{
						var sizeLockedMat = getProjectionMatrix(layerObj.layerDepth);
						if(sizeLockedMat)
						{
							sizeLockedMat.invert();
							matToApply.prependMatrix(sizeLockedMat);
						}
					}
					matToApply.prependMatrix(cameraMat);
					var projMat = getProjectionMatrix(totalDepth);
					if(projMat)
					{
						matToApply.prependMatrix(projMat);
					}
				}
				layerObj.transformMatrix = matToApply;
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
				<li><a class="enlaces_de_la_cabecera" href="index.php" >INICIO</a></li>
				<li><a id="li_activo" class="enlaces_de_la_cabecera" href="tecnoexcursiones.php" >TECNOEXCURSIONES</a></li>
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

<form action="tecnoexcursiones.php" method="post">
	<div class="container-fluid">

		<div class="row">

			<div class="col-12 col-sm-6 col-md-4 col-lg-3">

				<div class="row">
					<div class="offset-1 col-10">				

						<div class="card bg-transparent">
							<img class="card-img-top" src="images/movil_960_892.png" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title blanco alto_titulo"><b>One Plus 6 Black Mirror</b></h5>
								<p class="card-text alto blanco">6,28" OLED, (1080x2280) 8 Gb., de RAM 128 Gb. de almacenamiento, Qualcomm Snapdragon 845, Octa núcleo, 2,8 GHz.</p>							
							</div>
							<button type="submit" class="btn btn-primary btn-lg" name="One_Plus_6_Black_Mirror">Comprar</button>
						</div>

					</div>

				</div>

			</div>

			<div class="col-12 col-sm-6 col-md-4 col-lg-3">

				<div class="row">
					<div class="offset-1 col-10">

						<div class="card bg-transparent">
							<img class="card-img-top" src="images/portatil_960_892.png" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title blanco alto_titulo"><b>MSI GT75 Titan</b></h5>
								<p class="card-text alto blanco">17,3" 4K, Core i9,GTX 1080, 64Gb. DDR4, HD SSD M2 (Gen3) Samsung 960 Pro 2 Tb.</p>													
							</div>
							<button type="submit" class="btn btn-primary btn-lg" name="MSI_GT75_Titan">Comprar</button>
						</div>

					</div>

				</div>

			</div>

			<div class="col-12 col-sm-6 col-md-4 col-lg-3">

				<div class="row">
					<div class="offset-1 col-10">

						<div class="card bg-transparent">
							<img class="card-img-top" src="images/placa_base_960_892.png" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title blanco alto_titulo"><b>GA-X99-SOC Champion</b></h5>
								<p class="card-text alto blanco">FCLGA2011-3, 4 Slot PCIe 16x, 4 Slot DDR4</p>						
							</div>
							<button type="submit" class="btn btn-primary btn-lg" name="GA-X99-SOC_Champion">Comprar</button>							
						</div>

					</div>

				</div>

			</div>    

			<div class="col-12 col-sm-6 col-md-4 col-lg-3">

				<div class="row">
					<div class="offset-1 col-10">

						<div class="card bg-transparent">
							<img class="card-img-top" src="images/grafica_960_892.png" alt="Card image cap">
							<div class="card-body">
								<h5 class="card-title blanco alto_titulo"><b>Nvidia Geforce GTX 1080 TI</b></h5>
								<p class="card-text alto blanco">2 Tarjetas gráficas MSI con chips NVIDIA Geforce GTX 1080 TI conectadas por SLI</p>						
							</div>
							<button type="submit" class="btn btn-primary btn-lg" name="Nvidia_Geforce_GTX_1080_TI">Comprar</button>							
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