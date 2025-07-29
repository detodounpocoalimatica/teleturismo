<?php

session_start();

include 'BaseDeDatos.php';

$db = new BaseDeDatos();

$db->insertar_tarjeta($_POST['numero_de_tarjeta'], $_POST['anyo_de_caducidad'], $_POST['mes_de_caducidad'], $_POST['numero_secreto'], $_POST['titular_de_la_tarjeta']);

if ($_SESSION['compra_harware']=="One Plus 6 Black Mirror") $db->solicitud_de_compra_hardware($_SESSION['usuario_email'], 1);
else if ($_SESSION['compra_harware']=="MSI GT75 Titan") $db->solicitud_de_compra_hardware($_SESSION['usuario_email'], 2);
else if ($_SESSION['compra_harware']=="GA-X99-SOC Champion") $db->solicitud_de_compra_hardware($_SESSION['usuario_email'], 3);
else if ($_SESSION['compra_harware']=="Nvidia Geforce GTX 1080 TI") $db->solicitud_de_compra_hardware($_SESSION['usuario_email'], 4);

header('Location: tecnoexcursiones.php');
?>