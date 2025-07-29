<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="../boostrup/css/bootstrap.min.css">	
	<link rel="stylesheet" type="text/css" href="estilo.css">	
</head>
<body>

 <div class="container-fluid">

  <div class="row">
    <div class="col-10 offset-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4 mt-5">

      <div class="card">
        <div class="card-body">
          <form action="index.php" method="post">

            <?php

            session_start();

            if (isset($_POST['usuario_email_administrador']) && isset($_POST['contrasenya']))
            {

              include '../BaseDeDatos.php';
              $db = new BaseDeDatos();

              if ($db->buscar_usuario_administrador($_POST['usuario_email_administrador'], $_POST['contrasenya']))
              {
                  $_SESSION['logueado_como_administrador_planetaria_de_teleturismo']=true;
                  $_SESSION['usuario_email_administrador']=$_POST['usuario_email_administrador'];
                  $_SESSION['contrasenya']=$_POST['contrasenya'];
              }
            }

            if (isset($_SESSION['logueado_como_administrador_planetaria_de_teleturismo']) and ($_SESSION['logueado_como_administrador_planetaria_de_teleturismo']==true)) include 'logueado.php';            
            else include 'no_logueado.php';            

            ?>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>  


  <script src="../jquery-3.3.1.slim.min.js"></script>
  <script src="../boostrup/popper.min.js"></script>
  <script src="../boostrup/js/bootstrap.min.js"></script>  

</body>
</html>