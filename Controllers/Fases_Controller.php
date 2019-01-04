<!---CONTROLADOR DE LA Fases
 CREADO POR mi3ac6 EL 19/11/2018-->
<?php
session_start();
include_once "../Views/MESSAGE.php";
include_once "../Views/ALERT.php";
include_once "../Functions/Authentication.php";

if (!IsAuthenticated()){ //si no está autenticado

    new MESSAGE('No puedes ver esto si no estás logueado', '../Controllers/Login_Controller.php'); //muestra el mensaje

}else{ //si lo está

	include_once "../Models/FASES_Model.php";
	include_once "../Views/Fases_SHOWALL.php";
	include_once "../Views/Fases_ADD.php";
	include_once "../Views/Fases_SEARCH.php";
	include_once "../Views/Fases_EDIT.php";
	include_once "../Views/Fases_SHOWCURRENT.php";
	include_once "../Views/Fases_SHOWSEARCH.php";
	include_once "../Views/Fases_DELETE.php";
	include_once "../Models/PRIORIDADES_Model.php";
	include_once "../Models/CATEGORIAS_Model.php";
	include_once "../Models/TAREAS_Model.php";
	include_once "../Models/CONTACTOS_Model.php";
	include_once "../Models/ARCHIVOS_Model.php";


/* RECOGE LOS DATOS DEL FORMULARIO */
function getDataForm(){
	/* print_r($_REQUEST); */
	if(isset($_REQUEST['id_fase'])){
		$id_fase = $_REQUEST['id_fase'];
	}
	else{
		$id_fase = "";
	}
	$descripcion = $_REQUEST['descripcion'];
	$fecha_ini = $_REQUEST['fecha_ini'];
	
	if(isset($_REQUEST['fecha_fin'])){
		$fecha_fin = $_REQUEST['fecha_fin'];
	}
	else{
		$fecha_fin = "";
	}

	if(isset($_REQUEST['completada'])){
		$completada = $_REQUEST['completada'];
	}
	else{
		$completada = "";
	}

	if(isset($_REQUEST['TAREAS_id_TAREAS'])){
		$TAREAS_id_TAREAS = $_REQUEST['TAREAS_id_TAREAS'];
	}
	else{
		$TAREAS_id_TAREAS = "";
	}
	
	$CONTACTOS_email = $_REQUEST['CONTACTOS_email'];
	
	$fase = new FASES_Model ($id_fase,$descripcion,$fecha_ini,$fecha_fin,$completada,$TAREAS_id_TAREAS,$CONTACTOS_email);
	
	return $fase;
}


if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}


switch ($_REQUEST['action']){
	case 'Confirmar_ADD':
		if(count($_REQUEST) < 4 ){
			/* $prioridades = new PRIORIDADES_Model("","","");
			$p = $prioridades -> search(); */
			//die($_REQUEST['TAREAS_id_TAREAS']);
			$tarea = new TAREAS_Model($_REQUEST['TAREAS_id_TAREAS'],"","","","","","","");
			$id_tarea =$tarea -> BuscarMaxID();
			$descripcion = $tarea -> BuscarDescripcion();
			
			$contactos = new CONTACTOS_Model("","","","");
			$cont = $contactos -> search();
			
			new Fases_ADD($_REQUEST['TAREAS_id_TAREAS'],$descripcion,$cont,'../Controllers/Tareas_Controller.php');
			
		}
		else{

			$fase = getDataForm();
			$mensaje = $fase-> add();
			
			$idFase = $fase -> BuscarIDFase();

			if($_FILES["archivo"]['size'][0] > 0) {

				$output_dir = "../Files/";//Path for file upload
				$fileCount = count($_FILES["archivo"]['name']);				
				for($i=0; $i < $fileCount; $i++){
					$RandomNum = time();
					$ImageName = str_replace(' ','-',strtolower($_FILES['archivo']['name'][$i]));
					$ImageType = $_FILES['archivo']['type'][$i]; //"image/png", image/jpeg etc.
					$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
					$ImageExt = str_replace('.','',$ImageExt);
					$ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
					$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
					$ruta= $output_dir.$NewImageName;
					move_uploaded_file($_FILES["archivo"]["tmp_name"][$i],$output_dir."/".$NewImageName );

					$model = new ARCHIVOS_Model('',$ImageName,$ruta,$idFase,$_REQUEST['TAREAS_id_TAREAS']);
					$model -> add();
				}
			}

			new MESSAGE($mensaje,'../Controllers/Tareas_Controller.php');		
			 
		}
		
	break;
	
	case 'Confirmar_CONTINUAR':	
				
		$tareas = new TAREAS_Model($_REQUEST['TAREAS_id_TAREAS'],"","","","","","","");
		$t = $tareas -> search();
		
		$contactos = new CONTACTOS_Model("","","","");
		$cont = $contactos -> search();

		$descripcion = $tareas -> BuscarDescripcion();
						
		new Fases_ADD($_REQUEST['TAREAS_id_TAREAS'],$descripcion,$cont,'../Controllers/Fases_Controller.php');
		
		$fase = getDataForm();
		$mensaje = $fase-> add();

		$idFase = $fase -> BuscarIDFase();
		if($_FILES["archivo"]['size'][0] > 0) {
			$output_dir = "../Files/";//Path for file upload
			$fileCount = count($_FILES["archivo"]['name']);
			for($i=0; $i < $fileCount; $i++){
				$RandomNum = time();
				$ImageName = str_replace(' ','-',strtolower($_FILES['archivo']['name'][$i]));
				$ImageType = $_FILES['archivo']['type'][$i]; //"image/png", image/jpeg etc.
				$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
				$ImageExt = str_replace('.','',$ImageExt);
				$ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
				$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt;
				$ruta= $output_dir.$NewImageName;
				move_uploaded_file($_FILES["archivo"]["tmp_name"][$i],$output_dir."/".$NewImageName );

				$model = new ARCHIVOS_Model('',$ImageName,$ruta,$idFase,$_REQUEST['TAREAS_id_TAREAS']);
				$model -> add();
			}
		}
		
		new ALERT($mensaje);

	break;

	case 'Confirmar_EDIT':
		if(count($_REQUEST) < 4 ){			
			
			$contactos = new CONTACTOS_Model("","","","");
			$cont = $contactos -> search();
						
			
			$fase = new FASES_Model($_REQUEST['id_fase'],'','','','','','');
			$datos = $fase->rellenadatos();			
			
			new Fases_EDIT($datos,$cont,'../Controllers/Fases_Controller.php');
		}
		else{			
			$fase = getDataForm();
			$mensaje = $fase-> edit();
			new MESSAGE($mensaje,'../Controllers/Fases_Controller.php');
		}
	break;

	case 'Confirmar_COMPLETADA':	
		$fase = new FASES_Model($_REQUEST['id_fase'],'','','','',$_REQUEST['TAREAS_id_TAREAS'],'');

		$mensaje = $fase-> setCompletada();
		$datos = $fase->getFasesOfTarea();

		$archivos = new ARCHIVOS_Model('','','','',$_REQUEST['TAREAS_id_TAREAS']);
		$archivo = $archivos -> getArchivosOfTarea();

		$tarea = new TAREAS_Model($_REQUEST['TAREAS_id_TAREAS'],'','','','','','','');
		$t = $tarea -> TareasCompleto();

		new Fases_SHOWALL($datos,$archivo,$t,'../Controllers/Fases_Controller.php');
		new ALERT($mensaje);
	break;

	case 'Confirmar_NO_COMPLETADA':
		$fase = new FASES_Model($_REQUEST['id_fase'],'','','','',$_REQUEST['TAREAS_id_TAREAS'],'');

		$mensaje = $fase-> setNoCompletada();
		$datos = $fase->getFasesOfTarea();

		$archivos = new ARCHIVOS_Model('','','','',$_REQUEST['TAREAS_id_TAREAS']);
		$archivo = $archivos -> getArchivosOfTarea();

		$tarea = new TAREAS_Model($_REQUEST['TAREAS_id_TAREAS'],'','','','','','','');
		$t = $tarea -> TareasCompleto();

		new Fases_SHOWALL($datos,$archivo,$t,'../Controllers/Fases_Controller.php');
		new ALERT($mensaje);
	break;
	
	case 'Confirmar_SEARCH':
		if(count($_REQUEST) < 4 ){			
			new Fases_SEARCH('../Controllers/Fases_Controller.php');
		}
		else{
			$fase = getDataForm();
			$datos = $fase-> search();
			new Fases_SHOWSEARCH($datos,'','../Controllers/Fases_Controller.php');
			
		}
	break;

	
	case 'Confirmar_DELETE1':		
		$prioridades = new PRIORIDADES_Model("","","");
		$p = $prioridades -> search();
		
		$categorias = new CATEGORIAS_Model("","");
		$cat = $categorias -> search();
		
		$fase = new FASES_Model($_REQUEST['id_fase'],'','','','','','');
		$datos = $fase->rellenadatos();
		new Fases_DELETE($datos,$p,$cat,'../Controllers/Fases_Controller.php');
	break;
	
	case 'Confirmar_DELETE2':			
		$fase = new FASES_Model($_REQUEST['id_fase'],'','','','','','','');
		$mensaje = $fase-> delete();
		new MESSAGE($mensaje,'../Controllers/Tareas_Controller.php');
			
	break;

	case 'Confirmar_SHOWCURRENT':
		if(count($_REQUEST) < 4 ){

			$archivos = new ARCHIVOS_Model('','','',$_REQUEST['id_fase'],'');
			$archivo = $archivos -> getArchivosOfFase();
			
			$fase = new FASES_Model($_REQUEST['id_fase'],'','','','','','');
			$datos = $fase->rellenadatos();
			new Fases_SHOWCURRENT($datos,$archivo,'../Controllers/Fases_Controller.php');
		}
	break;
	


	default: /*PARA EL SHOWALL */
		$fase = new FASES_Model('','','','','','','');
		$datos = $fase -> FasesShowAll();
		$respuesta = new Fases_SHOWALL($datos,'','../Controllers/Fases_Controller.php');
	}

}

?>