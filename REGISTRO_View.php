 <!-- FORMULARIO PARA REGISTRAR UN NUEVO USUARIO
CREADO POR: Los Cangrejas
Fecha:03/01/2019-->
 
 <?php
 //Declaracion de la clase
 class REGISTRO_View{	 
//Variable con el enlace al form para registrar usuaro
	var $enlace;	
		//Constructor de la clase
	function __construct($enlace){
		
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	//Funcion que "muestra" el contenido de la página
	function mostrar(){
		
		 include_once '../Views/Header.php';
  //Variable de idioma
  if(!isset($_SESSION['idioma'])){
    $_SESSION['idioma'] = 'SPANISH';
  }
//Archivo del idioma
  include '../Locales/Strings_'. $_SESSION['idioma'] .'.php'; 
	 	 
?>

  <div class="welcome">		
	<img src="../Views/img/logo.png" alt="Logo" width="60" height="60"> <h1>ToDoList</h1>
	</div>
 <!--Form para registrar un nuevo usuario-->
  <form class="registerForm" name="Form" id="registerForm" action="../Controllers/Registro_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarRegistro(this)">
    <legend><?php echo $strings['Regístrate']; ?>
	<!--Boton para volver al login-->
    <button type="button" onclick="location.href='../index.php';" class="signin"></button>
    </legend>

    <div>	
	<!--Campo login del usuario-->
      <label for="login"><?php echo $strings['Login']; ?></label>
      <input type="text" id="login" name="login" size="25"  onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,15);"/>
     <!--Campo password del usuario--> 
      <label for="password"><?php echo $strings['Contraseña']; ?></label>
      <input type="password" id="password" name="password" size="25"  onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,20);"/>
	<!--Campo DNI del usuario-->
      <label for="dni"><?php echo $strings['DNI']; ?></label>
      <input type="text" id="dni" name="DNI" size="25"  onblur=" return !comprobarVacio(this) && comprobarDni(this);" />
        <!--Campo nombre del usuario-->
      <label for="nombre"><?php echo $strings['Nombre']; ?></label>
      <input type="text" name="nombre" id="nombre" size="40"  onblur=" return !comprobarVacio(this) && comprobarTexto(this,30)" />
      <!--Campo apellidos del usuario-->
      <label for="apellidos"><?php echo $strings['Apellidos']; ?></label>
      <input type="text" name="apellidos" id="apellidos" size="55" onblur=" return !comprobarVacio(this) && comprobarTexto(this,50)" />
	<!--Campo telefono del usuario-->
      <label for="telefono"><?php echo $strings['Teléfono']; ?></label>
      <input type="text" name="telefono" id="telefono" size="25"  onblur=" return !comprobarVacio(this) && comprobarTelf(this);" />
	<!--Campo email del usuario-->
      <label for="email"><?php echo $strings['Correo electrónico']; ?></label>
      <input type="text" id="email" name="email" size="65"  onblur=" return !comprobarVacio(this) && comprobarEmail(this,60);" />	
	<!--Campo fecha de nacimiento del usuario-->
      <label for="fecha"><?php echo $strings['Fecha de nacimiento']; ?></label>
      <input id="fecha" type="text" name="FechaNacimiento" size="28" class="tcal" value="" onblur=" return comprobarFecha(this)" readonly/>
	  <!--Campo tipo del usuario (en el registro solo puede ser normal)-->
	  <label for="tipo"><?php echo $strings['Tipo']; ?></label>
      <select name="tipo" id="tipo">
		<option value="NORMAL"><?php echo $strings['Normal']; ?></option>
	  </select>
      
    </div>
    <!--Boton para confirmar el registro-->
    <button type="submit" name="action" value="Confirmar_ADD" class="aceptar"></button>
	 <!--Boton para borrar texto-->
    <button type="reset" value="Reset" class="cancelar"></button>

	</form>
 
 
 <?php
 //Pie
 include '../Views/Footer.php';
  }
}
 ?>