<!---CONTROLADOR DE LA Prioridades
 CREADO POR mi3ac6 EL 19/11/2018-->
<?php

//Creamos la sesion
session_start();

//Incluimos funciones para mensajes y autenticacion
include_once "../Views/MESSAGE.php";
include_once "../Functions/Authentication.php";

//Si el tipo de usuario esta definido
if(isset($_SESSION['tipo'])){
	//Si el tipo de usuario es admin
	if($_SESSION['tipo']=='ADMIN'){

		if (!IsAuthenticated()){ //si no está autenticado
			new MESSAGE('No puedes ver esto si no estás logueado', '../Controllers/Login_Controller.php'); //muestra el mensaje
		}else{ //si lo está
			//Incluimos todas las funciones necesarias
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
				$nivel = $_REQUEST['nivel'];//nivel
				$descripcion = $_REQUEST['descripcion'];//descripcion
				$color = $_REQUEST['color'];//color
				
				$prioridad = new Prioridades_Model($nivel,$descripcion,$color);//Creamos el objeto prioridad
				
				return $prioridad;//devolvemos el objeto prioridad
			}

			//Comprobamos si esta alguna accion
			if(!isset($_REQUEST['action'])){
				$_REQUEST['action'] = '';//Si no la ponemos como vacio
			}

			//Segun la accion que escojamos
			switch ($_REQUEST['action']){
				
				//En caso de que queramos añadir una prioridad
				case 'Confirmar_ADD':
					//Si no le pasamos datos en un formulario
					if(count($_REQUEST) < 4 ){				
						new Prioridades_ADD('../Controllers/Prioridades_Controller.php'); //Creamos el objeto prioridad
					//Si le pasamos datos en un formulario
					}else{
						$prioridad = getDataForm(); //Guardamos los datos del formulario
						$mensaje = $prioridad-> add();//Guardamos la prioridad y guardamos el mensaje de vuelta
						new MESSAGE($mensaje,'../Controllers/Prioridades_Controller.php');	//Mostramos el mensaje			
					}			
				break;
				
				//En caso de que queramos editar una prioridad
				case 'Confirmar_EDIT':
					//Si no le pasamos datos en un formulario
					if(count($_REQUEST) < 4 ){
						$prioridad = new PRIORIDADES_Model($_REQUEST['nivel'],'','');//Creamos el objeto prioridad
						$datos = $prioridad->rellenadatos(); //Rellenamos los datos de l objeto prioridad
						new Prioridades_EDIT($datos,'../Controllers/Prioridades_Controller.php');
					//Si le pasamos datos en un formulario
					}else{				
						$prioridad = getDataForm(); //Obtenemos los datos del formulario
						$mensaje = $prioridad-> edit();//Editamos la prioridad y guardamos el mensaje de vuelta
						new MESSAGE($mensaje,'../Controllers/Prioridades_Controller.php');//Mostramos el mensaje
					}
				break;

				//Si queremos buscar una prioridad
				case 'Confirmar_SEARCH':
					//Si no le pasamos argumentos por request
					if(count($_REQUEST) < 4 ){				
						new Prioridades_SEARCH('../Controllers/Prioridades_Controller.php');
					//Si le pasamos datos por request en el formulario
					}else{
						$prioridad = getDataForm(); //Recogemos los datos del formulario
						$datos = $prioridad-> search(); //Buscamos la prioridad
						new Prioridades_SHOWALL($datos,'../Controllers/Prioridades_Controller.php'); //Mostramos el resultado de la busqueda en un showall			
					}
				break;
				
				//Si queremos borrar una prioridad
				case 'Confirmar_DELETE1':			
						$prioridad = new PRIORIDADES_Model($_REQUEST['nivel'],'','');//Creamos el objeto prioridad
						$datos = $prioridad->rellenadatos();//Rellenamos los datos de l objeto prioridad
						new Prioridades_DELETE($datos,'../Controllers/Prioridades_Controller.php'); //Creamos la vista para borrar la prioridad
				break;
				
				//Si queremos confirmar el borrado de una prioridad
				case 'Confirmar_DELETE2':				
						$prioridad = new PRIORIDADES_Model($_REQUEST['nivel'],'','');//Creamos el objeto prioridad
						$mensaje = $prioridad-> delete(); //Borramos la prioridad y guardamos el mensaje de vuelta
						new MESSAGE($mensaje,'../Controllers/Prioridades_Controller.php');//Mostramos el mensaje				
				break;

				//Si queremos ver le detalle de una prioridad
				case 'Confirmar_SHOWCURRENT':
					if(count($_REQUEST) < 4 ){
						$prioridad = new PRIORIDADES_Model($_REQUEST['nivel'],'','');//Creamos el objeto prioridad
						$datos = $prioridad->rellenadatos();//Rellenamos los datos de l objeto prioridad
						new Prioridades_SHOWCURRENT($datos,'../Controllers/Prioridades_Controller.php'); //Creamos la vista para ver el detalle de la prioridad
					}
				break;

				default: /*PARA EL SHOWALL */
					$prioridad = new PRIORIDADES_Model('','','');//Creamos el objeto prioridad
					$datos = $prioridad -> search(); //Buscamos todas la prioridades y las guardamos
					$respuesta = new Prioridades_SHOWALL($datos,'../Controllers/Prioridades_Controller.php'); //Creamos la vista para ver todas la prioridades
			}
		}
	}else{
		new MESSAGE('No puedes ver esto si no eres administrador', '../Controllers/Index_Controller.php'); //muestra el mensaje
	}
}
?>