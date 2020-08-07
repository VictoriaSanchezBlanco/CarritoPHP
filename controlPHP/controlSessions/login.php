<?php
require_once '../controlBD/bd.php';
/*formulario de login habitual
si va bien abre sesión, guarda el nombre de usuario y redirige a principal.php 
si va mal, mensaje de error */


if ($_SERVER["REQUEST_METHOD"] == "POST") {

// $usu usará la función "comprobar_usuario" que devolvera un "False" en el caso que el usuario no exista en la base de datos.
// Si el usuario existe se creara una sesión para el usuario llamado "$_SESSION['usuario']" 
// y otra para el carrito que usaremos continuamente mientras tenganos la sesión iniciada.
// Y además redirigira a categorias.php
	
    $usu = comprobar_usuario($_POST['usuario'], $_POST['clave']);
	if($usu===false){
        $usuario = $_POST['usuario'];
		header("Location: ../../index.php?error=true");
	}else{
		session_start();
		// $usu tiene campos correo y codRes, correo 
		$_SESSION['usuario'] = $usu;
		$_SESSION['carrito'] = [];
		header("Location: ../../categorias.php?categoria=3");
		return;
	}	
}
?>