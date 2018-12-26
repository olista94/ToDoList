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

  <form name="Form" id="registerForm" action="../Controllers/Contactos_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarRegistro(this)">
    <legend><?php echo $strings['Añadir contacto']; ?>
    <button onclick="location.href='../Controllers/Contactos_Controller.php';" class="volver"></button>
    </legend>

    <div>	
      
      <label for="nombre"><?php echo $strings['Nombre']; ?></label>
      <input type="text" name="nombre" id="nombre" size="40" maxlength="30" onchange="comprobarAlfabetico(this,30)" required/>
      
      <label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
      <input type="text" name="descripcion" id="descripcion" size="40" maxlength="50" onchange="comprobarAlfabetico(this,50)" required/>

      <label for="telefono"><?php echo $strings['Teléfono']; ?></label>
      <input type="text" name="telefono" id="telefono" size="40" maxlength="13" onchange="comprobarTelf(this)" required/>

      <label for="email"><?php echo $strings['Correo electrónico']; ?></label>
      <input type="email" id="email" name="email" size="40" maxlength="50" onchange="comprobarEmail(this,50)" required/>	
      
    </div>
    
    <button type="submit" name="action" value="Confirmar_ADD" class="aceptar"></button>
    <button type="reset" value="Reset" class="cancelar"></button>

	</form>
 
 
 <?php
  }
}
 ?>