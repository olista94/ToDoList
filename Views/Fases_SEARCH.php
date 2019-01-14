
 <?php
 
 class Fases_SEARCH{
	 

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
 
 <form class="formB" enctype="multipart/form-data" action="../Controllers/Fases_Controller.php" method="post" id="search" name="search">
  <legend><?php echo $strings['Buscar fase'];?>
  <button type="button" onclick="location.href='../Controllers/Tareas_Controller.php?action=Confirmar_SHOWFASES&id_tarea=<?php echo $_REQUEST['TAREAS_id_TAREAS']; ?>';" class="volver"></button>
  </legend>

 <input type="hidden" name="TAREAS_id_TAREAS" value="<?php echo $_REQUEST['TAREAS_id_TAREAS']; ?>">

 <label>
   <?php echo $GLOBALS['strings']['ID fase']; ?></label><br>
  <input type="text" name="id_fase"  size="5" ><br>

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
   <?php echo $GLOBALS['strings']['Contacto']; ?></label><br>
  <input type="text" name="CONTACTOS_email" ><br>
  
 


 <!-- BOTONES DE CONFIRMAR O CANCELAR BUSQUEDA -->
 <button type="submit" name="action" value="Confirmar_SEARCH" class="buscar"></button>
  
</form>
 
 
 </article>
 
 <?php
	include_once "../Views/Footer.php";
	}
 }
 ?>