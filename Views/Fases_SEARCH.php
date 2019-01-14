
 <?php
 
 class Fases_SEARCH{
	 
//Variable con el enlace al form de SEARCH fase
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
 <!--Formulario para buscar fase-->
 <form class="formB" enctype="multipart/form-data" action="../Controllers/Fases_Controller.php" method="post" id="search" name="search">
  <legend><?php echo $strings['Buscar fase'];?>
  <!--Boton para volver atrás -->
  <button type="button" onclick="location.href='../Controllers/Tareas_Controller.php?action=Confirmar_SHOWFASES&id_tarea=<?php echo $_REQUEST['TAREAS_id_TAREAS']; ?>';" class="volver"></button>
  </legend>
 <!--Clave de la tarea que se pasa como hidden al model-->
 <input type="hidden" name="TAREAS_id_TAREAS" value="<?php echo $_REQUEST['TAREAS_id_TAREAS']; ?>">

<!--Campo ID de la fase-->
 <label>
   <?php echo $GLOBALS['strings']['ID fase']; ?></label><br>
  <input type="text" name="id_fase"  size="5" ><br>
<!--Campo descripcion de la fase-->
   <label>
   <?php echo $GLOBALS['strings']['Descripcion']; ?></label><br>
  <input type="text" name="descripcion"  size="40" ><br>
  
  <!--Campo fecha inicio de la fase-->
  <label>
  <?php echo $GLOBALS['strings']['Fecha inicio']; ?></label><br>
  <input type="text" name="fecha_ini"><br>
  
  <!--Campo fecha fin de la fase-->
  <label>
  <?php echo $GLOBALS['strings']['Fecha fin']; ?></label><br>
  <input type="text" name="fecha_fin"><br>
  

 


 <!-- BOTON DE CONFIRMAR BUSQUEDA -->
 <button type="submit" name="action" value="Confirmar_SEARCH" class="buscar"></button>
  
</form>
 
 
 </article>
 
 <?php
 //Pie
	include_once "../Views/Footer.php";
	}
 }
 ?>