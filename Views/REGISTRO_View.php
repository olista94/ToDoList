 <?php

 class REGISTRO_View{	 

	var $enlace;	
	
	function __construct($enlace){
		
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	
	function mostrar(){
		
		 include_once '../Views/Header.php';
  
  if(!isset($_SESSION['idioma'])){
    $_SESSION['idioma'] = 'SPANISH';
  }

  include '../Locales/Strings_'. $_SESSION['idioma'] .'.php'; 
	 	 
?>

  <form name="Form" id="registerForm" action="../Controllers/Registro_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarRegistro(this)">
    <legend><?php echo $strings['Regístrate']; ?>
    <button onclick="location.href='../index.php';" class="volver"></button>
    </legend>

    <div>	
      <label for="login"><?php echo $strings['Login']; ?></label>
      <input type="text" id="login" name="login" size="40" maxlength="15" onchange="comprobarTexto(this,15)" required/>
      
      <label for="password"><?php echo $strings['Contraseña']; ?></label>
      <input type="password" id="password" name="password" size="40" maxlength="20" onchange="comprobarTexto(this,128)" required/>

      <label for="dni"><?php echo $strings['DNI']; ?></label>
      <input type="text" id="dni" name="DNI" size="40" maxlenght="9" onchange="comprobarDni(this)" required/>
        
      <label for="nombre"><?php echo $strings['Nombre']; ?></label>
      <input type="text" name="nombre" id="nombre" size="40" maxlength="30" onchange="comprobarAlfabetico(this,30)" required/>
      
      <label for="apellidos"><?php echo $strings['Apellidos']; ?></label>
      <input type="text" name="apellidos" id="apellidos" size="40" maxlength="50" onchange="comprobarAlfabetico(this,50)" required/>

      <label for="telefono"><?php echo $strings['Teléfono']; ?></label>
      <input type="text" name="telefono" id="telefono" size="40" maxlength="13" onchange="comprobarTelf(this)" required/>

      <label for="email"><?php echo $strings['Correo electrónico']; ?></label>
      <input type="email" id="email" name="email" size="40" maxlength="50" onchange="comprobarEmail(this,50)" required/>	

      <label for="fecha"><?php echo $strings['Fecha de nacimiento']; ?></label>
      <input id="fecha" type="text" name="FechaNacimiento" size="28" class="tcal" value="" readonly/>
	  
	  <label for="tipo"><?php echo $strings['Tipo']; ?></label>
	  
      <select name="tipo" id="tipo">
		<option value="NORMAL"><?php echo $strings['Normal']; ?></option>
	  </select>
      
    </div>
    
    <button type="submit" name="action" value="Confirmar_ADD" class="aceptar"></button>
    <button type="reset" value="Reset" class="cancelar"></button>

	</form>
 
 
 <?php
  }
}
 ?>