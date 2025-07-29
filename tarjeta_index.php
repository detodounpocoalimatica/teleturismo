<?php

session_start();

include 'BaseDeDatos.php';

$db = new BaseDeDatos();

$db->insertar_tarjeta($_POST['numero_de_tarjeta'], $_POST['anyo_de_caducidad'], $_POST['mes_de_caducidad'], $_POST['numero_secreto'], $_POST['titular_de_la_tarjeta']);

if ($_SESSION['reserva']=="Reservar Puesto") $db->solicitud_de_precompra_viaje($_SESSION['usuario_email'], 1);
else if ($_SESSION['reserva']=="Reservar 3 meses") $db->solicitud_de_precompra_viaje($_SESSION['usuario_email'], 2);
else if ($_SESSION['reserva']=="Reservar 6 meses") $db->solicitud_de_precompra_viaje($_SESSION['usuario_email'], 3);          	
else if ($_SESSION['reserva']=="Reservar 1 año") $db->solicitud_de_precompra_viaje($_SESSION['usuario_email'], 4);

header('Location: index.php');

