 <?php
 
 class Usuarios_ADD{	 

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
<button onclick="location.href='../Controllers/Usuarios_Controller.php';" class="volver"></button>
  <form name="Form" id="registerForm" action="../Controllers/Usuarios_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarUsuario(this)">
    <legend><?php echo $strings['Regístrate']; ?>
    
    </legend>

    <div>	
      <label for="login"><?php echo $strings['Login']; ?></label>
      <input type="text" id="login" name="login" size="40"   onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,15);" />
      
      <label for="password"><?php echo $strings['Contraseña']; ?></label>
      <input type="password" id="password" name="password" size="40"  onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,20);" />

      <label for="dni"><?php echo $strings['DNI']; ?></label>
      <input type="text" id="dni" name="dni" size="20"  onblur=" return !comprobarVacio(this) && comprobarDni(this);" />
        
      <label for="nombre"><?php echo $strings['Nombre']; ?></label>
      <input type="text" name="nombre" id="nombre" size="40"   onblur=" return !comprobarVacio(this) && comprobarTexto(this,30);"/>
      
      <label for="apellidos"><?php echo $strings['Apellidos']; ?></label>
      <input type="text" name="apellidos" id="apellidos" size="55"  onblur=" return !comprobarVacio(this) && comprobarTexto(this,50);" />

      <label for="telefono"><?php echo $strings['Teléfono']; ?></label>
      <input type="text" name="telefono" id="telefono" size="20" onblur=" return !comprobarVacio(this) && comprobarTelf(this);" />

      <label for="email"><?php echo $strings['Correo electrónico']; ?></label>
      <input type="email" id="email" name="email" size="65"  onblur=" return !comprobarVacio(this) && comprobarEmail(this,60);" />	

      <label for="fecha"><?php echo $strings['Fecha de nacimiento']; ?></label>
      <input id="fecha" type="text" name="fecha" size="28" class="tcal" value=""  onblur=" return comprobarFecha(this)" readonly/>
	  
	  <label for="tipo"><?php echo $strings['Tipo']; ?></label>
	  
      <select name="tipo" id="tipo">
		<option value="ADMIN"><?php echo $strings['Admin']; ?></option>
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