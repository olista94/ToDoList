<!-- FORMULARIO PARA AÑADIR UN CONTACTO QUE REALIZARA FASES
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

<?php
  //Declaracion de la clase
 class Contactos_ADD{	 
//Variable con el enlace al form de ADD contacto
	var $enlace;	
	//Constructor de la clase
	function __construct($enlace){
		
		$this -> enlace = $enlace;
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
<!--Formulario para añadir contacto-->
  <form name="Form" id="registerForm" action="../Controllers/Contactos_Controller.php" method="post" enctype="multipart/form-data" onsubmit="return comprobarContacto(this)">
    <legend><?php echo $strings['Añadir contacto']; ?>
	<!--Boton para volver atrás -->
    <button type="button" onclick="location.href='../Controllers/Contactos_Controller.php';" class="volver"></button>
    </legend>

    <div>	
		  <!--Campo nombre del contacto-->
		  <label for="nombre"><?php echo $strings['Nombre']; ?></label>
		  <input type="text" name="nombre" id="nombre" size="40"  onblur=" return !comprobarVacio(this) && comprobarTexto(this,45);"/>
		  <!--Campo descripcion del contacto-->
		  <label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
		  <input type="text" name="descripcion" id="descripcion" size="40"  onblur=" return !comprobarVacio(this) && comprobarTamano(this,45)" />
		  <!--Campo telefono del contacto-->	
		  <label for="telefono"><?php echo $strings['Teléfono']; ?></label>
		  <input type="text" name="telefono" id="telefono" size="40"  onblur=" return !comprobarVacio(this) && comprobarTelf(this);" />
		  <!--Campo email del contacto-->
		  <label for="email"><?php echo $strings['Correo electronico']; ?></label>
		  <input type="text" id="email" name="email" size="65"  onblur=" return !comprobarVacio(this) && comprobarEmail(this,60);" />	
      
    </div>
    <!--Boton de confirmar inserción-->
    <button type="submit" name="action" value="Confirmar_ADD" class="aceptar"></button>
    <!--Boton de borrado de texto-->
	<button type="reset" value="Reset" class="cancelar"></button>

	</form>
 
 
 <?php
  }
}
 ?>