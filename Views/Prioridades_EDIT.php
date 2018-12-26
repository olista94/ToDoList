<?php

class Prioridades_EDIT{
	 
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

			<form name="registerForm" id="registerForm" method="post" action="../Controllers/Prioridades_Controller.php" enctype="multipart/form-data">
				<legend><?php echo $strings['Editar prioridad'];?>
				<button onclick="location.href='../Controllers/Prioridades_Controller.php';" class="volver"></button>
				</legend>

				<div>

					<label for="nivel"><?php echo $strings['Nivel']; ?></label>
					<input type="nivel" id="nivel" name="nivel" size="40" value="<?php echo $this -> fila['nivel']; ?>" maxlength="60" readonly/>	
						
					<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
					<input type="text" name="descripcion" id="descripcion" value="<?php echo $this -> fila['descripcion']; ?>" size="40" maxlength="30"/>
          						
					<label for="color"><?php echo $strings['Color']; ?></label>
					<input type="text" name="color" id="color" size="40" value="<?php echo $this -> fila['color']; ?>" maxlength="30"/>
					
				</div>

				<button type="submit" name="action" value="Confirmar_EDIT" value="Submit" class="aceptar"></button>
				<button type="reset" value="Reset" class="cancelar"></button>

			</form> 
		</div> 
<?php
	}
}
?>