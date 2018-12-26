<?php

class Index {

	function __construct(){
		$this->render();
	}

	function render(){	
		header('Location:../Controllers/Tareas_Controller.php');
	}

}

?>