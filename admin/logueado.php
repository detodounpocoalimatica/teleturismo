<div class="form-group">
	<div class="alert alert-primary" role="alert">
		Estás logueado con el usuario:
		<?php            		
			echo $_SESSION['usuario_email_administrador'];
		?>
	</div>            	
</div>
<div class="form-group form-check">
</div>
<button type="submit" class="btn btn-primary btn-block" name="visualizar_usuarios">Visualizar usuarios registrados</button>
<button type="submit" class="btn btn-primary btn-block" name="visualizar_peticiones">Visualizar peticiones de información</button>
<button type="submit" class="btn btn-primary btn-block" name="solicitudes_de_precompra_viajes">Solicitudes de Precompra Viajes</button>
<button type="submit" class="btn btn-primary btn-block" name="solicitudes_de_compra_hardware">Solicitudes de Compra Hardware</button>
<button type="submit" class="btn btn-primary btn-block" name="desloguerarse">Desloguearse</button>           

<?php
	if(isset($_POST['desloguerarse']))
    {
   		$_SESSION['logueado_como_administrador_planetaria_de_teleturismo']=false;
   		header('Location: index.php');
	}
    else if(isset($_POST['visualizar_usuarios'])) header('Location: visualizar_usuarios.php');
    else if(isset($_POST['visualizar_peticiones'])) header('Location: visualizar_peticiones.php');
    else if(isset($_POST['solicitudes_de_precompra_viajes'])) header('Location: solicitudes_de_precompra_viajes.php');
    else if(isset($_POST['solicitudes_de_compra_hardware'])) header('Location: solicitudes_de_compra_hardware.php');
?>