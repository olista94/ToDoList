<?php

class Categorias_EDIT{
	 
	var $datos;
	var $enlace;
	var $fila;	
	
	function __construct($datos,$enlace){
				
		$this -> datos = $datos;
		$this -> enlace = $enlace;
		$this -> fila = $this -> datos -> fetch_array();
		$this -> mostrar();

	}
	
	function mostrar(){
		
		if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
?>	 

		<div class="form">

			<form name="registerForm" id="registerForm" method="post" action="../Controllers/Categorias_Controller.php" enctype="multipart/form-data" onsubmit="return comprobarCategoria(this);">
				<legend><?php echo $strings['Editar categoria'];?>
				<button type="button" onclick="location.href='../Controllers/Categorias_Controller.php';" class="volver"></button>
				</legend>

				<input hidden type="text" name="id_CATEGORIAS"  value="<?php echo $this -> fila[0]; ?>" readonly><br>	

				<div>	
				  <label ><?php echo $strings['Nombre']; ?></label>
				  <input type="text" id="nombre" name="nombre" size="50" value="<?php echo $this -> fila['nombre']; ?>" onblur=" return !comprobarVacio(this) && comprobarTexto(this,45);">
				</div>
	
	

				<button type="submit" name="action" value="Confirmar_EDIT2" value="Submit" class="aceptar"></button>
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
<?php
	}
}
?>