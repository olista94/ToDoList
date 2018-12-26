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

			<form name="registerForm" id="registerForm" method="post" action="../Controllers/Prioridades_Controller.php" enctype="multipart/form-data">
				<legend><?php echo $strings['Añadir prioridad'];?>
				<button onclick="location.href='../Controllers/Prioridades_Controller.php';" class="volver"></button>
				</legend>

				<div>

					<label for="nivel"><?php echo $strings['Nivel']; ?></label>
					<input type="nivel" id="nivel" name="nivel" size="40" maxlength="60"/>	
						
					<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
					<input type="text" name="descripcion" id="descripcion" size="40" maxlength="30"/>
          						
					<label for="color"><?php echo $strings['Color']; ?></label>
					<input type="text" name="color" id="color" size="40" maxlength="30"/>
					
				</div>

				<button type="submit" name="action" value="Confirmar_ADD" value="Submit" class="aceptar"></button>
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
<?php
	}
}
?>