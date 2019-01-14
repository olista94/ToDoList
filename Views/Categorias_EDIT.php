<?php


 //Declaracion de la clase 
class Categorias_EDIT{
	 
	 //Datos de la categoria
	var $datos;
	//Variable con el enlace al form EDIT categoria
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
<!--Formulario para editar categoria-->
		<div class="form">

			<form name="registerForm" id="registerForm" method="post" action="../Controllers/Categorias_Controller.php" enctype="multipart/form-data" onsubmit="return comprobarCategoria(this);">
				<legend><?php echo $strings['Editar categoria'];?>
				<!--Boton para volver atrás -->
				<button type="button" onclick="location.href='../Controllers/Categorias_Controller.php';" class="volver"></button>
				</legend>
<!--Id de la categoria que se pasara como hidden al model-->
				<input hidden type="text" name="id_CATEGORIAS"  value="<?php echo $this -> fila[0]; ?>" readonly><br>	
<!--Campo nombre de la categoria-->
				<div>	
				  <label ><?php echo $strings['Nombre']; ?></label>
				  <input type="text" id="nombre" name="nombre" size="50" value="<?php echo $this -> fila['nombre']; ?>" onblur=" return !comprobarVacio(this) && comprobarTexto(this,45);">
				</div>
	
	
				<!--Boton de confirmar editado-->
				<button type="submit" name="action" value="Confirmar_EDIT2" value="Submit" class="aceptar"></button>
				<!--Boton de borrado-->
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
<?php
	}
}
?>