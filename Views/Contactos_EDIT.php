<?php
 
class Contactos_EDIT{	 

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

	<form name="Form" id="registerForm" action="../Controllers/Contactos_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarRegistro(this)">
    	<legend><?php echo $strings['Editar contacto']; ?>
    	<button onclick="location.href='../Controllers/Contactos_Controller.php';" class="volver"></button>
    	</legend>

   		<div>	
      
			<label for="nombre"><?php echo $strings['Nombre']; ?></label>
			<input type="text" name="nombre" id="nombre" size="40" value="<?php echo $this -> fila['nombre']; ?>" maxlength="30" onchange="comprobarAlfabetico(this,30)" required/>
			
			<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
			<input type="text" name="descripcion" id="descripcion" value="<?php echo $this -> fila['descripcion']; ?>" size="40" maxlength="50" onchange="comprobarAlfabetico(this,50)" required/>

			<label for="telefono"><?php echo $strings['Teléfono']; ?></label>
			<input type="text" name="telefono" id="telefono" size="40" value="<?php echo $this -> fila['telefono']; ?>" maxlength="13" onchange="comprobarTelf(this)" required/>

			<label for="email"><?php echo $strings['Correo electrónico']; ?></label>
			<input type="text" id="email" name="email" size="40" maxlength="50" value="<?php echo $this -> fila['email']; ?>" onchange="comprobarEmail(this,50)" required readonly/>	
		
		</div>
    
		<button type="submit" name="action" value="Confirmar_EDIT" class="aceptar"></button>
		<button type="reset" value="Reset" class="cancelar"></button>

	</form>
 
 
<?php
  	}
}
 ?>