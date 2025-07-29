<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
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

          <?php

          if(isset($_POST['atras']))
          {
               header('Location: index.php');
          }

          include '../BaseDeDatos.php';

          $bd = new BaseDeDatos();

          $data=$bd->obtenerSolicitudesDeCompraHardware();

          echo '<ul class="list-group">';

          for ($cont=0;$cont<count($data);$cont++)
          {
            echo '<li class="list-group-item list-group-item-primary">';

            echo "Usuario/email: ".$data[$cont]['email_nombre_usuario']."<br>";
            echo "Producto hardware: ".$bd->obtenerProductoHardwarePorID($data[$cont]['id_producto_hardware'])['nombre']."<br>";
            echo "Fecha y hora: ".$data[$cont]['fecha_y_hora']."<br>";            

            echo "<br><br>";

            echo "</li>";
          }

          echo "</ul>";        

          ?>

          <form action="solicitudes_de_compra_hardware.php" method="post">

            <button type="submit" class="btn btn-primary btn-block" name="atras" >Atrás</button>
            
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