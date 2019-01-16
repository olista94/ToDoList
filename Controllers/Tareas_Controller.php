<!---CONTROLADOR DE TAREAS
 CREADO POR mi3ac6 EL 19/12/2018-->
<?php
session_start();
include_once "../Views/MESSAGE.php";
include_once "../Views/ALERT.php";
include_once "../Functions/Authentication.php";

if (!IsAuthenticated()){ //si no está autenticado
    new MESSAGE('No puedes ver esto si no estás logueado', '../Controllers/Login_Controller.php'); //muestra el mensaje
}else{ //si lo está

//Incluimos las vistas y modelo necesarios
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
				if($mensaje == "Insercion correcta"){
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
					$datos = $tarea-> searchAdmin(); //Se busca en todas las tareas y se guardan los datos
					$archivos = $tarea -> ContarArchivos(); //Se cuentan los archivos de la tarea
					$fases = $tarea -> ContarFases(); //Se cuentan las fases de la tarea
					$contactos = $tarea -> ContarContactos(); //Se cuentan los contactos de la tarea
				
					new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php'); //Se muestran las tareas encontradas en un showall
				//En otro caso el usuario es un usuario normal
				}else{
					$tarea = getDataForm(); //Se llena el objeto tarea con los datos del formulario
					$datos = $tarea-> search1(); //Se busca en las tareas del usuario y seguardan los datos
					$archivos = $tarea -> ContarArchivos(); //se cuentan los archivos de la tarea
					$fases = $tarea -> ContarFases(); //se cuentan las fases de la tarea
					$contactos = $tarea -> ContarContactos(); // se cuentan los contactos de la tarea
					new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php'); //Se muestran las tareas encontradas en un showall
				}
			}		
		break;

		//Si se le da a borrar desde la vista del showall
		case 'Confirmar_DELETE1':		
			$prioridades = new PRIORIDADES_Model("","",""); //Se crea un modelo de prioridades
			if(count($_REQUEST) < 4 ){			
				$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','',''); //Se crea un modelo de tarea con el id que se le pasa
				$datos = $tarea->rellenadatos(); //Se rellena datos con los datos de la tarea
				
				$array = $datos -> fetch_array(); //Creamos el array con los datos
				$prioridades = new PRIORIDADES_Model($array['PRIORIDADES_nivel'],"",""); //Creamos un modelo de prioridad con el nivel de prioridad
				$p = $prioridades -> searchById(); //Buscamos la prioridad por nivel
				
				$categorias = new CATEGORIAS_Model($array['CATEGORIAS_id_CATEGORIAS'],""); //Creamos una categoria con el modelo y el id de la categoria
				$cat = $categorias -> searchById(); //Buscamos la categoria por nivel
				$datos = $tarea->rellenadatos(); //Volvemos rellenar los datos de la tarea
				
				new Tareas_DELETE($datos,$p,$cat,'../Controllers/Tareas_Controller.php'); //Creamos una vista de delete con los datos obtenidos
			}
		break;
		
		// Si queremos borrar desde la vista de borrar
		case 'Confirmar_DELETE2':		
			$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','',''); //Creamos un objeto tarea con el id de la tarea a borrar
			$mensaje = $tarea-> delete(); //Llamamos a delete y guardamos el mensaje que devuelve
			new MESSAGE($mensaje,'../Controllers/Tareas_Controller.php'); //Mostramos el mensaje	
		break;

		//Si queremos mostrar los datos de una tarea en concreto
		case 'Confirmar_SHOWCURRENT':
			//Si no se le pasan argumentos por request
			if(count($_REQUEST) < 4 ){	

				$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','',''); //Creamos un objeto tarea con el id de la tarea a ver
				$datos = $tarea->rellenadatos(); //Se rellena datos con los datos de la tarea
				
				$array = $datos -> fetch_array(); //Creamos el array con los datos
				$prioridades = new PRIORIDADES_Model($array['PRIORIDADES_nivel'],"",""); //Creamos un modelo de prioridad con el nivel de prioridad
				$p = $prioridades -> searchById(); //Buscamos la prioridad por nivel
				
				$categorias = new CATEGORIAS_Model($array['CATEGORIAS_id_CATEGORIAS'],""); //Creamos una categoria con el modelo y el id de la categoria
				$cat = $categorias -> searchById(); //Buscamos la categoria por nivel
				$datos = $tarea->rellenadatos(); //Volvemos rellenar los datos de la tarea
				
				new Tareas_SHOWCURRENT($datos,$p,$cat,'../Controllers/Tareas_Controller.php'); //Creamos una vista de delete con los datos obtenidos
			}
		break;

		//Si queremos mostrar el detalle de una tarea en concreto
		case 'Confirmar_SHOWFASES':
		//Si no se le pasan argumentos por request
			if(count($_REQUEST) < 4 ){			
				$fase = new FASES_Model('','','','','',$_REQUEST['id_tarea'],''); //Creamos un objeto fase con el id de la tarea a ver
				$datos = $fase->getFasesOfTarea(); //Se rellena datos con las fases de la tarea

				$archivos = new ARCHIVOS_Model('','','','',$_REQUEST['id_tarea']); //Creamos un objeto archivos con el id de la tarea a ver
				$archivo = $archivos -> getArchivosOfTarea(); //Se rellena archivo con los archivos de la tarea

				$contactos = new FASES_HAS_CONTACTOS_Model('',$_REQUEST['id_tarea'],''); //Creamos un objeto contactos con el id de la tarea a ver
				$contacto = $contactos -> getContactosOfTarea(); //Se rellena contacto con los contactos de la tarea
				
				$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','',''); //Creamos un objeto tarea con el id de la tarea a ver
				$t = $tarea -> TareasCompleto(); //Se rellena t con los datos de la tarea

				$respuesta = new Fases_SHOWALL($datos,$archivo,$contacto,$t,'../Controllers/Fases_Controller.php'); //Creamos una vista de showall con los datos obtenidos	
			}
		break;

		//Si queremos marcar una tarea como completada
		case 'Confirmar_COMPLETADA':	
			//Comprobamos el tipo de usuario	
			if(isset($_SESSION['tipo'])){
				//Si el usuario es de tipo admin
				if($_SESSION['tipo']=='ADMIN'){		
					$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','',''); //Creamos un objeto tarea con el id de la tarea a completar

					$alert = $tarea-> puedeCompletar(); //Comprobamos si se puede completar la tarea (y completamos si se puede) y guardamos el mensaje que devuelve
					$datos = $tarea->TareasShowAll(); //Recuperamos todas las tareas y las guardamos en datos
					$archivos = $tarea -> ContarArchivos(); //Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases(); //Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos(); //Recuperamos el numero de contactos de las tareas y los guardamos
				
					new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php'); //Creamos una vista de showall con los datos actualizados
					new ALERT($alert); //Mostramos el mensaje de retorno
				// Si es un usuario normal
				}else{
					$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');//Creamos un objeto tarea con el id de la tarea a completar

					$alert = $tarea-> puedeCompletar();//Comprobamos si se puede completar la tarea (y completamos si se puede) y guardamos el mensaje que devuelve
					$datos = $tarea->TareasShowAllNormal();//Recuperamos las tareas del usuario y las guardamos en datos
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos

					new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');//Creamos una vista de showall con los datos actualizados
					new ALERT($alert);//Mostramos el mensaje de retorno
				}
			}
		break;

		//Si queremos marcar una tarea como no completada
		case 'Confirmar_NO_COMPLETADA':
		//Comprobamos el tipo de usuario	
		if(isset($_SESSION['tipo'])){
			//Si el usuario es de tipo admin
			if($_SESSION['tipo']=='ADMIN'){
				$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');//Creamos un objeto tarea con el id de la tarea a descompletar

				$alert = $tarea-> puedeDescompletar();//Descompletamos la tarea (y completamos si se puede) y guardamos el mensaje que devuelve
				$datos = $tarea->TareasShowAll();//Recuperamos las tareas y las guardamos en datos
				$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
				$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
				$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos

				new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');//Creamos una vista de showall con los datos actualizados
				new ALERT($alert);//Mostramos el mensaje de retorno
			// Si es un usuario normal
			}else{
				$tarea = new TAREAS_Model($_REQUEST['id_tarea'],'','','','','','','');//Creamos un objeto tarea con el id de la tarea a descompletar

				$alert = $tarea-> puedeDescompletar();//Descompletamos la tarea (y completamos si se puede) y guardamos el mensaje que devuelve
				$datos = $tarea->TareasShowAllNormal();//Recuperamos las tareas del usuario y las guardamos en datos
				$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
				$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
				$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos

				new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');//Creamos una vista de showall con los datos actualizados
				new ALERT($alert);//Mostramos el mensaje de retorno
			}
		}
		break;
		
		//Si queremos ordenar por fecha
		case 'Ordenar_Fecha':
			//Comprobamos el tipo de usuario	
			if(isset($_SESSION['tipo'])){
				//Si el usuario es de tipo admin
				if($_SESSION['tipo']=='ADMIN'){
				
					$tarea = new TAREAS_Model('','','','','','','','');//Creamos un objeto tarea
					$datos = $tarea -> OrdenarFecha(); //Guardamos los datos ordenados por fecha
					
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos
					
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');//Creamos una vista de showall con los datos actualizados			
				// Si es un usuario normal
				}else{
					$tarea = new TAREAS_Model('','','','','','','','');//Creamos un objeto tarea
					$datos = $tarea -> OrdenarFechaNormal();//Guardamos los datos ordenados por fecha
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos
					
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');	//Creamos una vista de showall con los datos actualizados
				}
			}
		break;

		//Si queremos ordenar por prioridad
		case 'Ordenar_Prioridad':
			//Comprobamos el tipo de usuario	
			if(isset($_SESSION['tipo'])){
				//Si el usuario es de tipo admin
				if($_SESSION['tipo']=='ADMIN'){
				
					$tarea = new TAREAS_Model('','','','','','','','');//Creamos un objeto tarea
					$datos = $tarea -> OrdenarPrioridad(); //Guardamos los datos ordenados por prioridad
					
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos
					
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');//Creamos una vista de showall con los datos actualizados			
				// Si es un usuario normal
				}else{
					$tarea = new TAREAS_Model('','','','','','','','');//Creamos un objeto tarea
					$datos = $tarea -> OrdenarPrioridadNormal();//Guardamos los datos ordenados por prioridad
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos
					
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');	//Creamos una vista de showall con los datos actualizados
				}
			}
		break;

		//Si queremos ordenar por categoria
		case 'Ordenar_Categoria':
			//Comprobamos el tipo de usuario	
			if(isset($_SESSION['tipo'])){
				//Si el usuario es de tipo admin
				if($_SESSION['tipo']=='ADMIN'){
				
					$tarea = new TAREAS_Model('','','','','','','','');//Creamos un objeto tarea
					$datos = $tarea -> OrdenarCategoria(); //Guardamos los datos ordenados por categoria
					
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos
					
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');//Creamos una vista de showall con los datos actualizados			
				// Si es un usuario normal
				}else{
					$tarea = new TAREAS_Model('','','','','','','','');//Creamos un objeto tarea
					$datos = $tarea -> OrdenarPrioridadNormal();//Guardamos los datos ordenados por categoria
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos
					
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');	//Creamos una vista de showall con los datos actualizados
				}
			}
		break;
		
		//Si queremos mostrar las tareas completas
		case 'Mostrar_Completas':
			//Comprobamos el tipo de usuario
			if(isset($_SESSION['tipo'])){
				//Si el usuario es de tipo admin
				if($_SESSION['tipo']=='ADMIN'){
					$tarea = new TAREAS_Model('','','','','','','','');	//Creamos un objeto tarea				
					$datos = $tarea -> TareasShowAll();//Recuperamos las tareas y las guardamos en datos				
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos

					//Creamos una vista de las tareas completas con los datos
					$respuesta = new Tareas_SHOWCOMPLETE($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');
							
				}else{
					$tarea = new TAREAS_Model('','','','','','','','');	//Creamos un objeto tarea	

					$datos = $tarea -> TareasShowAllNormal();//Recuperamos las tareas y las guardamos en datos				
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos

					//Creamos una vista de las tareas del usuario completas con los datos
					$respuesta = new Tareas_SHOWCOMPLETE($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');		
				}
			}
		break;
		
		//Si queremos mostrar las tareas incompletas
		case 'Mostrar_NoCompletas':
			//Comprobamos el tipo de usuario
			if(isset($_SESSION['tipo'])){
				//Si el usuario es de tipo admin
				if($_SESSION['tipo']=='ADMIN'){
					$tarea = new TAREAS_Model('','','','','','','','');	//Creamos un objeto tarea				
					$datos = $tarea -> TareasShowAll();//Recuperamos las tareas y las guardamos en datos				
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos

					//Creamos una vista de las tareas completas con los datos
					$respuesta = new Tareas_SHOWUNCOMPLETE($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');
				//Si es usuario normal			
				}else{
					$tarea = new TAREAS_Model('','','','','','','','');	//Creamos un objeto tarea	

					$datos = $tarea -> TareasShowAllNormal();//Recuperamos las tareas del usuario y las guardamos en datos				
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos

					//Creamos una vista de las tareas del usuario completas con los datos
					$respuesta = new Tareas_SHOWUNCOMPLETE($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');		
				}
			}
		break;	

		default: /*PARA EL SHOWALL */
			//Comprobamos el tipo de usuario
			if(isset($_SESSION['tipo'])){
				//Si el usuario es de tipo admin
				if($_SESSION['tipo']=='ADMIN'){		   
					$tarea = new TAREAS_Model('','','','','','','','');//Creamos un objeto tarea
					
					$datos = $tarea -> TareasShowAll();//Recuperamos todas las tareas y las guardamos en datos						
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos
					
					//Creamos una vista de todas las tareas completas con los datos
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');	
				//Si es usuario normal
				}else{		   
					$tarea = new TAREAS_Model('','','','','','','','');//Creamos un objeto tarea
					
					$datos = $tarea -> TareasShowAllNormal();//Recuperamos las tareas del usuario y las guardamos en datos						
					$archivos = $tarea -> ContarArchivos();//Recuperamos el numero de archivos de las tareas y los guardamos
					$fases = $tarea -> ContarFases();//Recuperamos el numero de fases de las tareas y los guardamos
					$contactos = $tarea -> ContarContactos();//Recuperamos el numero de contactos de las tareas y los guardamos
					
					//Creamos una vista de todas las tareas completas con los datos
					$respuesta = new Tareas_SHOWALL($datos,$archivos,$fases,$contactos,'../Controllers/Tareas_Controller.php');	
				}	 
			}
	}
}
?>