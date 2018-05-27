<h1>Login Tutorias</h1>

<div class="">
	<form method="post">
		
		<input type="text" placeholder="No. de empleado" name="maestroNoIngreso" required>

		<input type="password" placeholder="Contraseña" name="maestroPasswordIngreso" required>

		<input type="submit" name="SubmitMaestro" value="Ingresar">

	</form>
</div>
	
<?php

$ingreso = new Controlador_MVC();
$ingreso -> ingresoMaestroController();

if(isset($_GET["action"])){
	if($_GET["action"] == "fallo"){
		echo "Fallo al ingresar";
	}
}

?>