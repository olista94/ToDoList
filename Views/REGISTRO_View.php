 <?php
 include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';
 
 class REGISTRO_View{
	 
	var $titulos;
	var $enlace;
	
	
	function __construct($titulos,$enlace){
		$this -> titulos = $titulos;
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	
	function mostrar(){
		
	 /* include_once "../Views/Header.php"; */
	 
	 
?>
 <link rel="stylesheet" href="../Views/css/estilosLogin.css" type="text/css">
 <script type="text/javascript" src="../Views/js/validaciones.js"></script>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
 
 <article class="add">
 
 <h3><?php echo $GLOBALS['strings']['Formulario para añadir usuario'];?></h3>
 
 <form enctype="multipart/form-data" action="../Controllers/Registro_Controller.php" method="post" id="add" name="add" onsubmit="return validarformAddUser(this);">
 
  
  <label>
  <?php echo $GLOBALS['strings']['Login']; ?></label>
  <input type="text" name="login"  size="20" placeholder="<?php echo $GLOBALS['strings']['Max. 15 caracteres'];?>" onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,15);"><br>
  
  
   <label>
   <?php echo $GLOBALS['strings']['Password']; ?></label>
  <input type="password" name="password"  size="25" placeholder="<?php echo $GLOBALS['strings']['Max. 20 caracteres'];?>" onblur=" return !comprobarVacio(this) && comprobarAlfabetico(this,20);"><br>
  
  
  <label>
  <?php echo $GLOBALS['strings']['DNI']; ?></label>
  <input type="text" name="dni"  size="15" placeholder="<?php echo $GLOBALS['strings']['Ej:44657879K'];?>" onblur=" return !comprobarVacio(this) && comprobarDni(this);"><br>
  
  <label>
  <?php echo $GLOBALS['strings']['Nombre']; ?></label>
  <input type="text" name="nombre" size="35" placeholder="<?php echo $GLOBALS['strings']['Max. 30 caracteres'];?>"  onblur=" return !comprobarVacio(this) && comprobarTexto(this,30);"><br>
  
  
  <label>
  <?php echo $GLOBALS['strings']['Apellidos']; ?></label>
  <input type="text" name="apellidos" size="55" placeholder="<?php echo $GLOBALS['strings']['Max. 50 caracteres'];?>"  onblur=" return !comprobarVacio(this) && comprobarTexto(this,50);"><br>
  
  
  <label>
  <?php echo $GLOBALS['strings']['Telefono']; ?></label>
  <input type="text" name="telefono" size="15" placeholder="<?php echo $GLOBALS['strings']['Ej:667523632'];?>" onblur=" return !comprobarVacio(this) && comprobarTelf(this);"><br>
  
  
  <label>
  <?php echo $GLOBALS['strings']['Email']; ?></label>
  <input type="text" name="email" size="60" placeholder="<?php echo $GLOBALS['strings']['Max. 60 caracteres'];?>"  onblur=" return !comprobarVacio(this) && comprobarEmail(this,60);"><br>
  
   <label>
  <?php echo $GLOBALS['strings']['Fecha de nacimiento']; ?></label>
  <input type="date" name="fechanacimiento"  onblur=" return comprobarFecha(this)"><br>
  
  <label>
  <?php echo $GLOBALS['strings']['Foto personal']; ?></label><br>
  <input type="file" name="fotopersonal" size="55" placeholder="<?php echo $GLOBALS['strings']['Max. 50 caracteres']; ?>" ><br>
  
  <label>
  <?php echo $GLOBALS['strings']['Sexo']; ?></label>
  <select name="sexo">
  <option value="Hombre"><?php echo $GLOBALS['strings']['Hombre'];?></option>
  <option value="Mujer"><?php echo $GLOBALS['strings']['Mujer'];?></option>
  </select><br>

 <!-- BOTONES DE CONFIRMAR O CANCELAR NUEVO USUARIO -->
  
  <button type="submit" title="<?php echo $GLOBALS['strings']['Añadir usuario']; ?>" value="Confirmar_ADD" name="action" class="confirmar"><i class="fas fa-user-plus"></i></button>
<a href="<?php echo $this -> enlace;?>"><button type="button" title="<?php echo $GLOBALS['strings']['Cancelar']; ?>" class="cancelar"><i class="fas fa-times"></i></button></a>
  
</form>
 
 
 </article>
 
 <?php
	/* include_once "../Views/Footer.php"; */
	}
 }
 ?>