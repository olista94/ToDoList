<!---CONTROLADOR DE LA tareas
 CREADO POR mi3ac6 EL 19/11/2018-->
<?php
session_start();
include_once "../Views/MESSAGE.php";
include_once "../Views/ALERT.php";
include_once "../Functions/Authentication.php";

if (!IsAuthenticated()){ //si no está autenticado
    new MESSAGE('No puedes ver esto si no estás logueado', '../Controllers/Login_Controller.php'); //muestra el mensaje
}else{ //si lo está

	include_once "../Models/TAREAS_Model.php";
	include_once "../Models/FASES_Model.php";
	include_once "../Models/ARCHIVOS_Model.php";
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
	include_once "../Views/Tareas_SHOWCOMPLETE.php";
	include_once "../Views/Tareas_SHOWUNCOMPLETE.php";
	include_once "../Models/FASES_HAS_CONTACTOS_Model.php";


	/* RECOGE LOS DATOS DEL FORMULARIO */
	function getDataForm(){

		if(isset($_REQUEST['id_tarea'])){
			$id_tarea = $_REQUEST['id_tarea'];
			
		}else{
			$id_tarea = "";
		}

		$descripcion = $_REQUEST['descripcion'];
		
		if(isset($_REQUEST['fecha_ini'])){
			$fecha_ini = $_REQUEST['fecha_ini'];
		}else{
			$fecha_ini = "";
		}
		
		if(isset($_REQUEST['fecha_fin'])){
			$fecha_fin = $_REQUEST['fecha_fin'];
		}else{
			$fecha_fin = "";
		}
		
		if(isset($_REQUEST['completada'])){
			$completada = $_REQUEST['completada'];
		}else{
			$completada = "";
		}

		if(isset($_REQUEST['USUARIOS_login'])){
			$usuarios_login = $_REQUEST['USUARIOS_login'];
		}else{
			$usuarios_login = $_SESSION['login'];
		}
		
		$id_categoria = $_REQUEST['id_categoria'];
		$nivel_prioridad = $_REQUEST['nivel_prioridad'];		
		
		$tarea = new TAREAS_Model ($id_tarea,$descripcion,$fecha_ini,$fecha_fin,$completada,$usuarios_login,$id_categoria,$nivel_prioridad);
		
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
			}else{
				$tarea = getDataForm();			
				$mensaje = $tarea-> add();
				
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
				$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');
				$datos = $tarea->rellenadatos();

				$array = $datos -> fetch_array();
				$prioridades = new PRIORIDADES_Model("","","");
				$p = $prioridades -> search();
				
				$categorias = new CATEGORIAS_Model("","");
				$cat = $categorias -> search();

				$datos = $tarea->rellenadatos();

				new Tareas_EDIT($datos,$p,$cat,'../Controllers/Tareas_Controller.php');
			}else{			
				$tarea = getDataForm();
				$mensaje = $tarea-> edit();
				new MESSAGE($mensaje,'../Controllers/Tareas_Controller.php');
			}
		break;

		case 'Confirmar_SEARCH1':							
			new Tareas_SEARCH('../Controllers/Tareas_Controller.php');
		break;

		case 'Confirmar_SEARCH2':
			if(isset($_SESSION['tipo'])){
				if($_SESSION['tipo']=='ADMIN'){
					$tarea = getDataForm();
					$datos = $tarea-> search1();
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
					new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');
				}else{
					$tarea = getDataForm();
					$datos = $tarea-> search1();
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
					new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');
				}
			}		
		break;

		
		case 'Confirmar_DELETE1':		
			$prioridades = new PRIORIDADES_Model("","","");
			if(count($_REQUEST) < 4 ){			
				$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');
				$datos = $tarea->rellenadatos();
				
				$array = $datos -> fetch_array();
				$prioridades = new PRIORIDADES_Model($array['PRIORIDADES_nivel'],"","");
				$p = $prioridades -> searchById();
				
				$categorias = new CATEGORIAS_Model($array['CATEGORIAS_id_CATEGORIAS'],"");
				$cat = $categorias -> searchById();
				$datos = $tarea->rellenadatos();
				
				new Tareas_DELETE($datos,$p,$cat,'../Controllers/Tareas_Controller.php');
			}
		break;
		
		case 'Confirmar_DELETE2':		
			$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');
			$mensaje = $tarea-> delete();
			new MESSAGE($mensaje,'../Controllers/Tareas_Controller.php');			
		break;

		case 'Confirmar_SHOWCURRENT':
			if(count($_REQUEST) < 4 ){			
				$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');
				$datos = $tarea->rellenadatos();
				
				$array = $datos -> fetch_array();
				$prioridades = new PRIORIDADES_Model($array['PRIORIDADES_nivel'],"","");
				$p = $prioridades -> searchById();
				
				$categorias = new CATEGORIAS_Model($array['CATEGORIAS_id_CATEGORIAS'],"");
				$cat = $categorias -> searchById();
				$datos = $tarea->rellenadatos();
				
				new Tareas_SHOWCURRENT($datos,$p,$cat,'../Controllers/Tareas_Controller.php');
			}
		break;

		case 'Confirmar_SHOWFASES':
			if(count($_REQUEST) < 4 ){			
				$fase = new FASES_Model('','','','','',$_REQUEST['id_tarea'],'');
				$datos = $fase->getFasesOfTarea();

				$archivos = new ARCHIVOS_Model('','','','',$_REQUEST['id_tarea']);
				$archivo = $archivos -> getArchivosOfTarea();

				$contactos = new FASES_HAS_CONTACTOS_Model('',$_REQUEST['id_tarea'],'');
				$contacto = $contactos -> getContactosOfTarea();
				
				$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');
				$t = $tarea -> TareasCompleto();

				$respuesta = new Fases_SHOWALL($datos,$archivo,$contacto,$t,'../Controllers/Fases_Controller.php');				
			}
		break;

		case 'Confirmar_COMPLETADA':		
			if(isset($_SESSION['tipo'])){
				if($_SESSION['tipo']=='ADMIN'){		
					$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');

					$alert = $tarea-> puedeCompletar();
					$datos = $tarea->TareasShowAll();
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
				
					new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');
					new ALERT($alert);
				}else{
					$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');

					$alert = $tarea-> puedeCompletar();
					$datos = $tarea->TareasShowAllNormal();
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();

					new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');
					new ALERT($alert);
				}
			}
		break;

		case 'Confirmar_NO_COMPLETADA':

		if(isset($_SESSION['tipo'])){
			if($_SESSION['tipo']=='ADMIN'){
				$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');

				$alert = $tarea-> puedeDescompletar();
				$datos = $tarea->TareasShowAll();
				$archivos = $tarea -> ContarArchivos();
				$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();

				new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');
				new ALERT($alert);
			}else{
				$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');

				$alert = $tarea-> puedeDescompletar();
				$datos = $tarea->TareasShowAllNormal();
				$archivos = $tarea -> ContarArchivos();
				$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();

				new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');
				new ALERT($alert);
			}
		}
		break;
		
		case 'Ordenar_Fecha':
			if(isset($_SESSION['tipo'])){
				if($_SESSION['tipo']=='ADMIN'){
				
					$tarea = new TAREAS_Model('','','','','','','','');
					$datos = $tarea -> OrdenarFecha();
					
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
					/* print_r($datos); */
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');			
			
				}else{
					$tarea = new TAREAS_Model('','','','','','','','');
					$datos = $tarea -> OrdenarFechaNormal();
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
					/* print_r($datos); */
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');	
				}
			}
		break;

		case 'Ordenar_Prioridad':
			if(isset($_SESSION['tipo'])){
				if($_SESSION['tipo']=='ADMIN'){
					
					$tarea = new TAREAS_Model('','','','','','','','');
					$datos = $tarea -> OrdenarPrioridad();
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
					/* print_r($datos); */
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');				
				}else{
					$tarea = new TAREAS_Model('','','','','','','','');
					$datos = $tarea -> OrdenarPrioridadNormal();
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
					/* print_r($datos); */
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');	
				}
			}			
		break;
		
		case 'Ordenar_Categoria':
			if(isset($_SESSION['tipo'])){
				if($_SESSION['tipo']=='ADMIN'){
					$tarea = new TAREAS_Model('','','','','','','','');
					$datos = $tarea -> OrdenarCategoria();
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
					/* print_r($datos); */
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');			
				
				}else{
					$tarea = new TAREAS_Model('','','','','','','','');
					$datos = $tarea -> OrdenarCategoriaNormal();
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
					/* print_r($datos); */
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');	
				}
			}
		break;
		
		case 'Mostrar_Completas':
		if(isset($_SESSION['tipo'])){
			if($_SESSION['tipo']=='ADMIN'){
				$tarea = new TAREAS_Model('','','','','','','','');					
				$datos = $tarea -> TareasShowAll();				
				$archivos = $tarea -> ContarArchivos();
				$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
				$respuesta = new Tareas_SHOWCOMPLETE($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');			
			}else{
				$tarea = new TAREAS_Model('','','','','','','','');
				$datos = $tarea -> TareasShowAllNormal();
				/* print_r($datos); */
				$archivos = $tarea -> ContarArchivos();
				$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
				$respuesta = new Tareas_SHOWCOMPLETE($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');		
			}
		}
		break;
		
		case 'Mostrar_NoCompletas':
		if(isset($_SESSION['tipo'])){
			if($_SESSION['tipo']=='ADMIN'){
				$tarea = new TAREAS_Model('','','','','','','','');					
				$datos = $tarea -> TareasShowAll();				
				$archivos = $tarea -> ContarArchivos();
				$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
				$respuesta = new Tareas_SHOWUNCOMPLETE($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');				
			}else{
				$tarea = new TAREAS_Model('','','','','','','','');
				$datos = $tarea -> TareasShowAllNormal();
				/* print_r($datos); */
				$archivos = $tarea -> ContarArchivos();
				$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
				
				$respuesta = new Tareas_SHOWUNCOMPLETE($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');		
			}
		}
		break;	

		default: /*PARA EL SHOWALL */
			if(isset($_SESSION['tipo'])){
				if($_SESSION['tipo']=='ADMIN'){		   
					$tarea = new TAREAS_Model('','','','','','','','');
					
					$datos = $tarea -> TareasShowAll();
					
					$archivos = $tarea -> ContarArchivos();
					
					$fases = $tarea -> ContarFases();
					
					$contactos = $tarea -> ContarContactos();
					
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');				
				}else{		   
					$tarea = new TAREAS_Model('','','','','','','','');
					$datos = $tarea -> TareasShowAllNormal();
					/* print_r($datos); */
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
					$contactos = $tarea -> ContarContactos();
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');
				}	 
			}
	}
}
?>