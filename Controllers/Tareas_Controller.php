<!---CONTROLADOR DE LA tareas
 CREADO POR mi3ac6 EL 19/11/2018-->
<?php
session_start();
include_once "../Views/MESSAGE.php";
include_once "../Functions/Authentication.php";



if (!IsAuthenticated()){ //si no está autenticado

    new MESSAGE('No puedes ver esto si no estás logueado', '../Controllers/Login_Controller.php'); //muestra el mensaje

}else{ //si lo está

	include_once "../Models/TAREAS_Model.php";
	include_once "../Models/FASES_Model.php";
	include_once "../Views/Tareas_SHOWALL.php";
	include_once "../Views/Tareas_ADD.php";
	include_once "../Views/Tareas_SEARCH.php";
	include_once "../Views/Tareas_EDIT.php";
	include_once "../Views/Tareas_SHOWCURRENT.php";
	include_once "../Views/Tareas_DELETE.php";
	include_once "../Models/PRIORIDADES_Model.php";
	include_once "../Models/CATEGORIAS_Model.php";
	include_once "../Models/CONTACTOS_Model.php";
	include_once "../Views/Fases_ADD.php";
	include_once "../Views/Fases_SHOWALL.php";


/* RECOGE LOS DATOS DEL FORMULARIO */
function getDataForm(){
	if(isset($_REQUEST['id_tarea'])){
		$id_tarea = $_REQUEST['id_tarea'];
		
	}
	else{
		$id_tarea = "";
	}
	$descripcion = $_REQUEST['descripcion'];
	$fecha_ini = $_REQUEST['fecha_ini'];
	
	if(isset($_REQUEST['fecha_fin'])){
		$fecha_fin = $_REQUEST['fecha_fin'];
	}
	else{
		$fecha_fin = "";
	}
	
	$usuarios_login = $_SESSION['login'];
	$id_categoria = $_REQUEST['id_categoria'];
	$nivel_prioridad = $_REQUEST['nivel_prioridad'];		
	
	$tarea = new TAREAS_Model ($id_tarea,$descripcion,$fecha_ini,$fecha_fin,$usuarios_login,$id_categoria,$nivel_prioridad);
	
	return $tarea;
}


if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}


switch ($_REQUEST['action']){
	case 'Confirmar_ADD':
		if(count($_REQUEST) < 4 ){
			$prioridades = new PRIORIDADES_Model("","","");
			$p = $prioridades -> search();
			
			$categorias = new CATEGORIAS_Model("","");
			$cat = $categorias -> search();
			new Tareas_ADD($p,$cat,'../Controllers/Tareas_Controller.php');
			
		}
		else{
			$tarea = getDataForm();
			
			$mensaje = $tarea-> add();
			
			/* new MESSAGE($mensaje,'../Views/Fases_ADD.php');		 */
			if($mensaje == "Insertado correcto"){
				$id_tarea =$tarea -> BuscarMaxID();
			$descripcion = $tarea -> BuscarID2();
				
				$contactos = new CONTACTOS_Model("","","","");
				$cont = $contactos -> search();
				
				new Fases_ADD($id_tarea,$descripcion,$cont,'../Controllers/Tareas_Controller.php');
			}
			 
		}
		
	break;

	case 'Confirmar_EDIT':
		if(count($_REQUEST) < 4 ){
			$prioridades = new PRIORIDADES_Model("","","");
			$p = $prioridades -> search();
			
			$categorias = new CATEGORIAS_Model("","");
			$cat = $categorias -> search();
			
			$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');
			$datos = $tarea->rellenadatos();
			new Tareas_EDIT($datos,$p,$cat,'../Controllers/Tareas_Controller.php');
		}
		else{
			
			$tarea = getDataForm();
			$mensaje = $tarea-> edit();
			new MESSAGE($mensaje,'../Controllers/Tareas_Controller.php');
		}
	break;

	
	case 'Confirmar_SEARCH':

		if(count($_REQUEST) < 4 ){					
			new Tareas_SEARCH('../Controllers/Tareas_Controller.php');
		}
		else{
			$tarea = getDataForm();
			$datos = $tarea-> search();
			new Tareas_SHOWALL($datos,'../Controllers/Tareas_Controller.php');
			
		}
	break;

	
	case 'Confirmar_DELETE1':
		
		$prioridades = new PRIORIDADES_Model("","","");
			$p = $prioridades -> search();
			
			$categorias = new CATEGORIAS_Model("","");
			$cat = $categorias -> search();
			
			$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');
			$datos = $tarea->rellenadatos();
			new Tareas_DELETE($datos,$p,$cat,'../Controllers/Tareas_Controller.php');
	break;
	
	case 'Confirmar_DELETE2':
		
			
			$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');
			$mensaje = $tarea-> delete();
			new MESSAGE($mensaje,'../Controllers/Tareas_Controller.php');
			
	break;

	case 'Confirmar_SHOWCURRENT':
		if(count($_REQUEST) < 4 ){
			
			$prioridades = new PRIORIDADES_Model("","","");
			$p = $prioridades -> search();
			
			$categorias = new CATEGORIAS_Model("","");
			$cat = $categorias -> search();
			
			$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');
			$datos = $tarea->rellenadatos();
			
			new Tareas_SHOWCURRENT($datos,$p,$cat,'../Controllers/Tareas_Controller.php');
		}
	break;

	case 'Confirmar_SHOWFASES':
		if(count($_REQUEST) < 4 ){
			
			$fase = new FASES_Model('','','','',$_REQUEST['id_tarea'],'');
			$datos = $fase->getFasesOfTarea();

			$respuesta = new Fases_SHOWALL($datos,'../Controllers/Fases_Controller.php');				
		}
	break;

	 default: /*PARA EL SHOWALL */
		$tarea = new TAREAS_Model('','','','','','','','');
		$datos = $tarea -> TareasShowAll();
		$respuesta = new Tareas_SHOWALL($datos,'../Controllers/Tareas_Controller.php');

	}
}

?>