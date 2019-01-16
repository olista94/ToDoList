<!-- MOSTRARA LA VISTA POR DEFECTO
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

<?php

class Index {
  //Constructor de la clase
	function __construct(){
		$this->render();
	}
  //Pagina principal de la aplicación
	function render(){	
		header('Location:../Controllers/Tareas_Controller.php');
	}

}

?>