<?php

session_start();

if(!$_SESSION["validar"]){
	header("location:index.php?action=ingresar");
	exit();
}
?>

<center><h1>Carreras</h1></center>
			
<?php

	$vistaUsuario = new Controlador_MVC();
	$vistaUsuario -> vistaCarrerasController();
	$vistaUsuario -> deleteCarreraController();

	if(isset($_GET["action"])){

	if($_GET["action"] == "cambio"){
		echo "Cambio Exitoso";
	}
}
?>