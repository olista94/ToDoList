<!-- FORMULARIO PARA EDITAR UN USUARIO
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

<?php
   //Declaracion de la clase
 class Usuarios_EDIT{	 

	//Datos del usuario
	var $datos;
	var $enlace;
	//Variable con el enlace al form para EDIT usuaro
	var $fila;
	
	//Constructor de la clase
	function __construct($datos,$enlace){
		
		$this -> datos = $datos;
		$this -> enlace = $enlace;
		$this -> fila = $this -> datos -> fetch_array();
		$this -> mostrar();
	}
	//Funcion que "muestra" el contenido de la página
	function mostrar(){
	//Variable de idioma 
		if(!isset($_SESSION['idioma'])){
			$_SESSION['idioma'] = 'SPANISH';
		}
//Archivo del idioma
		include '../Locales/Strings_'. $_SESSION['idioma'] .'.php'; 
	 	 
?>
 <!--Form para editar un usuario-->
  <form name="Form" id="registerForm" action="../Controllers/Usuarios_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarUsuario(this)">
    <legend><?php echo $strings['Editar usuario']; ?>
    <!--Boton para volver atras-->
	<button type="button" onclick="location.href='../Controllers/Usuarios_Controller.php';" class="volver"></button>
    </legend>

    <div>	
	<!--Campo login del usuario-->	
      <label for="login"><?php echo $strings['Login']; ?></label>
      <input type="text" id="login" name="login" value="<?php echo $this -> fila['login']; ?>" size="40"  onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,15);"  readonly/>
      <!--Campo password del usuario--> 
      <label for="password"><?php echo $strings['Contraseña']; ?></label>
      <input type="password" id="password" name="password" value="<?php echo $this -> fila['password']; ?>" size="40"  onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,20);" />
		<!--Campo DNI del usuario-->
      <label for="dni"><?php echo $strings['DNI']; ?></label>
      <input type="text" id="dni" name="dni" size="20" value="<?php echo $this -> fila['dni']; ?>"   onblur=" return !comprobarVacio(this) && comprobarDni(this);" />
         <!--Campo nombre del usuario-->
      <label for="nombre"><?php echo $strings['Nombre']; ?></label>
      <input type="text" name="nombre" id="nombre" value="<?php echo $this -> fila['nombre']; ?>" size="40"  onblur=" return !comprobarVacio(this) && comprobarTexto(this,30);" />
      <!--Campo apellidos del usuario-->
      <label for="apellidos"><?php echo $strings['Apellidos']; ?></label>
      <input type="text" name="apellidos" id="apellidos" value="<?php echo $this -> fila['apellidos']; ?>" size="55" onblur=" return !comprobarVacio(this) && comprobarTexto(this,50);" />
		<!--Campo telefono del usuario-->
      <label for="telefono"><?php echo $strings['Teléfono']; ?></label>
      <input type="text" name="telefono" id="telefono" value="<?php echo $this -> fila['telefono']; ?>" size="20"  onblur=" return !comprobarVacio(this) && comprobarTelf(this);" />
		<!--Campo email del usuario-->
      <label for="email"><?php echo $strings['Correo electronico']; ?></label>
      <input type="email" id="email" name="email" value="<?php echo $this -> fila['email']; ?>" size="65"  onblur=" return !comprobarVacio(this) && comprobarEmail(this,60);" />	
		<!--Campo fecha de nacimiento del usuario-->
      <label for="fecha"><?php echo $strings['Fecha de nacimiento']; ?></label>
      <input id="fecha" type="text" name="fecha" value="<?php echo $this -> fila['fecha']; ?>" size="28" class="tcal" value="" onblur=" return comprobarFecha(this)" readonly/>
		 <!--Campo tipo del usuario (ADMIN O NORMAL)-->	
			<label ><?php echo $strings['Tipo']; ?></label>
				<select name="tipo" id="tipo">
				<option value="<?php echo $this -> fila['tipo'];?>" <?php if($this -> fila['tipo'] == 'ADMIN') echo "selected"; ?>><?php echo $strings['Admin']; ?></option>
				<option value="<?php echo $this -> fila['tipo'];?>" <?php if($this -> fila['tipo'] == 'NORMAL') echo "selected"; ?>><?php echo $strings['Normal']; ?></option>
			</select>  
      
    </div>
    
	<!--Boton para confirmar editar-->
    <button type="submit" name="action" value="Confirmar_EDIT" class="aceptar"></button>
	<!--Boton para borrar texto-->
    <button type="reset" value="Reset" class="cancelar"></button>

	</form>
 
 
 <?php
  }
}
 ?>