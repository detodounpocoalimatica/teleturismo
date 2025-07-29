<?php

include 'config.php';

class BaseDeDatos
{
	public $conection;

	public function conectar()
	{
		$this->conection = new mysqli(SERVIDOR, USUARIO, PASSWORD, BD);
		if ($this->conection->connect_errno!=0) exit("Error al conectar");
	}

	public function desconectar()
	{
		$this->conection->close();
	}

	public function ejecutarConsulta($consulta)
	{		

		$resultado=$this->conection->query($consulta);

		if (!$resultado)
		{
			echo "Error en la consulta: ".$consulta;
		}

		return $resultado;
	}

	public function insertar_usuario($nombre, $apellidos, $usuario_email, $telefono, $direccion, $contrasenya, $textarea, $checkbox)
	{
		$this->conectar();

		$usuario_email=$this->conection->real_escape_string($usuario_email);
		$contrasenya=$this->conection->real_escape_string($contrasenya);
		$contrasenya=hash('md5', $contrasenya);

		$consulta="INSERT INTO usuario
		(nombre, apellidos, email_nombre_usuario, telefono, direccion, password, dato_adicional_de_interes, desea_recibir_informacion)
		VALUE
		('".$nombre."', '".$apellidos."', '".$usuario_email."', '".$telefono."', '".$direccion."', '".
		$contrasenya."', '".$textarea."', '".$checkbox."')";

		if ($this->ejecutarConsulta($consulta)) return true;
		else return false;

		$this->desconectar();
	}

	public function insertar_tarjeta($numero_de_tarjeta, $anyo_de_caducidad, $mes_de_caducidad, $numero_secreto, $titular)
	{

		$this->conectar();

		$consulta="INSERT INTO tarjeta
		(numero_de_tarjeta, anyo_de_caducidad, mes_de_caducidad, numero_secreto, titular)
		VALUE
		('".$numero_de_tarjeta."', '".$anyo_de_caducidad."', '".$mes_de_caducidad."', '".$numero_secreto."', '".$titular."')";

		if ($this->ejecutarConsulta($consulta)) $consulta1_correcta=true;
		else $consulta1_correcta=false;

		$consulta="INSERT INTO usuario_tarjeta
		(email_nombre_usuario, numero_de_tarjeta)
		VALUE
		('".$_SESSION['usuario_email']."', '".$numero_de_tarjeta."')";

		if ($this->ejecutarConsulta($consulta) && $consulta1_correcta) return true;
		else return false;

		$this->desconectar();
	}	

	public function solicitud_de_informacion($nombre, $apellidos, $usuario_email, $telefono, $direccion, $textarea, $checkbox)
	{
		$this->conectar();

		$usuario_email=$this->conection->real_escape_string($usuario_email);

		$consulta="INSERT INTO solicitud_de_informacion
		(nombre, apellidos, email, telefono, direccion, consulta_de_informacion, desea_recibir_informacion)
		VALUE
		('".$nombre."', '".$apellidos."', '".$usuario_email."', '".$telefono."', '".$direccion."', '".$textarea."', '".$checkbox."')";

		if ($this->ejecutarConsulta($consulta)) return true;
		else return false;

		$this->desconectar();
	}

	public function solicitud_de_precompra_viaje($email_nombre_usuario, $id_producto_viaje)
	{
		$this->conectar();

		$consulta="INSERT INTO solicitud_de_precompra_viaje
		(email_nombre_usuario, id_producto_viaje)
		VALUE
		('".$email_nombre_usuario."', '".$id_producto_viaje."')";

		if ($this->ejecutarConsulta($consulta)) return true;
		else return false;

		$this->desconectar();
	}

	public function solicitud_de_compra_hardware($email_nombre_usuario, $id_producto_hardware)
	{
		$this->conectar();

		$consulta="INSERT INTO solicitud_de_compra_hardware
		(email_nombre_usuario, id_producto_hardware)
		VALUE
		('".$email_nombre_usuario."', '".$id_producto_hardware."')";

		if ($this->ejecutarConsulta($consulta)) return true;
		else return false;

		$this->desconectar();
	}

	public function buscar_usuario_administrador($usuario, $contrasenya)
	{
		$this->conectar();

		$usuario=$this->conection->real_escape_string($usuario);
		$contrasenya=$this->conection->real_escape_string($contrasenya);

		$consulta="select * from usuario_administrador where email_nombre_usuario='".$usuario."'"." and password='".$contrasenya."'";

		$resultado= $this -> ejecutarConsulta($consulta);		

		if ($resultado->num_rows==1) return true;
		else return false; 

		$this->desconectar();				
	}

	public function buscar_tarjetas_de_usuario($usuario)
	{
		$this->conectar();

		$consulta="select * from usuario_tarjeta where email_nombre_usuario='".$usuario."'";

		$resultado= $this -> ejecutarConsulta($consulta);		

		if ($resultado->num_rows>0) return true;
		else return false; 

		$this->desconectar();				
	}	

	public function buscar_usuario($usuario, $contrasenya)
	{
		$this->conectar();

		$usuario=$this->conection->real_escape_string($usuario);
		$contrasenya=$this->conection->real_escape_string($contrasenya);
		$contrasenya=hash('md5', $contrasenya);

		$consulta="select * from usuario where email_nombre_usuario='".$usuario."'"." and password='".$contrasenya."'";

		$resultado= $this -> ejecutarConsulta($consulta);		

		if ($resultado->num_rows==1) return true;
		else return false; 

		$this->desconectar();				
	}

	public function obtenerUsuarios()
	{
		$this->conectar();

		$consulta="SELECT * FROM usuario";

		$resultado= $this -> ejecutarConsulta($consulta);		

		$datos = $resultado->fetch_all(MYSQLI_ASSOC);

		$this->desconectar();

		return $datos;		
	}

	public function obtenerSolicitudesDeInformacion()
	{
		$this->conectar();

		$consulta="SELECT * FROM solicitud_de_informacion";

		$resultado= $this -> ejecutarConsulta($consulta);		

		$datos = $resultado->fetch_all(MYSQLI_ASSOC);

		$this->desconectar();

		return $datos;		
	}

	public function obtenerSolicitudesDePrecompraViajes()
	{
		$this->conectar();

		$consulta="SELECT * FROM solicitud_de_precompra_viaje";

		$resultado= $this -> ejecutarConsulta($consulta);		

		$datos = $resultado->fetch_all(MYSQLI_ASSOC);

		$this->desconectar();

		return $datos;		
	}

	public function obtenerProductoViajePorID($id)
	{
		$this->conectar();

		$consulta="SELECT * FROM producto_viaje WHERE id=".$id;

		$resultado= $this -> ejecutarConsulta($consulta);

		$datos = $resultado->fetch_assoc();

		$this->desconectar();

		return $datos;		
	}

	public function obtenerSolicitudesDeCompraHardware()
	{
		$this->conectar();

		$consulta="SELECT * FROM solicitud_de_compra_hardware";

		$resultado= $this -> ejecutarConsulta($consulta);		

		$datos = $resultado->fetch_all(MYSQLI_ASSOC);

		$this->desconectar();

		return $datos;		
	}

	public function obtenerProductoHardwarePorID($id)
	{
		$this->conectar();

		$consulta="SELECT * FROM producto_hardware WHERE id=".$id;

		$resultado= $this -> ejecutarConsulta($consulta);

		$datos = $resultado->fetch_assoc();

		$this->desconectar();

		return $datos;		
	}
}

?>