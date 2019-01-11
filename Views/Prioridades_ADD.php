<?php

class Prioridades_ADD{
	 
	var $enlace;	
	
	function __construct($enlace){
				
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	
	function mostrar(){
		
		if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
?>	 

		<div class="form">
<button onclick="location.href='../Controllers/Prioridades_Controller.php';" class="volver"></button>
			<form name="registerForm" id="registerForm" method="post" action="../Controllers/Prioridades_Controller.php" enctype="multipart/form-data" onsubmit="return comprobarPrioridad(this)">
				<legend><?php echo $strings['Añadir prioridad'];?>
				
				</legend>

				<div>

					<label for="nivel"><?php echo $strings['Nivel']; ?></label>
					<input type="nivel" id="nivel" name="nivel" size="5" onblur=" return !comprobarVacio(this) && comprobarEntero(this,0,99);"/>	
						
					<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
					<input type="text" name="descripcion" id="descripcion" size="50" onblur=" return !comprobarVacio(this) && comprobarTamano(this,45)"/>
          						
					<label for="color"><?php echo $strings['Color']; ?></label>
					<input type="color" name="color" id="color" value="">
				
				</div>

				<button type="submit" name="action" value="Confirmar_ADD" value="Submit" class="aceptar"></button>
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
<?php
	}
}
?>