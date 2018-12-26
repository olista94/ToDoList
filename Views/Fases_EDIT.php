<!-- FORMULARIO PARA REGISTRAR UN NUEVO USUARIO EN LA APLICACIÓN
 CREADO POR mi3ac6 EL 21/11/2018-->
 <?php
 include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';
 
 class Fases_EDIT{
	 
	var $datos;
	var $tareas;
	var $contactos;
	var $enlace;
	
	
	function __construct($datos,$tareas,$contactos,$enlace){
		
		$this -> datos = $datos;
		$this -> tareas = $tareas;
		$this -> contactos = $contactos;
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	
	function mostrar(){
		
	 include_once "../Views/Header.php";
	 
	 
?>
 <link rel="stylesheet" href="../Views/css/estilos.css" type="text/css">
 <script type="text/javascript" src="../Views/js/validaciones.js"></script>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
 
 <article class="edit">
 
 <h3><?php echo $GLOBALS['strings']['Formulario para editar fase'];?></h3>
 
 <form action="../Controllers/Tareas_Controller.php" method="post" id="edit" name="edit" onsubmit="return validarformAddUser(this);">
 

   <label>
   <?php echo $GLOBALS['strings']['Descripcion']; ?></label><br>
  <textarea rows="4" cols="50" name="descripcion" onblur= "return !comprobarVacio(this)"><?php echo $this -> datos[1]; ?></textarea><br>
  
  
  <label>
  <?php echo $GLOBALS['strings']['Fecha inicio']; ?></label><br>
  <input type="date" name="fecha_ini"   value="<?php echo $this -> datos[2]; ?>" onblur=" return !comprobarVacio(this)"><br>
  
  <label>
  <?php echo $GLOBALS['strings']['Fecha inicio']; ?></label><br>
  <input type="date" name="fecha_fin"   value="<?php echo $this -> datos[3]; ?>" onblur=" return !comprobarVacio(this)"><br>
  
<label>
					<?php echo $GLOBALS['strings']['Tarea']; ?></label><br>
					<select name="TAREAS_id_TAREAS">
						<?php
							while($tareas=$this->tareas->fetch_array())
							{
						?>
							<option value="<?php echo $tareas[0];?>" <?php if($this -> datos[4] == $tareas[0]) echo "selected"; ?>><?php echo $tareas[1];?>

							</option>
						<?php
							}
						?>
					</select><br>
		
		
<label>
					<?php echo $GLOBALS['strings']['Contacto']; ?></label><br>
					<select name="CONTACTOS_email">
						<?php
							while($contactos=$this->contactos->fetch_array())
							{
						?>
							<option value="<?php echo $contactos[0];?>" <?php if($this -> datos[5] == $contactos[0]) echo "selected"; ?>><?php echo $contactos[0];?>

							</option>
						<?php
							}
						?>
					</select><br>
  
  
  


 <!-- BOTONES DE CONFIRMAR O CANCELAR NUEVO USUARIO -->
  
  <button type="submit" title="<?php echo $GLOBALS['strings']['Añadir usuario']; ?>" value="Confirmar_EDIT" name="action" class="confirmar"><i class="fas fa-edit"></i></button>
<a href="<?php echo $this -> enlace;?>"><button type="button" title="<?php echo $GLOBALS['strings']['Cancelar']; ?>" class="cancelar"><i class="fas fa-times"></i></button></a>
  
</form>
 
 
 </article>
 
 <?php
	include_once "../Views/Footer.php";
	}
 }
 ?>