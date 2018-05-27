<h1>REGISTRO DE MAESTROS</h1>

<form method="post">
	
	<input type="text" placeholder="no_empleado" name="maestroNoRegistro" required>

	<input type="text" placeholder="nombre" name="maestroNombreRegistro" required>

	<input type="text" placeholder="carrera" name="maestroCarreraRegistro" required>

	<input type="email" placeholder="Email" name="maestroEmailRegistro" required>

	<input type="password" placeholder="Contraseña" name="maestroPasswordRegistro" required>

	<input type="password" placeholder="Contraseña" name="maestroPassword2Registro" required>

	<input type="submit" name="maestroRegistro" value="Enviar">

</form>

<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de controller.php)
$registro = new Controlador_MVC();
//se invoca la función registroUsuarioController de la clase Controlador_MVC:
$registro -> nuevoMaestroController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
