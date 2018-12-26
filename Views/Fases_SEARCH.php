<!-- FORMULARIO PARA REGISTRAR UN NUEVO USUARIO EN LA APLICACIĂ“N
 CREADO POR mi3ac6 EL 21/11/2018-->
 <?php
 include_once '../Locales/Strings_'.$_SESSION['idioma'].'.php';
 
 class Fases_SEARCH{
	 

	var $enlace;
	
	
	function __construct($enlace){
		
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	
	function mostrar(){
		
	 include_once "../Views/Header.php";
	 
	 
?>
 <link rel="stylesheet" href="../Views/css/estilos.css" type="text/css">
 <script type="text/javascript" src="../Views/js/validaciones.js"></script>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
 
 <article class="search">
 
 <h3><?php echo $GLOBALS['strings']['Formulario para buscar fase/s'];?></h3>
 
 <form enctype="multipart/form-data" action="../Controllers/Fases_Controller.php" method="post" id="search" name="search">
 


   <label>
   <?php echo $GLOBALS['strings']['Descripcion']; ?></label><br>
  <input type="text" name="descripcion"  size="40" ><br>
  
  
  <label>
  <?php echo $GLOBALS['strings']['Fecha inicio']; ?></label><br>
  <input type="text" name="fecha_ini"><br>
  
  <label>
  <?php echo $GLOBALS['strings']['Fecha fin']; ?></label><br>
  <input type="text" name="fecha_fin"><br>
  
  <label>
   <?php echo $GLOBALS['strings']['Tarea']; ?></label><br>
  <input type="text" name="TAREAS_id_TAREAS" ><br>
  
  <label>
   <?php echo $GLOBALS['strings']['Contacto']; ?></label><br>
  <input type="text" name="CONTACTOS_email" ><br>
  
 


 <!-- BOTONES DE CONFIRMAR O CANCELAR BUSQUEDA -->
  
  <button type="submit" title="<?php echo $GLOBALS['strings']['Buscar fase']; ?>" value="Confirmar_SEARCH" name="action" class="confirmar"><i class="fas fa-search"></i></button>
<a href="<?php echo $this -> enlace;?>"><button type="button" title="<?php echo $GLOBALS['strings']['Cancelar']; ?>" class="cancelar"><i class="fas fa-times"></i></button></a>
  
</form>
 
 
 </article>
 
 <?php
	include_once "../Views/Footer.php";
	}
 }
 ?>