<?php

include 'BaseDeDatos.php';

$db = new BaseDeDatos();

session_start();

if ($db->solicitud_de_informacion($_POST['Nombre'], $_POST['Apellidos'], $_POST['Email'], $_POST['Telefono'], $_POST['Direccion'], $_POST['Textarea'], $_POST['checkbox_recibir_informacion'])) $_SESSION['solicitud_de_informacion']="ok";
else $_SESSION['solicitud_de_informacion']="ko";

if ($_POST['checkbox_registro']=="on")
{	
	if ($db->insertar_usuario($_POST['Nombre'], $_POST['Apellidos'], $_POST['Email'], $_POST['Telefono'], $_POST['Direccion'], $_POST['Contrasenya'], $_POST['Textarea'], $_POST['checkbox_recibir_informacion'])) $_SESSION['ok']="ok";
	else  $_SESSION['ok']="ko";
	header('Location: login.php');
}
else header('Location: contacto.php');

?>