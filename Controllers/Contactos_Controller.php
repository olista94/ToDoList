<!---CONTROLADOR DE LOS CONTACTOS
 Creado por: Los Cangrejas
 Fecha: 20/12/2018-->

<?php

//Variable de sesion
session_start();

//Incluye la funciones que se encuentran en los siguientes ficheros:
include_once "../Views/MESSAGE.php";
include_once "../Functions/Authentication.php";

if(!IsAuthenticated()){
	//Si no esta autenticado en la aplicacion se muestra un mensaje de que no puede verlo
	new MESSAGE('No puedes ver nada sin loguearte','../index.php');
}else{
	//Incluye la funciones que se encuentran en los siguientes ficheros:
	include_once "../Models/CONTACTOS_Model.php";
	include_once "../Views/Contactos_SHOWALL.php";
	include_once "../Views/Contactos_ADD.php";
	include_once "../Views/Contactos_SEARCH.php";
	include_once "../Views/Contactos_EDIT.php";
	include_once "../Views/Contactos_SHOWCURRENT.php";
	include_once "../Views/Contactos_DELETE.php";

	/* RECOGE LOS DATOS DEL FORMULARIO */
	function getDataForm(){
		
		$email = $_REQUEST['email'];//Recoge el campo email
		$nombre = $_REQUEST['nombre'];//Recoge el campo nombre
		$descripcion = $_REQUEST['descripcion'];//Recoge el campo descripcion
		$telefono = $_REQUEST['telefono'];//Recoge el campo telefono
		
		//Construye el objeto contacto con los parámetros
		$contacto = new CONTACTOS_Model ($email,$nombre,$descripcion,$telefono);
		
		//Devuelve el objeto contacto
		return $contacto;
	}

	//Comprueba si hay una accion seleccionada desde la vista
	if(!isset($_REQUEST['action'])){
		$_REQUEST['action'] = '';
	}

	//Accioneas a realizar según la acción que venga de la vista
	switch ($_REQUEST['action']){
		//Añadir un contacto desde el showall
		case 'Confirmar_ADD':
			//Si no se le están pasando datos entonces crea una vista para añadir
			if(count($_REQUEST) < 4 ){					
				new Contactos_ADD('../Controllers/Contactos_Controller.php'); //Crea la vista de añadir contacto
			//Si se le pasan datos entonces los recoge
			}else{				
				$contacto = getDataForm(); //Asigna los datos recogidos al objeto contacto
				$mensaje = $contacto-> add(); //Llama al modelo para añadirlo y le pasa la respuesta a MESSAGE
				new MESSAGE($mensaje,'../Controllers/Contactos_Controller.php'); //Devuelve el mensaje de la inserción
			}
			
		break;
		
		//Accion Editar un contacto
		case 'Confirmar_EDIT':
			//Si no se le están pasando datos entonces crea una vista para editar
			if(count($_REQUEST) < 4 ){
				$contacto = new CONTACTOS_Model($_REQUEST['email'],'','',''); //Crea la vista de editar contacto
				$datos = $contacto->rellenadatos(); //Rellena la variable datos con los datos actuales del contacto
				new Contactos_EDIT($datos,'../Controllers/Contactos_Controller.php'); //
			//Si se le pasan datos entonces los recoge
			}else{					
				$contacto = getDataForm(); //Asigna los datos recogidos al objeto contacto
				$mensaje = $contacto-> edit(); //Llama al modelo para editar y le pasa la respuesta a MESSAGE
				new MESSAGE($mensaje,'../Controllers/Contactos_Controller.php'); //Devuelve el mensaje de la inserción
			}
		break;

		//Accion buscar un contacto
		case 'Confirmar_SEARCH':
			//Si no se le estan pasando datos entonces crea una vista para buscar
			if(count($_REQUEST) < 4 ){				
				new Contactos_SEARCH('../Controllers/Contactos_Controller.php');
			//Si se le pasan datos entonces los recoge
			}else{
				$contacto = getDataForm(); //Asigna los datos recogidos al objeto contacto
				$datos = $contacto-> search(); //Llama al modelo para BUSCAR
				new Contactos_SHOWALL($datos,'../Controllers/Contactos_Controller.php'); //Devuelve los resultados en un showall				
			}
		break;

		//Accion ver un contacto para borrarlo
		case 'Confirmar_DELETE1':				
				$contacto = new CONTACTOS_Model($_REQUEST['email'],'','',''); //Se construye el objeto contacto con el email
				$datos = $contacto->rellenadatos(); //se le pasan los datos obtenidos del modelo
				new Contactos_DELETE($datos,'../Controllers/Contactos_Controller.php'); //se crea la vista con estos datos
		break;
		
		//Accion borrar un contacto
		case 'Confirmar_DELETE2':					
				$contacto = new CONTACTOS_Model($_REQUEST['email'],'','',''); //Se construye el objeto contacto con el email
				$mensaje = $contacto-> delete(); //se llama al modelo para borrarlo y se devuelve el mensaje
				new MESSAGE($mensaje,'../Controllers/Contactos_Controller.php'); //se muestra el mensaje de borrado
		break;

		//Mostrar los datos de un contacto concreto
		case 'Confirmar_SHOWCURRENT':
			// Si no se le estan pasando datos entonces se crea la vista
			if(count($_REQUEST) < 4 ){
				$contacto = new CONTACTOS_Model($_REQUEST['email'],'','','','','','',''); //Se construye el objeto contacto con el email
				$datos = $contacto->rellenadatos(); //se le pasan los datos obtenidos del modelo
				new Contactos_SHOWCURRENT($datos,'../Controllers/Contactos_Controller.php'); //Se muestran los datos en una vista SHOWCURRENT
			}
		break;

		//Accion por defecto cuando no hay ninguna accion
		default: /*PARA EL SHOWALL */
			$contacto = new CONTACTOS_Model('','','','','','','',''); //Se construye el objeto contacto
			$datos = $contacto -> search(); //Se buscan todos los contactos y se pasan a datos
			$respuesta = new Contactos_SHOWALL($datos,'../Controllers/Contactos_Controller.php'); //Se crea el SHOWALL para mostrar todos los contactos

	}
}
?>