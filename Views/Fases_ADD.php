<!-- FORMULARIO PARA REGISTRAR UN NUEVO tarea EN LA APLICACIÓN
 CREADO POR mi3ac6 EL 21/11/2018-->
 <?php
 /* include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php'; */
 
 class Fases_ADD{
	 
	
	
	var $id_tarea;
	var $descripcion;
	var $contactos;
	var $enlace;

	
	function __construct($id_tarea,$descripcion,$contactos,$enlace){
		
		
		$this -> id_tarea = $id_tarea;
		$this -> descripcion = $descripcion;
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
 
 <article class="add">
 
 <h3><?php echo $GLOBALS['strings']['Formulario para añadir fase'];?></h3>
 
 <form  action="../Controllers/Fases_Controller.php" method="post" id="add" name="add ">
 

   <label>
   <?php echo $GLOBALS['strings']['Descripcion']; ?></label><br>
	
  <textarea rows="4" cols="50" name="descripcion" onblur= "return !comprobarVacio(this)"></textarea><br>
  
  <label>
  <?php echo $GLOBALS['strings']['Fecha inicio']; ?></label><br>
  <input type="date" name="fecha_ini"  onblur=" return !comprobarVacio(this)"><br>

					
<label>
<?php echo $GLOBALS['strings']['Tarea']; ?></label><br>
					<input type="text" name="descripcion_tarea" readonly value="<?php echo $this -> descripcion;?>">
					<input type="hidden" name="TAREAS_id_TAREAS" value="<?php echo $this -> id_tarea;?>">
					<br>
					
					
<label>
					<?php echo $GLOBALS['strings']['Contacto']; ?></label><br>
					<select name="CONTACTOS_email">
						<?php
							while($contactos=$this->contactos->fetch_array()){
						?>
								<option value="<?php echo $contactos[0];?>"><?php echo $contactos[0];?>

								</option>
						<?php
							}
						?>
					</select><br>

 <!-- BOTONES DE CONFIRMAR O CANCELAR NUEVO tarea -->
  
 <button type="submit" title="<?php echo $GLOBALS['strings']['Añadir fase']; ?>" value="Confirmar_ADD" name="action" class="confirmar"><i class="fas fa-plus-circle"></i></button>
<button type="submit" title="<?php echo $GLOBALS['strings']['Continuar']; ?>" value="Confirmar_CONTINUAR" name="action" class="confirmar"><i class="fas fa-arrow-right"></i></button>
<a href="<?php echo $this -> enlace;?>"><button type="button" title="<?php echo $GLOBALS['strings']['Cancelar']; ?>" class="cancelar"><i class="fas fa-times"></i></button></a>
  
</form>
 
 
 </article>
 
 <?php
	include_once "../Views/Footer.php";
	}
 }
 ?>