<?php
 
 class Usuarios_EDIT{	 

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

  <form name="Form" id="registerForm" action="../Controllers/Usuarios_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarRegistro(this)">
    <legend><?php echo $strings['Editar datos']; ?>
    <button onclick="location.href='../Controllers/Usuarios_Controller.php';" class="volver"></button>
    </legend>

    <div>	
      <label for="login"><?php echo $strings['Login']; ?></label>
      <input type="text" id="login" name="login" value="<?php echo $this -> fila['login']; ?>" size="40" maxlength="15" onchange="comprobarTexto(this,15)" required readonly/>
      
      <label for="password"><?php echo $strings['Contraseña']; ?></label>
      <input type="password" id="password" name="password" value="<?php echo $this -> fila['password']; ?>" size="40" maxlength="20" onchange="comprobarTexto(this,128)" required/>

      <label for="dni"><?php echo $strings['DNI']; ?></label>
      <input type="text" id="dni" name="dni" size="40" value="<?php echo $this -> fila['dni']; ?>" maxlenght="9" onchange="comprobarDni(this)" required/>
        
      <label for="nombre"><?php echo $strings['Nombre']; ?></label>
      <input type="text" name="nombre" id="nombre" value="<?php echo $this -> fila['nombre']; ?>" size="40" maxlength="30" onchange="comprobarAlfabetico(this,30)" required/>
      
      <label for="apellidos"><?php echo $strings['Apellidos']; ?></label>
      <input type="text" name="apellidos" id="apellidos" value="<?php echo $this -> fila['apellidos']; ?>" size="40" maxlength="50" onchange="comprobarAlfabetico(this,50)" required/>

      <label for="telefono"><?php echo $strings['Teléfono']; ?></label>
      <input type="text" name="telefono" id="telefono" value="<?php echo $this -> fila['telefono']; ?>" size="40" maxlength="13" onchange="comprobarTelf(this)" required/>

      <label for="email"><?php echo $strings['Correo electrónico']; ?></label>
      <input type="email" id="email" name="email" value="<?php echo $this -> fila['email']; ?>" size="40" maxlength="50" onchange="comprobarEmail(this,50)" required/>	

      <label for="fecha"><?php echo $strings['Fecha de nacimiento']; ?></label>
      <input id="fecha" type="text" name="fecha" value="<?php echo $this -> fila['fecha']; ?>" size="28" class="tcal" value="" readonly/>
      
    </div>
    
    <button type="submit" name="action" value="Confirmar_EDIT" class="aceptar"></button>
    <button type="reset" value="Reset" class="cancelar"></button>

	</form>
 
 
 <?php
  }
}
 ?>