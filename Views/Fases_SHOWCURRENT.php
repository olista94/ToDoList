<!-- TABLA QUE MUESTRA TODOS LOS DATOS DE UN USUARIO QUE JUEGA LA LOTERIAIU
 CREADO POR mi3ac6 EL 17/11/2018-->
 
  <?php
 class Tareas_SHOWCURRENT{
	 

	var $fila;
	var $prioridades;
	var $categorias;
	var $enlace;
	
	function __construct($fila,$prioridades,$categorias,$enlace){
		
		$this -> fila = $fila -> fetch_array();
		
		$this -> prioridades = $prioridades -> fetch_array();
		$this -> categorias = $categorias -> fetch_array();
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	
	function mostrar(){
		
	 include_once "../Views/Header.php";

	 
	 
?>
  <article class="tablashowcurrent">
 <table >
 <tr><th colspan="2"><?php echo $GLOBALS['strings']['Datos del usuario seleccionado']; ?></th></tr>
 <tr><td><?php echo $GLOBALS['strings']['Id tarea']; ?></td><td><?php echo $this -> fila[0]; ?></td></tr>
 <tr><td><?php echo $GLOBALS['strings']['Descripcion']; ?></td><td><?php echo $this -> fila[1]; ?></td></tr>
 <tr><td><?php echo $GLOBALS['strings']['Fecha inicio']; ?></td><td><?php echo $this -> fila[2]; ?></td></tr>
 <tr><td><?php echo $GLOBALS['strings']['Fecha fin']; ?></td><td><?php echo $this -> fila[3]; ?></td></tr>
 <tr><td><?php echo $GLOBALS['strings']['Usuario']; ?></td><td><?php echo $this -> fila[4]; ?></td></tr>
 <tr><td><?php echo $GLOBALS['strings']['Categoria']; ?></td><td><?php echo $this -> categorias[1]; ?></td></tr>
 <tr><td><?php echo $GLOBALS['strings']['Prioridad']; ?></td><td><?php echo $this -> prioridades[1]; ?></td></tr>


 </table>
 <a href="../Controllers/Tareas_Controller.php"><i class="fas fa-arrow-left"></i>
 
 </article>
 
   <?php
	include_once "../Views/Footer.php";
	}
 }
 ?>