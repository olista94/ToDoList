<!---CONTROLADOR DE LA Prioridades
 CREADO POR mi3ac6 EL 19/11/2018-->
<?php
session_start();
include_once "../Views/MESSAGE.php";
include_once "../Functions/Authentication.php";
if(isset($_SESSION['tipo'])){
	if($_SESSION['tipo']=='ADMIN'){

		if (!IsAuthenticated()){ //si no está autenticado
			new MESSAGE('No puedes ver esto si no estás logueado', '../Controllers/Login_Controller.php'); //muestra el mensaje
		}else{ //si lo está
			include_once "../Models/PRIORIDADES_Model.php";
			include_once "../Views/Prioridades_SHOWALL.php";
			include_once "../Views/Prioridades_ADD.php";
			include_once "../Views/Prioridades_SEARCH.php";
			include_once "../Views/Prioridades_EDIT.php";
			include_once "../Views/Prioridades_SHOWCURRENT.php";
			include_once "../Views/Prioridades_DELETE.php";
			include_once "../Models/TAREAS_Model.php";
			include_once "../Models/CATEGORIAS_Model.php";

			/* RECOGE LOS DATOS DEL FORMULARIO */
			function getDataForm(){
				$nivel = $_REQUEST['nivel'];
				$descripcion = $_REQUEST['descripcion'];
				$color = $_REQUEST['color'];				
				
				$prioridad = new Prioridades_Model($nivel,$descripcion,$color);
				
				return $prioridad;
			}

			if(!isset($_REQUEST['action'])){
				$_REQUEST['action'] = '';
			}

			switch ($_REQUEST['action']){

				case 'Confirmar_ADD':
					if(count($_REQUEST) < 4 ){				
						new Prioridades_ADD('../Controllers/Prioridades_Controller.php');
					}else{
						$prioridad = getDataForm();
						$mensaje = $prioridad-> add();
						new MESSAGE($mensaje,'../Controllers/Prioridades_Controller.php');				
					}			
				break;

				case 'Confirmar_EDIT':
					if(count($_REQUEST) < 4 ){
						$prioridad = new PRIORIDADES_Model($_REQUEST['nivel'],'','');
						$datos = $prioridad->rellenadatos();
						new Prioridades_EDIT($datos,'../Controllers/Prioridades_Controller.php');
					}else{				
						$prioridad = getDataForm();
						$mensaje = $prioridad-> edit();
						new MESSAGE($mensaje,'../Controllers/Prioridades_Controller.php');
					}
				break;

				
				case 'Confirmar_SEARCH':
					if(count($_REQUEST) < 4 ){				
						new Prioridades_SEARCH('../Controllers/Prioridades_Controller.php');
					}else{
						$prioridad = getDataForm();
						$datos = $prioridad-> search();
						new Prioridades_SHOWALL($datos,'../Controllers/Prioridades_Controller.php');				
					}
				break;
				
				case 'Confirmar_DELETE1':			
						$prioridad = new PRIORIDADES_Model($_REQUEST['nivel'],'','');
						$datos = $prioridad->rellenadatos();
						new Prioridades_DELETE($datos,'../Controllers/Prioridades_Controller.php');
				break;
				
				case 'Confirmar_DELETE2':				
						$prioridad = new PRIORIDADES_Model($_REQUEST['nivel'],'','');
						$mensaje = $prioridad-> delete();
						new MESSAGE($mensaje,'../Controllers/Prioridades_Controller.php');				
				break;

				case 'Confirmar_SHOWCURRENT':
					if(count($_REQUEST) < 4 ){
						$prioridad = new PRIORIDADES_Model($_REQUEST['nivel'],'','');
						$datos = $prioridad->rellenadatos();
						new Prioridades_SHOWCURRENT($datos,'../Controllers/Prioridades_Controller.php');
					}
				break;

				default: /*PARA EL SHOWALL */
					$prioridad = new PRIORIDADES_Model('','','');
					$datos = $prioridad -> search();
					$respuesta = new Prioridades_SHOWALL($datos,'../Controllers/Prioridades_Controller.php');
			}
		}
	}else{
		new MESSAGE('No puedes ver esto si no eres administrador', '../Controllers/Index_Controller.php'); //muestra el mensaje
	}
}
?>