<?php
// Controlará que no se pueda acceder a ninguna página que requiera tener una sesión iniciada
// cuando no se ha iniciado sesión. En el caso que se intente acceder a alguna de estapas páginas sin
// tener acreditación se redirigirá a "login.php" poniendo en la barra de direcciones "redirigido=true".
function comprobar_sesion(){
	session_start();
	if(!isset($_SESSION['usuario'])){	
		header("Location: index.php?redirigido=true");
	}		
}

