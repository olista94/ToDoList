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

		//Comprueba si está el campo
		if(isset($_REQUEST['id_tarea'])){
			$id_tarea = $_REQUEST['id_tarea'];//Si el campo se le ha pasado se le asigna
		}else{
			$id_tarea = ""; //Si no, se pone como vacío
		}

		$descripcion = $_REQUEST['descripcion'];//Si el campo se le ha pasado se le asigna
		
		//Comprueba si está el campo
		if(isset($_REQUEST['fecha_ini'])){
			$fecha_ini = $_REQUEST['fecha_ini'];//Si el campo se le ha pasado se le asigna
		}else{
			$fecha_ini = ""; //Si no, se pone como vacío
		}
		
		//Comprueba si está el campo
		if(isset($_REQUEST['fecha_fin'])){
			$fecha_fin = $_REQUEST['fecha_fin'];//Si el campo se le ha pasado se le asigna
		}else{
			$fecha_fin = ""; //Si no, se pone como vacío
		}
		
		//Comprueba si está el campo
		if(isset($_REQUEST['completada'])){
			$completada = $_REQUEST['completada'];//Si el campo se le ha pasado se le asigna
		}else{
			$completada = ""; //Si no, se pone como vacío
		}

		//Comprueba si está el campo
		if(isset($_REQUEST['USUARIOS_login'])){
			$usuarios_login = $_REQUEST['USUARIOS_login'];//Si el campo se le ha pasado se le asigna
		}else{
			$usuarios_login = $_SESSION['login']; //Si no, se pone como vacío
		}
		
		$id_categoria = $_REQUEST['id_categoria'];//Si el campo se le ha pasado se le asigna
		$nivel_prioridad = $_REQUEST['nivel_prioridad'];//Si el campo se le ha pasado se le asigna	
		
		//Construye el objeto tarea con los parámetros
		$tarea = new TAREAS_Model ($id_tarea,$descripcion,$fecha_ini,$fecha_fin,$completada,$usuarios_login,$id_categoria,$nivel_prioridad);
		
		//Devuelve el objeto tarea
		return $tarea;
	}

	//Comprueba si hay una accion seleccionada desde la vista
	if(!isset($_REQUEST['action'])){
		$_REQUEST['action'] = '';
	}

	//Accioneas a realizar según la acción que venga de la vista
	switch ($_REQUEST['action']){
		//Añadir una tarea desde el showall
		case 'Confirmar_ADD':
			//Si no se le están pasando datos entonces crea una vista para añadir
			if(count($_REQUEST) < 4 ){
				$prioridades = new PRIORIDADES_Model("","",""); //Construye el objeto prioridades llamando al modelo
				$p = $prioridades -> search(); //Busca las prioridades
				
				$categorias = new CATEGORIAS_Model("",""); //Construye el objeto categorias llamando al modelo
				$cat = $categorias -> search(); //Busca las categorias
				new Tareas_ADD($p,$cat,'../Controllers/Tareas_Controller.php');	//Crea la vista de añadir
			//Si se le pasan datos entonces los recoge
			}else{
				$tarea = getDataForm();	//Asigna los datos obtenidos al objeto tarea		
				$mensaje = $tarea-> add(); //Llama al modelo para añadirla y le pasa la respuesta a MESSAGE
				
				//Si el insertado es correcto
				if($mensaje == "Insertado correcto"){
					$id_tarea =$tarea -> BuscarMaxID(); //Se busca el id de la tarea que se acaba de insertar
					$descripcion = $tarea -> BuscarID2(); //Se busca la descripcion de la tarea
					
					$contactos = new CONTACTOS_Model("","","",""); //Se crea un objeto contacto
					$cont = $contactos -> search(); //Se buscan todos los contactos
					
					new Fases_ADD($id_tarea,$descripcion,$cont,'../Controllers/Tareas_Controller.php'); //Se crea una vista para añadir fases a la tarea creada
				}			 
			}		
		break;

		//Editar una tarea
		case 'Confirmar_EDIT':
			//Si no se le están pasando datos entonces crea una vista para editar
			if(count($_REQUEST) < 4 ){			
				$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','',''); //Construye el objeto TAREAS con el id de la tarea que se pasa
				$datos = $tarea->rellenadatos(); //Se rellenan los datos de la tarea

				$array = $datos -> fetch_array(); //Se construye el array con los datos
				$prioridades = new PRIORIDADES_Model("","",""); //Se crea el objeto prioridades
				$p = $prioridades -> search(); //Se buscan las prioridades y se meten en p
				
				$categorias = new CATEGORIAS_Model("",""); //Se crea el objeto categorias
				$cat = $categorias -> search(); //Se buscan las categorias y se meten en cat

				$datos = $tarea->rellenadatos(); //Se rellenan los datos de la tarea

				new Tareas_EDIT($datos,$p,$cat,'../Controllers/Tareas_Controller.php'); //Se crea una vista para editar una tarea
			//Si se le han pasado datos
			}else{			
				$tarea = getDataForm(); //Se cogen los datos del formulario
				$mensaje = $tarea-> edit(); //Se edita con los nuevos datos y se guarda el mensaje de retorno
				new MESSAGE($mensaje,'../Controllers/Tareas_Controller.php'); //Se crea la vista de mensaje con el mensaje
			}
		break;

		//Si se selecciona la accion buscar desde el showall
		case 'Confirmar_SEARCH1':							
			new Tareas_SEARCH('../Controllers/Tareas_Controller.php'); //Se crea la vista para buscar
		break;

		//Si se le da a buscar desde la vista de buscar
		case 'Confirmar_SEARCH2':
			//Si el usuario es de tipo admin puede buscar entre todas las tareas
			if(isset($_SESSION['tipo'])){
				if($_SESSION['tipo']=='ADMIN'){
					$tarea = getDataForm(); //Se llena el objeto tarea con los datos del formulario
					$datos = $tarea-> searchAdmin(); //Se busca la tarea y se guardan los datos
					$archivos = $tarea -> ContarArchivos(); //Se cuentan los archivos de la tarea
					$fases = $tarea -> ContarFases(); //Se cuentan las fases de la tarea
					$contactos = $tarea -> ContarContactos(); //Se cuentan los contactos de la tarea
				
					new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php'); //Se muestran las tareas encontradas en un showall
				//En otro caso el usuario es un usuario normal
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
					
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');			
			
				}else{
					$tarea = new TAREAS_Model('','','','','','','','');
					$datos = $tarea -> OrdenarFechaNormal();
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
					
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
					
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');				
				}else{
					$tarea = new TAREAS_Model('','','','','','','','');
					$datos = $tarea -> OrdenarPrioridadNormal();
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
					
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
					
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');			
				
				}else{
					$tarea = new TAREAS_Model('','','','','','','','');
					$datos = $tarea -> OrdenarCategoriaNormal();
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
				$contactos = $tarea -> ContarContactos();
					
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
					
					$archivos = $tarea -> ContarArchivos();
					$fases = $tarea -> ContarFases();
					$contactos = $tarea -> ContarContactos();
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');
				}	 
			}
	}
}
?>