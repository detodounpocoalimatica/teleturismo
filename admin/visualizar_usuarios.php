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

          <?php

          if(isset($_POST['atras']))
          {
               header('Location: index.php');
          }

          include '../BaseDeDatos.php';

          $bd = new BaseDeDatos();

          $data=$bd->obtenerUsuarios();

          echo '<ul class="list-group">';

          for ($cont=0;$cont<count($data);$cont++)
          {
            echo '<li class="list-group-item list-group-item-primary">';

            echo "Nombre: ".$data[$cont]['nombre']."<br>";
            echo "Apellidos: ".$data[$cont]['apellidos']."<br>";
            echo "Email / Usuario: ".$data[$cont]['email_nombre_usuario']."<br>";
            echo "Teléfono: ".$data[$cont]['telefono']."<br>";
            echo "Dirección: ".$data[$cont]['direccion']."<br>";
            echo "Contraseña: ".$data[$cont]['password']."<br>";

            echo "Desea recibir información: ";

            if ($data[$cont]['desea_recibir_informacion']=="on") echo "Sí"."<br>";
            else echo "No"."<br>";
            echo "Dato adicional de interes: ".$data[$cont]['dato_adicional_de_interes']."<br>";


            echo "<br><br>";

            echo "</li>";
          }

          echo "</ul>";        

          ?>

          <form action="visualizar_usuarios.php" method="post">

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