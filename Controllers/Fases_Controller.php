<!---CONTROLADOR DE FASES
 CREADO POR mi3ac6 EL 19/12/2018-->
<?php

//Inicia una nueva sesión
session_start();

//Incluye la funciones que se encuentran en los siguientes ficheros:
include_once "../Views/MESSAGE.php";
include_once "../Views/ALERT.php";
include_once "../Functions/Authentication.php";

if (!IsAuthenticated()){ //si no está autenticado
    new MESSAGE('No puedes ver esto si no estás logueado', '../Controllers/Login_Controller.php'); //muestra el mensaje
}else{ //si lo está

	//Incluye la funciones que se encuentran en los siguientes ficheros:
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
	include_once "../Models/FASES_HAS_CONTACTOS_Model.php";


	/* RECOGE LOS DATOS DEL FORMULARIO */
	function getDataForm(){

		//Comprueba si está el campo
		if(isset($_REQUEST['id_fase'])){
			$id_fase = $_REQUEST['id_fase']; //Si el campo se le ha pasado se le asigna
		}else{
			$id_fase = ""; //Si no, se pone como vacío
		}

		$descripcion = $_REQUEST['descripcion']; //Si el campo se le ha pasado se le asigna

		
		//Comprueba si está el campo
		if(isset($_REQUEST['fecha_ini'])){
			$fecha_ini = $_REQUEST['fecha_ini'];//Si el campo se le ha pasado se le asigna
		}else{
			$fecha_ini = "";//Si no, se pone como vacío
		}
		
		//Comprueba si está el campo
		if(isset($_REQUEST['fecha_fin'])){
			$fecha_fin = $_REQUEST['fecha_fin'];//Si el campo se le ha pasado se le asigna
		}else{
			$fecha_fin = "";//Si no, se pone como vacío
		}

		//Comprueba si está el campo
		if(isset($_REQUEST['completada'])){
			$completada = $_REQUEST['completada'];//Si el campo se le ha pasado se le asigna
		}else{
			$completada = "";//Si no, se pone como vacío
		}
		
		//Comprueba si está el campo
		if(isset($_REQUEST['TAREAS_id_TAREAS'])){
			$TAREAS_id_TAREAS = $_REQUEST['TAREAS_id_TAREAS'];//Si el campo se le ha pasado se le asigna
		}else{
			$TAREAS_id_TAREAS = "";//Si no, se pone como vacío
		}
		//Comprueba si está el campo
 		if(isset($_REQUEST['CONTACTOS_email'])){
			$CONTACTOS_email = $_REQUEST['CONTACTOS_email'];//Si el campo se le ha pasado se le asigna
		}else{
			$_REQUEST['CONTACTOS_email'] = "";//Si no, se pone como vacío
		}
		//Comprueba si está el campo
		if(isset($_REQUEST['CONTACTOS_email1'])){
			$CONTACTOS_email1 = $_REQUEST['CONTACTOS_email1'];//Si el campo se le ha pasado se le asigna
		}else{
			$_REQUEST['CONTACTOS_email1'] = "";//Si no, se pone como vacío
		}
		
		//Comprueba si está el campo
		if(isset($_REQUEST['archivos_delete'])){
			$archivos_delete = $_REQUEST['archivos_delete'];//Si el campo se le ha pasado se le asigna
		}else{
			$_REQUEST['archivos_delete'] = "";//Si no, se pone como vacío
		}

		//Construye el FASE tarea con los parámetros
		$fase = new FASES_Model($id_fase,$descripcion,$fecha_ini,$fecha_fin,$completada,$TAREAS_id_TAREAS);
		
		//Devuelve el objeto fase
		return $fase;
	}

	//Comprueba si hay una accion seleccionada desde la vista
	if(!isset($_REQUEST['action'])){
		$_REQUEST['action'] = '';
	}

	//Accioneas a realizar según la acción que venga de la vista
	switch ($_REQUEST['action']){
		//Añadir una fase desde el showall
		case 'Confirmar_ADD':
			//En caso de que no se le esten pasando datos por request
			if(count($_REQUEST) < 4 ){
				$tarea = new TAREAS_Model($_REQUEST['TAREAS_id_TAREAS'],"","","","","","",""); //Se crea un objeto tarea

				$completada = $tarea -> getEstado(); //Se comprueba si la tarea esta completada

				//En caso de que la tarea no este completada
				if($completada == 'No'){

					$id_tarea =$tarea -> BuscarMaxID(); //Se obtiene el id de la tarea
					$descripcion = $tarea -> BuscarDescripcion(); //Se obtiene la descripcion de la tarea
					
					$contactos = new CONTACTOS_Model("","","",""); //Se crea un objeto contactos
					$cont = $contactos -> search(); //Se buscan los contactos
					
					new Fases_ADD($_REQUEST['TAREAS_id_TAREAS'],$descripcion,$cont,'../Controllers/Tareas_Controller.php');	//Se crea la vista para añadir fase
				//Si esta completa
				}else{
					$fase = new FASES_Model('','','','','',$_REQUEST['TAREAS_id_TAREAS'],'');//Se crea un objeto fase con el id de la tarea que solicitamos
					$datos = $fase->getFasesOfTarea();//Se buscan las fases de la tarea
	
					$archivos = new ARCHIVOS_Model('','','','',$_REQUEST['TAREAS_id_TAREAS']);//Se crea un objeto archivos con el id de la tarea que solicitamos
					$archivo = $archivos -> getArchivosOfTarea();//Se buscan los archivos de la tarea
	
					$contactos = new FASES_HAS_CONTACTOS_Model('',$_REQUEST['TAREAS_id_TAREAS'],'');//Se crea un objeto contactos con el id de la tarea que solicitamos
					$contacto = $contactos -> getContactosOfTarea();//Se buscan los contactos de la tarea
					
					$tarea = new TAREAS_Model($_REQUEST['TAREAS_id_TAREAS'],'','','','','','','');//Se crea un objeto tarea con el id de la tarea que solicitamos
					$t = $tarea -> TareasCompleto();// Se comprueba que la tarea esta completa
	
					new Fases_SHOWALL($datos,$archivo,$contacto,$t,'../Controllers/Fases_Controller.php'); //Se genera una vista de fases de la tarea	

					new ALERT($completada); //Se muestra el mensaje de que no se puede añadir la fase
				}
			//En caso de que se le esten pasando por request los datos de la nueva fase			
			}else{
				$fase = getDataForm(); //Se recogen los datos de la fase
				$mensaje = $fase-> add();	//Se añade la fase y se guarda el mensaje de retorno		
				$idFase = $fase -> BuscarIDFase(); //Se busca el id de la fase que hemos añadido

				//Si hay archivos que añadir
				if($_FILES["archivo"]['size'][0] > 0) {
					$output_dir = "../Files/";//Ruta del archivo a subir
					$fileCount = count($_FILES["archivo"]['name']);	 //Contamos el numero de ficheros a subir			
					//Mientras haya ficheros
					for($i=0; $i < $fileCount; $i++){
						$RandomNum = time(); //Generamos un numero random
						$ImageName = str_replace(' ','-',strtolower($_FILES['archivo']['name'][$i])); //Creamos el nombre del archivo
						$ImageType = $_FILES['archivo']['type'][$i]; //Obtenemos la extension del archivo
						$ImageExt = substr($ImageName, strrpos($ImageName, '.')); //Añadimos la extension del archivo
						$ImageExt = str_replace('.','',$ImageExt); //Añadimos la extension del archivo
						$ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName); //Generamos el nombre
						$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt; //Generamos el nombre
						$ruta= $output_dir.$NewImageName; //Definimos la ruta del archivo
						move_uploaded_file($_FILES["archivo"]["tmp_name"][$i],$output_dir."/".$NewImageName ); //Movemos el archivo a esa ruta

						$model = new ARCHIVOS_Model('',$ImageName,$ruta,$idFase,$_REQUEST['TAREAS_id_TAREAS']); //Creamos un objeto del tipo archivo
						$model -> add(); //Añadimos el archivo a la BD
					}
				}
				//Si hay contactos para añadir
				if(($_REQUEST['CONTACTOS_email'] != '') || ($_REQUEST['CONTACTOS_email'] != null)){
					$idFase = $fase -> BuscarMaxID();//Se busca el id de la fase que hemos añadido
					//Mientras haya contactos
					for ($i=0;$i<count($_REQUEST['CONTACTOS_email']);$i++){						
						$ContactosModel = new FASES_HAS_CONTACTOS_Model($idFase,$_REQUEST['TAREAS_id_TAREAS'],$_REQUEST['CONTACTOS_email'][$i]);//Creamos un objeto del tipo contacto
						$ContactosModel -> add();//Añadimos el contacto a la BD
					}					
				}				
				new MESSAGE($mensaje,'../Controllers/Tareas_Controller.php');//Mostramos el mensaje				
			}			
		break;
		
		
		case 'Confirmar_CONTINUAR':					
			$tareas = new TAREAS_Model($_REQUEST['TAREAS_id_TAREAS'],"","","","","","","");
			$t = $tareas -> search();
			
			$contactos = new CONTACTOS_Model("","","","");
			$cont = $contactos -> search();

			$descripcion = $tareas -> BuscarDescripcion();
							
			new Fases_ADD($_REQUEST['TAREAS_id_TAREAS'],$descripcion,$cont,'../Controllers/Fases_Controller.php');
			
			$fase = getDataForm(); //Se recogen los datos de la fase
			$mensaje = $fase-> add();	//Se añade la fase y se guarda el mensaje de retorno		
			$idFase = $fase -> BuscarIDFase(); //Se busca el id de la fase que hemos añadido

			//Si hay archivos que añadir
			if($_FILES["archivo"]['size'][0] > 0) {
				$output_dir = "../Files/";//Ruta del archivo a subir
				$fileCount = count($_FILES["archivo"]['name']);	 //Contamos el numero de ficheros a subir			
				//Mientras haya ficheros
				for($i=0; $i < $fileCount; $i++){
					$RandomNum = time(); //Generamos un numero random
					$ImageName = str_replace(' ','-',strtolower($_FILES['archivo']['name'][$i])); //Creamos el nombre del archivo
					$ImageType = $_FILES['archivo']['type'][$i]; //Obtenemos la extension del archivo
					$ImageExt = substr($ImageName, strrpos($ImageName, '.')); //Añadimos la extension del archivo
					$ImageExt = str_replace('.','',$ImageExt); //Añadimos la extension del archivo
					$ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName); //Generamos el nombre
					$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt; //Generamos el nombre
					$ruta= $output_dir.$NewImageName; //Definimos la ruta del archivo
					move_uploaded_file($_FILES["archivo"]["tmp_name"][$i],$output_dir."/".$NewImageName ); //Movemos el archivo a esa ruta

					$model = new ARCHIVOS_Model('',$ImageName,$ruta,$idFase,$_REQUEST['TAREAS_id_TAREAS']); //Creamos un objeto del tipo archivo
					$model -> add(); //Añadimos el archivo a la BD
				}
			}
			//Si hay contactos para añadir
			if(($_REQUEST['CONTACTOS_email'] != '') || ($_REQUEST['CONTACTOS_email'] != null)){
				$idFase = $fase -> BuscarMaxID();//Se busca el id de la fase que hemos añadido
				//Mientras haya contactos
				for ($i=0;$i<count($_REQUEST['CONTACTOS_email']);$i++){						
					$ContactosModel = new FASES_HAS_CONTACTOS_Model($idFase,$_REQUEST['TAREAS_id_TAREAS'],$_REQUEST['CONTACTOS_email'][$i]);//Creamos un objeto del tipo contacto
					$ContactosModel -> add();//Añadimos el contacto a la BD
				}					
			}			
			new ALERT($mensaje); //Mostramos el mensaje
		break;

		//Si queremos editar una fase
		case 'Confirmar_EDIT':
			// Si no se le pasan datos por request
			if(count($_REQUEST) < 4 ){				
				$contactos = new CONTACTOS_Model("","","","");//Creamos el objeto contactos
				$cont = $contactos -> search(); //Buscamos los contactos y los guardamos en cont
				
				$currentcontactos = new FASES_HAS_CONTACTOS_Model($_REQUEST['id_fase'],"",""); //Creamos el objeto Fases has contactos con el id de la fase
				$cucont = $currentcontactos -> getContactosOfFase();//Obtenemos los contactos de la fase
				
				$currentarchivos = new ARCHIVOS_Model('','','',$_REQUEST['id_fase'],'');//Creamos el objeto archivos con el id de la fase
				$cuarch = $currentarchivos -> getArchivosOfFase();	//Obtenemos los archivos de la fase
				
				$idtarea = $_REQUEST['TAREAS_id_TAREAS'];//Guardamos el id de la tarea
				
				$fase = new FASES_Model($_REQUEST['id_fase'],'','','','','');//Creamos el objeto fase
				$datos = $fase->rellenadatos();	//Obtenemos los datos de la fase
				
				new Fases_EDIT($idtarea,$datos,$cont,$cucont,$cuarch,'../Controllers/Fases_Controller.php');//Creamos la vista para editar una fase con los datos
			}else{			
			
				$idtarea = $_REQUEST['TAREAS_id_TAREAS']; //Guardamos el id de la tarea
				$idfase = $_REQUEST['id_fase'];//Guardamos el id de la fase
				
				$fase = getDataForm(); //Obtenemos los datos del formulario
				$mensaje = $fase-> edit(); //Editamos y guardamos el mensaje de vuelta
				
				//Si hay nuevos contactos que añadir
				if(isset($_REQUEST['CONTACTOS_email']) && !empty($_REQUEST['CONTACTOS_email']) ){
					$contactos1 = $_REQUEST['CONTACTOS_email'];//Los guardamos en contactos1
					
				}else{
					$contactos1 = array(); //Sino le pasamos un array vacio
				}
				//Si hay nuevos contactos que quitar
				if(isset($_REQUEST['CONTACTOS_email1']) && !empty($_REQUEST['CONTACTOS_email1'])){
					$contactos2 = $_REQUEST['CONTACTOS_email1'];//Los guardamos en contactos2
					
				}else{
					$contactos2 = array();//Sino le pasamos un array vacio
				}
				
				//Mientas hay contactos que añadir
				for ($i=0;$i<count($contactos1);$i++){//Añade					
					$ContactosModel = new FASES_HAS_CONTACTOS_Model($idfase,$idtarea,$contactos1[$i]); //Creamos el objeto
					$ContactosModel -> add(); //Añadimos
				}
				//Mientas haya contactos que borrar
				for ($i=0;$i<count($contactos2);$i++){//Borra						
					$ContactosModel = new FASES_HAS_CONTACTOS_Model($idfase,$idtarea,$contactos2[$i]); //Creamos el obnjeto
					$ContactosModel -> delete(); //Borramos
				}

				//Si hay archivos que añadir
				if($_FILES["archivo"]['size'][0] > 0) {
					$output_dir = "../Files/";//Path for file upload
					$fileCount = count($_FILES["archivo"]['name']); //Numero de archivos
					//Mientras haya archivos
					for($i=0; $i < $fileCount; $i++){
						$RandomNum = time(); //Generamos un numero random
						$ImageName = str_replace(' ','-',strtolower($_FILES['archivo']['name'][$i])); //Creamos el nombre del archivo
						$ImageType = $_FILES['archivo']['type'][$i]; //Obtenemos la extension del archivo
						$ImageExt = substr($ImageName, strrpos($ImageName, '.')); //Añadimos la extension del archivo
						$ImageExt = str_replace('.','',$ImageExt); //Añadimos la extension del archivo
						$ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName); //Generamos el nombre
						$NewImageName = $ImageName.'-'.$RandomNum.'.'.$ImageExt; //Generamos el nombre
						$ruta= $output_dir.$NewImageName; //Definimos la ruta del archivo
						move_uploaded_file($_FILES["archivo"]["tmp_name"][$i],$output_dir."/".$NewImageName ); //Movemos el archivo a esa ruta
	
						$model = new ARCHIVOS_Model('',$ImageName,$ruta,$idfase,$idtarea); //Creamos el objeto archivos
						$model -> add(); //Añadimos el archivo ala bd
					}
				}

				//Si hay que borrar ficheros
				if(isset($_REQUEST['archivos_delete']) && !empty($_REQUEST['archivos_delete'])){
					$ar = $_REQUEST['archivos_delete']; //Se guardan los ficheros a borrar
					
				}else{
					$ar = array();//Sino se le pasa un array vacio
				}
				
				//Mientras haya ficheros
				for ($i=0;$i<count($ar);$i++){//Borra					
					$ArchivosModel = new ARCHIVOS_Model('','',$ar[$i],$idfase,$idtarea); //Creamos objeto archivos
					$ArchivosModel -> delete(); //borramos
				}

				//Para borrar fisicamente
				if(count($_REQUEST['archivos_delete'])>0){
					for ($i=0;$i<count($_REQUEST['archivos_delete']);$i++){//Borra						
						$ArchivosModel = new ARCHIVOS_Model('','',$_REQUEST['archivos_delete'][$i],$idfase,$idtarea);//Creamos objeto archivos
						$ArchivosModel -> delete();//borramos
						$path = $_REQUEST['archivos_delete'][$i];//Obtenemos la ruta a borrar
						//Si existe el directorio
						if (file_exists($path)) {
							unlink($path); //Borramos fisicamente
						} else {
							return "El archivo ya ha sido borrado"; //Devolvemos mensaje
						}					
					}
				}

				new MESSAGE($mensaje,'../Controllers/Tareas_Controller.php'); //Mostramos mensaje tras borrado
			}
		break;
		
		//Si queremos marcar una fase como completada
		case 'Confirmar_COMPLETADA':	
			$fase = new FASES_Model($_REQUEST['id_fase'],'','','','',$_REQUEST['TAREAS_id_TAREAS']); //Creamos el objeto fase con el id de la fase a completar

			$mensaje = $fase-> setCompletada(); //Marcamos la fase como completada
			$datos = $fase->getFasesOfTarea(); //Obtenemos las fases de la tarea

			$archivos = new ARCHIVOS_Model('','','','',$_REQUEST['TAREAS_id_TAREAS']); //Creamos el objeto archivo
			$archivo = $archivos -> getArchivosOfTarea(); //Obtenemos los archivos de la tarea

			$contactos = new FASES_HAS_CONTACTOS_Model('',$_REQUEST['TAREAS_id_TAREAS'],''); //Creamos el objeto contactos has fases
			$contacto = $contactos -> getContactosOfTarea(); //Obtenemos los contactos de la tarea

			$tarea = new TAREAS_Model($_REQUEST['TAREAS_id_TAREAS'],'','','','','','',''); //Creamos el objeto tarea
			$t = $tarea -> TareasCompleto(); //Comprobamos que la tarea esta completada (no hace falta)

			new Fases_SHOWALL($datos,$archivo,$contacto,$t,'../Controllers/Fases_Controller.php'); //Mostramos las fases de la tarea
			new ALERT($mensaje); //Mostramos el mensaje de retorno
		break;

		//Si queremos marcar una fase como completada
		case 'Confirmar_NO_COMPLETADA':
			$fase = new FASES_Model($_REQUEST['id_fase'],'','','','',$_REQUEST['TAREAS_id_TAREAS']); //Creamos el objeto fase con el id de la fase a completar

			$mensaje = $fase-> setNoCompletada(); //Marcamos la fase como no completada
			$datos = $fase->getFasesOfTarea(); //Obtenemos las fases de la tarea

			$archivos = new ARCHIVOS_Model('','','','',$_REQUEST['TAREAS_id_TAREAS']); //Creamos el objeto archivo
			$archivo = $archivos -> getArchivosOfTarea(); //Obtenemos los archivos de la tarea

			$contactos = new FASES_HAS_CONTACTOS_Model('',$_REQUEST['TAREAS_id_TAREAS'],''); //Creamos el objeto contactos has fases
			$contacto = $contactos -> getContactosOfTarea(); //Obtenemos los contactos de la tarea

			$tarea = new TAREAS_Model($_REQUEST['TAREAS_id_TAREAS'],'','','','','','',''); //Creamos el objeto tarea
			$t = $tarea -> TareasCompleto(); //Comprobamos que la tarea esta completada

			new Fases_SHOWALL($datos,$archivo,$contacto,$t,'../Controllers/Fases_Controller.php'); //Mostramos las fases de la tarea
			new ALERT($mensaje); //Mostramos el mensaje de retorno
		break;
		
		//Si queremos buscar una fase
		case 'Confirmar_SEARCH':
			//Si no le pasamos datos por request
			if(count($_REQUEST) < 4 ){			
				new Fases_SEARCH('../Controllers/Fases_Controller.php'); //Creamos la vista de fases search
			//Si le pasamos datos por request
			}else{
				$fase = getDataForm(); //Obtenemos los datos del formulario
				$datos = $fase-> search(); //Buscamos la fase
				new Fases_SHOWSEARCH($datos,'../Controllers/Fases_Controller.php');	 //Creamos la vista de los resultados			
			}
		break;
		
		//Si queremos borrar una fase seleccionandola desde el showall
		case 'Confirmar_DELETE1':		
			$prioridades = new PRIORIDADES_Model("","",""); //Construimos el objeto prioridades
			$p = $prioridades -> search(); //Guardamos las prioridades
			
			$categorias = new CATEGORIAS_Model("",""); //Construimos el objeto categorias
			$cat = $categorias -> search(); //Guardamos las categorias
			
			$fase = new FASES_Model($_REQUEST['id_fase'],'','','','',''); //Construimos el objeto fase
			$datos = $fase->rellenadatos(); //Guardamos los datos de la fase
			new Fases_DELETE($datos,$p,$cat,'../Controllers/Fases_Controller.php'); //Creamos la vista para borrar la fase
		break;
		
		//Si queremos confirmar el borrado de una fase desde la vista de borrado
		case 'Confirmar_DELETE2':			
			$fase = new FASES_Model($_REQUEST['id_fase'],'','','','','',''); //Creamos el objeto fase con el id de la fase a borrar
			$mensaje = $fase-> delete(); //Confirmamos el borrado de la fase y guardamos el mensaje de vuelta
			new MESSAGE($mensaje,'../Controllers/Tareas_Controller.php');//Mostramos el mensaje del borrado				
		break;

		//Si queremos ver el detalle de una fase
		case 'Confirmar_SHOWCURRENT':
			//Si no se le pasan argumentos por request
			if(count($_REQUEST) < 4 ){
				$archivos = new ARCHIVOS_Model('','','',$_REQUEST['id_fase'],''); //Creamos el objeto archivos con el id de la fase
				$archivo = $archivos -> getArchivosOfFase(); //Obtenemos los archivos de la fase
				
				$fase = new FASES_Model($_REQUEST['id_fase'],'','','','','');//Creamos el objeto fases con el id de la fase
				$datos = $fase->rellenadatos(); //Obtenemos los datos de la fase
				
				
				$contactos = new FASES_HAS_CONTACTOS_Model($_REQUEST['id_fase'],$_REQUEST['TAREAS_id_TAREAS'],''); //Creamos el objeto para los contactos
				$contacto = $contactos -> search(); //Buscamos los contactos de la fase
				
				new Fases_SHOWCURRENT($datos,$archivo,$contacto,'../Controllers/Fases_Controller.php'); //Mostramos los datos de la fase en una vista showcurrent
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