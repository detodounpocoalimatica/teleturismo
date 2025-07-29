<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="boostrup/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="estilo.css">	
	
</head>
<body>

       <?php

            session_start();

            if (isset($_SESSION['solicitud_de_informacion']))
            {
              if ($_SESSION['solicitud_de_informacion']=="ok") echo "<script>alert('Su mensaje ha sido almacenado correctamente');</script>";
              else echo "<script>alert('Error al almacenar mensaje');</script>";
              unset($_SESSION['solicitud_de_informacion']);
            }

       ?>

    <div class="contenedor">      
      <nav>
        <ul id="menu_de_la_cabecera">   
          <li><a class="enlaces_de_la_cabecera" href="index.html" >INICIO</a></li>
          <li><a class="enlaces_de_la_cabecera" href="tecnoexcursiones.php" >TECNOEXCURSIONES</a></li>
          <li><a class="enlaces_de_la_cabecera" href="login.php" >LOGIN</a></li>
          <li><a class="enlaces_de_la_cabecera" href="registro.html" >REGISTRO</a></li>
          <li><a id="li_activo" class="enlaces_de_la_cabecera" href="contacto.php" >CONTACTO</a></li>         
        </ul>
      </nav>
    </div>  

 <div class="container-fluid">
  <div class="row">
    <div class="col-10 offset-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-5">

      <div class="card">
        <div class="card-body">

        	<a class="enlace" href="mailto:elgladiadordelcielo@gmail.com">Escribenos al email: elgladiadordelcielo@gmail.com</a><br>
        	<a class="enlace" href="tel:684009011">LLamanos al teléfono: 684009011</a>

          <form action="contacto2.php" method="post" id="contacto">
          	<div class="form-group form-check">

            </div>
            <div class="form-group">
              <label for="nombre"><b>Nombre</b></label>
              <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="Nombre">              
            </div>

            <div class="form-group">
              <label for="apellidos"><b>Apellidos</b></label>
              <input type="text" class="form-control" id="apellidos" placeholder="Apellidos" name="Apellidos">
            </div>
  
            <div class="form-group">
              <label for="direccion"><b>Dirección</b></label>
              <input type="text" class="form-control" id="direccion" placeholder="Dirección" name="Direccion">              
            </div>

            <div class="form-group">
              <label for="telefono"><b>Teléfono</b></label>
              <input type="tel" class="form-control" id="telefono" placeholder="Teléfono" name="Telefono">              
            </div>

            <div class="form-group">
              <label for="email"><b>Email (Será el Usuario si te registras)</b></label>
              <input type="email" class="form-control" id="email" placeholder="Email" name="Email">              
            </div>

            <div class="form-group">
              <label for="contrasenya"><b>Contraseña (Soló si desea registrarse al mismo tiempo)</b></label>
              <input type="password" class="form-control" id="contrasenya" placeholder="Contraseña" name="Contrasenya">              
            </div>

            <div class="form-group">
              <label for="contrasenya2"><b>Repetir Contraseña (Soló si desea registrarse al mismo tiempo)</b></label>
              <input type="password" class="form-control" id="contrasenya2" placeholder="Contraseña" name="Contrasenya2">              
            </div>

            <div class="form-group">
			       <label for="area_de_texto"><b>Escribe aquí lo que deseas contarnos: </b></label>
             <textarea class="form-control" id="area_de_texto" rows="3" name="Textarea"></textarea>
            </div>

            <div class="form-group form-check"></div>            
            <input type="checkbox" name="checkbox_recibir_informacion" id="checkbox_recibir_informacion" checked>Deseo recibir información sobre novedades y ofertas<br><br>

            <div class="form-group form-check"></div>            
            <input type="checkbox" id="checkbox_registro" name="checkbox_registro">Deseo que estos datos sirvan también para registrarme<br><br>

            <div class="form-group form-check"> </div>
            <input type="checkbox" id="checkbox_he_leido" name="checkbox_he_leido"> He leido: Sus satos no serán leídos/copiados ni usados por terceros para nada ajeno a la WEB ni al objetivo de la misma. Cumplimos con la ley de protección de datos<br><br>

            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
            <div class="form-group form-check">

            </div>
            <div class="form-group form-check">

            </div>
          </form>        				

					<div class="d-flex justify-content-star" style="font-size: 60px">
						
						<a class="fa fa-youtube text-dark ml-5"></a>
						<a class="fa fa-facebook text-dark ml-5"></a>
						<a class="fa fa-twitter text-dark ml-5"></a>
						<a class="fa fa-pinterest text-dark ml-5"></a>
						<a class="fa fa-instagram text-dark ml-5"></a>
						
					</div>

				
        </div>
      </div>

    </div>
  </div>
</div>  


  <script src="jquery-3.3.1.js"></script>
  <script src="mi_javascript_contacto.js"></script>
  <script src="js.cookie.js"></script>
  <script src="cookies.js"></script>
  <script src="boostrup/popper.min.js"></script>
  <script src="boostrup/js/bootstrap.min.js"></script>  

</body>
</html>