<?php

class Categorias_ADD{
	 
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

			<form name="registerForm" id="registerForm" method="post" action="../Controllers/Categorias_Controller.php" >
				<legend><?php echo $strings['Formulario para añadir categoria'];?>
				
				</legend>

				<div>

					<label ><?php echo $strings['Nombre']; ?></label>
					<input type="text"  name="nombre" size="50" />	
						
					
					
				</div>

				<button type="submit" name="action" value="Confirmar_ADD"  class="aceptar"></button>
				<a href="<?php echo $this -> enlace;?>"><button type="button" title="<?php echo $GLOBALS['strings']['Cancelar']; ?>" class="cancelar"><i class="fas fa-times"></i></button></a>

			</form> 
		</div> 
<?php
	}
}
?>