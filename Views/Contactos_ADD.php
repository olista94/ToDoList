<?php
 
 class Contactos_ADD{	 

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
<button onclick="location.href='../Controllers/Contactos_Controller.php';" class="volver"></button>
  <form name="Form" id="registerForm" action="../Controllers/Contactos_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarContacto(this)">
    <legend><?php echo $strings['Añadir contacto']; ?>
    
    </legend>

    <div>	
      
      <label for="nombre"><?php echo $strings['Nombre']; ?></label>
      <input type="text" name="nombre" id="nombre" size="40"  onblur=" return !comprobarVacio(this) && comprobarTexto(this,45);"/>
      
      <label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
      <input type="text" name="descripcion" id="descripcion" size="40"  onblur=" return !comprobarVacio(this) && comprobarTamano(this,45)" />

      <label for="telefono"><?php echo $strings['Teléfono']; ?></label>
      <input type="text" name="telefono" id="telefono" size="40"  onblur=" return !comprobarVacio(this) && comprobarTelf(this);" />

      <label for="email"><?php echo $strings['Correo electrónico']; ?></label>
      <input type="text" id="email" name="email" size="65"  onblur=" return !comprobarVacio(this) && comprobarEmail(this,60);" />	
      
    </div>
    
    <button type="submit" name="action" value="Confirmar_ADD" class="aceptar"></button>
    <button type="reset" value="Reset" class="cancelar"></button>

	</form>
 
 
 <?php
  }
}
 ?>