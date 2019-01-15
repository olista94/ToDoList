<?php
  //Declaracion de la clase
class Prioridades_EDIT{
	  //Datos de la prioridad
	var $datos;
	//Variable con el enlace al form de EDIT prioridad
	var $enlace;
	var $fila;	
	
		//Constructor de la clase
	function __construct($datos,$enlace){
				
		$this -> datos = $datos;
		$this -> enlace = $enlace;
		$this -> fila = $this -> datos -> fetch_array();
		$this -> mostrar();

	}
	//Funcion que "muestra" el contenido de la página
	function mostrar(){
		//Variable de idioma
		if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }
//Archivo del idioma
        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
?>	 
<!--Formulario para editar prioridad-->
		<div class="form">

			<form name="registerForm" id="registerForm" method="post" action="../Controllers/Prioridades_Controller.php" enctype="multipart/form-data" onsubmit="return comprobarPrioridad(this)">
				<legend><?php echo $strings['Editar prioridad'];?>
				<!--Boton para volver atrás -->
				<button type="button" onclick="location.href='../Controllers/Prioridades_Controller.php';" class="volver"></button>
				</legend>

				<div>
					<!--Campo nivel de la prioridad-->
					<label for="nivel"><?php echo $strings['Nivel']; ?></label>
					<input type="nivel" id="nivel" name="nivel" size="" value="<?php echo $this -> fila['nivel']; ?>"  readonly/>	
					<!--Campo descripcion de la prioridad-->
					<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
					<input type="text" name="descripcion" id="descripcion" value="<?php echo $this -> fila['descripcion']; ?>" size="50" onblur=" return !comprobarVacio(this) && comprobarTamano(this,45)"/>
          			 <!--Campo color de la prioridad-->					
					<label for="color"><?php echo $strings['Color']; ?></label>
					<input type="color" name="color" id="color" value="<?php echo $this -> fila['color']; ?>">
					
				</div>
				<!--Boton de confirmar inserción-->
				<button type="submit" name="action" value="Confirmar_EDIT" value="Submit" class="aceptar"></button>
				<!--Boton de borrado de texto-->
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
<?php
	}
}
?>