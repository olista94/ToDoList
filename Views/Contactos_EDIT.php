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

	<form name="Form" id="registerForm" action="../Controllers/Contactos_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarContacto(this)">
    	<legend><?php echo $strings['Editar contacto']; ?>
    	<button type="button" onclick="location.href='../Controllers/Contactos_Controller.php';" class="volver"></button>
    	</legend>

   		<div>	
      
			<label for="nombre"><?php echo $strings['Nombre']; ?></label>
			<input type="text" name="nombre" id="nombre"  value="<?php echo $this -> fila['nombre']; ?>"  size="40"  onblur=" return !comprobarVacio(this) && comprobarTexto(this,45);" />
			
			<label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
			<input type="text" name="descripcion" id="descripcion" value="<?php echo $this -> fila['descripcion']; ?>" size="40"  onblur=" return !comprobarVacio(this) && comprobarTamano(this,45)" />

			<label for="telefono"><?php echo $strings['Teléfono']; ?></label>
			<input type="text" name="telefono" id="telefono"  value="<?php echo $this -> fila['telefono']; ?>"  size="40"  onblur=" return !comprobarVacio(this) && comprobarTelf(this);" />

			<label for="email"><?php echo $strings['Correo electrónico']; ?></label>
			<input type="text" id="email" name="email" size="65"  value="<?php echo $this -> fila['email']; ?>" onblur=" return !comprobarVacio(this) && comprobarEmail(this,60);" readonly/>	
		
		</div>
    
		<button type="submit" name="action" value="Confirmar_EDIT" class="aceptar"></button>
		<button type="reset" value="Reset" class="cancelar"></button>

	</form>
 
 
<?php
  	}
}
 ?>