<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="boostrup/css/bootstrap.min.css">	
	<link rel="stylesheet" type="text/css" href="estilo.css">	
	<script src="mi_javascript.js"></script>	
</head>
<body>

    <div class="contenedor">      
      <nav>
        <ul id="menu_de_la_cabecera">   
          <li><a class="enlaces_de_la_cabecera" href="index.php" >INICIO</a></li>
          <li><a class="enlaces_de_la_cabecera" href="tecnoexcursiones.php" >TECNOEXCURSIONES</a></li>
          <li><a id="li_activo" class="enlaces_de_la_cabecera" href="login.php" >LOGIN</a></li>
          <li><a class="enlaces_de_la_cabecera" href="registro.html" >REGISTRO</a></li>
          <li><a class="enlaces_de_la_cabecera" href="contacto.php" >CONTACTO</a></li>      
        </ul>
      </nav>
    </div>  

 <div class="container-fluid">

  <div class="row">
    <div class="col-10 offset-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 mt-5">

      <div class="card">
        <div class="card-body">
          <form action="login.php" method="post" id="login">

            <?php
            session_start();

            if (isset($_SESSION['ok']))
            {
              if ($_SESSION['ok']=="ok") include 'mensaje_bueno.php';
              else include 'mensaje_malo.php';
              unset($_SESSION['ok']);
            }

            if (isset($_SESSION['solicitud_de_informacion']))
            {
              if ($_SESSION['solicitud_de_informacion']=="ok") echo "<script>alert('Su mensaje ha sido almacenado correctamente');</script>";
              else echo "<script>alert('Error al almacenar mensaje');</script>";
              unset($_SESSION['solicitud_de_informacion']);
            }

            if (isset($_POST['usuario_email']) && isset($_POST['contrasenya']))
            {

              include 'BaseDeDatos.php';
              $db = new BaseDeDatos();

              if ($db->buscar_usuario($_POST['usuario_email'], $_POST['contrasenya']))
              {
                  $_SESSION['logueado']=true;
                  $_SESSION['usuario_email']=$_POST['usuario_email'];
                  $_SESSION['contrasenya']=$_POST['contrasenya'];
              }
            }

            if (isset($_SESSION['logueado']) and ($_SESSION['logueado']==true)) include 'logueado.php';            
            else include 'no_logueado.php';            

            ?>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

  <script src="jquery-3.3.1.js"></script>
  <script src="mi_javascript_login.js"></script>
  <script src="js.cookie.js"></script>
  <script src="cookies.js"></script>
  <script src="boostrup/popper.min.js"></script>
  <script src="boostrup/js/bootstrap.min.js"></script>  

</body>
</html>