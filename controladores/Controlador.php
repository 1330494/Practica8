<?php 

/**
* 
*/
class Controlador_MVC
{
	public function showPage()
	{
		include "vistas/template.php";
	}

	public function linksController()
	{
		if(isset( $_GET['action'])){
			$enlaces = $_GET['action'];		
		}else{
			$enlaces = "index";
		}

		$respuesta = Pages::linksModel($enlaces);

		include $respuesta;
	}

/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/* Controlador para Maestros +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

	# BORRAR MAESTRO
	#------------------------------------
	public function deleteMaestroController(){

		if(isset($_GET["noBorrar"])){
			$datosController = $_GET["noBorrar"];
			$respuesta = MaestroData::deleteMaestroModel($datosController, "maestros");
			if($respuesta == "success"){
				header("location:index.php?action=maestros");
			}
		}
	}

	# REGISTRO DE MAESTROS
	#------------------------------------
	public function nuevoMaestroController(){

		if(isset($_POST["maestroRegistro"])){
			//Recibe a traves del método POST el name (html) de no. de empleado, nombre, carrera password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (maestro, password y email):
			$datosController = array( "no_empleado"=>$_POST["maestroNoRegistro"], 
								    "nombre"=>$_POST["maestroNombreRegistro"],
								    "carrera"=>$_POST["maestroCarreraRegistro"],
								  	"email"=>$_POST["maestroEmailRegistro"],
								  	"password"=>$_POST["maestroPasswordRegistro"]);

			//Se le dice al modelo models/crud.php (MaestroData::registroMaestroModel),que en la clase "MaestroData", la funcion "registroMaestroModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "maestros":
			$respuesta = MaestroData::newMaestroModel($datosController, "maestros");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){

				header("location:index.php?action=ok");

			}

			else{

				header("location:index.php");
			}

		}

	}

	# VISTA DE MAESTROS
	#------------------------------------

	public function vistaMaestrosController(){

		$respuesta = MaestroData::viewMaestroModel("maestros");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '<table class="">
		<thead>
			<tr>
				<th>No. Emp.</th>
				<th>Nombre</th>
				<th>Carrera</th>
				<th>Email</th>
				<th>Password</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>';
		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["no_empleado"].'</td>
				<td>'.$item["nombre"].'</td>
				<td>'.$item["carrera"].'</td>
				<td>'.$item["email"].'</td>
				<td>'.$item["password"].'</td>
				<td><a href="index.php?action=editar&no_empleado='.$item["no_empleado"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=maestros&noBorrar='.$item["no_empleado"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}

	#INGRESO DE MAESTROS
	#------------------------------------
	public function ingresoMaestroController()
	{

		if(isset($_POST["SubmitMaestro"])){

			$datosController = array( "no_empleado"=>$_POST["maestroNoIngreso"], 
								      "password"=>$_POST["maestroPasswordIngreso"]);

			$respuesta = MaestroData::ingresoMaestroModel($datosController, "maestros");
			//Valiación de la respuesta del modelo para ver si es un maestro correcto.
			if($respuesta["no_empleado"] == $_POST["maestroNoIngreso"] && $respuesta["password"] == $_POST["maestroPasswordIngreso"]){
				session_start();
				$_SESSION["validar"] = true;
				header("location:index.php?action=maestros");
			}else{
				header("location:index.php?action=fallo");
			}
		}	
	}

	#EDITAR MAESTROS
	#------------------------------------

	public function editarMaestroController(){

		$datosController = $_GET["no_empleado"];
		$respuesta = MaestroData::editarMaestroModel($datosController, "maestros");

		echo'<input type="text" value="'.$respuesta["no_emp"].'" name="maestroNoEditar">

			<input type="text" value="'.$respuesta["nombre"].'" name="maestroNombreEditar" required>

			<input type="text" value="'.$respuesta["carrera"].'" name="maestroCarreraEditar" required>

			<input type="email" value="'.$respuesta["email"].'" name="maestroEmailEditar" required>

			<input type="text" value="'.$respuesta["password"].'" id="PW2" name="maestroPW1Editar" required>

			<input type="password" value="" id="PW2" name="maestroPW2Editar" required>
			<script type="javascript">
				document.getElementById("PW2").onchange = function(e){
					var PW1 = document.getElementById("PW1");
					if(this.value != PW1.value ){
						alert("Contraseñas no coinciden.");
						PW1.focus();
						this.value = "";
					}
				};
			</script>
			<input type="submit" name="maestroEditar" value="Actualizar">';

	}

	#ACTUALIZAR MAESTROS
	#------------------------------------
	public function actualizarMaestroController(){

		if(isset($_POST["maestroEditar"])){

			$datosController = array( "no_emp"=>$_POST["maestroNoEditar"],
							        "nombre"=>$_POST["maestroNombreEditar"],
				                    "carrera"=>$_POST["maestroCarreraEditar"],
				                    "email"=>$_POST["maestroEmailEditar"],
				                  	"password"=>$_POST["maestroPW1Editar"]);
			
			$respuesta = MaestroData::actualizarMaestroModel($datosController, "maestros");

			if($respuesta == "success"){
				header("location:index.php?action=cambio");
			}else{
				echo "error";
			}
		}
	}

/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/* Controlador para Alumnos ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	
	# BORRAR ALUMNO
	#------------------------------------
	public function deleteAlumnoController(){

		if(isset($_GET["matriculaBorrar"])){
			$datosController = $_GET["matriculaBorrar"];
			$respuesta = AlumnoData::deleteAlumnoModel($datosController, "alumnos");
			if($respuesta == "success"){
				header("location:index.php?action=alumnos");
			}
		}
	}

	# REGISTRO DE ALUMNOS
	#------------------------------------
	public function nuevoAlumnoController(){

		if(isset($_POST["alumnosRegistro"])){
			//Recibe a traves del método POST el name (html) de matricula, nombre, carrera, tutor se almacenan los datos en una variable de tipo array con sus respectivas propiedades ():
			$datosController = array(
				"matricula"=>$_POST["alumnoMatriculaRegistro"],
				"nombre"=>$_POST["alumnoNombreRegistro"],
				"carrera"=>$_POST["alumnoCarreraRegistro"],
				"tutor"=>$_POST["alumnoTutorRegistro"]
			);

			//Se le dice al modelo models/crud.php (AlumnoData::registroAlumnoModel),que en la clase "AlumnoData", la funcion "registroAlumnoModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "alumnos":
			$respuesta = AlumnoData::newAlumnoModel($datosController, "alumnos");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){
				header("location:index.php?action=ok");
			}else{
				header("location:index.php");
			}
		}
	}

	# VISTA DE ALUMNOS
	#------------------------------------

	public function vistaAlumnosController(){

		$respuesta = AlumnoData::viewAlumnoModel("alumnos");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '<table class="">
		<thead>
			<tr>
				<th>Matricula</th>
				<th>Nombre</th>
				<th>Carrera</th>
				<th>Tutor</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>';
		foreach($respuesta as $row => $item){
		echo'
			<tr>
				<td>'.$item["matricula"].'</td>
				<td>'.$item["nombre"].'</td>
				<td>'.$item["carrera"].'</td>
				<td>'.$item["tutor"].'</td>
				<td><a href="index.php?action=editar&matricula='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=alumnos&matriculaBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';
		}
		echo '
		</tbody>
			</table>';
	}

	#EDITAR 
	#------------------------------------

	public function editarAlumnoController(){

		$datosController = $_GET["id"];
		$respuesta = AlumnoData::editarAlumnoModel($datosController, "alumnos");

		echo'<input type="text" value="'.$respuesta["matricula"].'" name="alumnoMatriculaEditar">

			<input type="text" value="'.$respuesta["usuario"].'" name="alumnoNombreEditar" required>

			<input type="text" value="'.$respuesta["carrera"].'" name="alumnoCarreraEditar" required>

			<input type="text" value="'.$respuesta["tutor"].'" id="APW1" name="alumnoTutorEditar" required>

			<input type="submit" name="alumnoEditar" value="Actualizar">';

	}

	#ACTUALIZAR 
	#------------------------------------
	public function actualizarAlumnoController(){

		if(isset($_POST["alumnoEditar"])){

			$datosController = array( "matricula"=>$_POST["alumnoMatriculaEditar"],
							          "nombre"=>$_POST["alumnoNombreEditar"],
				                      "carrera"=>$_POST["alumnoCarreraEditar"],
				                      "tutor"=>$_POST["alumnoTutorEditar"]);
			
			$respuesta = AlumnoData::actualizarAlumnoModel($datosController, "alumnos");

			if($respuesta == "success"){
				header("location:index.php?action=cambio");
			}
			else{
				echo "error";
			}
		}
	}


/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/* Controlador para Carreras ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
/*++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
	
	# BORRAR CARRERA
	#------------------------------------
	public function deleteCarreraController(){

		if(isset($_GET["idBorrar"])){
			$datosController = $_GET["idBorrar"];
			$respuesta = CarreraData::deleteCarreraModel($datosController, "carreras");
			if($respuesta == "success"){
				header("location:index.php?action=carreras");
			}
		}
	}

	# REGISTRO DE CARRERAS
	#------------------------------------
	public function nuevaCarreraController(){

		if(isset($_POST["carreraRegistro"])){
			//Recibe a traves del método POST el name (html) de no. de empleado, nombre, carrera password y email, se almacenan los datos en una variable de tipo array con sus respectivas propiedades (maestro, password y email):
			$datosController = array( 
				"id"=>$_POST["carreraIdRegistro"], 
				"nombre"=>$_POST["carreraNombreRegistro"]
			);

			//Se le dice al modelo models/crud.php (CarreraData::newCarreraModel),que en la clase "CarreraData", la funcion "registroMaestroModel" reciba en sus 2 parametros los valores "$datosController" y el nombre de la tabla a conectarnos la cual es "maestros":
			$respuesta = CarreraData::newCarreraModel($datosController, "carreras");

			//se imprime la respuesta en la vista 
			if($respuesta == "success"){

				header("location:index.php?action=ok");

			}

			else{

				header("location:index.php");
			}

		}

	}

	# VISTA DE CARRERAS
	#------------------------------------

	public function vistaCarrerasController(){

		$respuesta = CarreraData::viewCarreraModel("carreras");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		echo '<table class="">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>';
		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["id"].'</td>
				<td>'.$item["nombre"].'</td>
				<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=carreras&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}

	#EDITAR MAESTROS
	#------------------------------------

	public function editarCarreraController(){

		$datosController = $_GET["id"];
		$respuesta = CarreraData::editarCarreraModel($datosController, "carreras");

		echo'<input type="text" value="'.$respuesta["id"].'" name="carreraIdEditar">

			<input type="text" value="'.$respuesta["nombre"].'" name="carreraNombreEditar" required>

			<input type="submit" name="carreraEditar" value="Actualizar">';

	}

	#ACTUALIZAR MAESTROS
	#------------------------------------
	public function actualizarCarreraController(){

		if(isset($_POST["carreraEditar"])){

			$datosController = array( 
				"id"=>$_POST["carreraIdEditar"],
				"nombre"=>$_POST["carreraNombreEditar"]
			);
			
			$respuesta = CarreraData::actualizarCarreraModel($datosController, "carreras");

			if($respuesta == "success"){
				header("location:index.php?action=cambio");
			}else{
				echo "error";
			}
		}
	}
}

?>
