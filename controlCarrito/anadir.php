<?php 

// Comprueba que el usuario haya abierto sesión o redirige
require_once '../controlPHP/controlSessions/sesiones.php';
comprobar_sesion();

/**
 * Este archivo php se utiliza a la hora de añadir un producto al carrito en el archivo 'producto.php'. 
 * Ese archivo tiene un input con nombre 'cod' y por eso podemos recogerlo y almacenarlo en $cod. 
 */
$cod = $_POST['codigoDelProducto'];
$unidades = $_POST['unidades'];
$url = "Location: ../categorias.php?categoria=".$_POST['codigoCategoria'];


/* si existe el código sumamos las unidades*/
if(isset($_SESSION['carrito'][$cod])){
	$_SESSION['carrito'][$cod] += $unidades;
}else{
	$_SESSION['carrito'][$cod] = $unidades;		
}
header($url);
