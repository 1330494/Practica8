<h1>REGISTRO DE ALUMNOS</h1>

<form method="post">
	
	<input type="text" placeholder="Matricula" name="alumnoMatriculaRegistro" required>

	<input type="nombre" placeholder="Nombre Completo" name="ProductDesription" required>

	<select>
		
	</select>

	<input type="submit" name="alumnoRegistro" value="Enviar">

</form>

<?php
//Enviar los datos al controlador Controlador_MVC (es la clase principal de Controlador.php)
$registro = new Controlador_MVC();
//se invoca la función nuevoAlumnoController de la clase MvcController:
$registro -> nuevoAlumnoController();

if(isset($_GET["action"])){

	if($_GET["action"] == "ok"){

		echo "Registro Exitoso";
	
	}

}

?>
