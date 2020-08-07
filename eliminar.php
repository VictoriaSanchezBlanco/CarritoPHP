<?php 
/*comprueba que el usuario haya abierto sesión o redirige*/
require_once 'controlPHP/controlSessions/sesiones.php';
comprobar_sesion();
$cod = $_POST['codigoDelProducto'];
$unidades = $_POST['unidades'];

// Si existe el código restamos las unidades, con mínimo de 0
if(isset($_SESSION['carrito'][$cod])){		
	$_SESSION['carrito'][$cod] -= $unidades;

	if($_SESSION['carrito'][$cod] <= 0){
		unset($_SESSION['carrito'][$cod]);
	}

}
header("Location: carrito.php");
