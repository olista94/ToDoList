<!---CONTROLADOR DE LA contactos
 CREADO POR mi3ac6 EL 19/11/2018-->

<?php

session_start();
include_once "../Views/MESSAGE.php";
include_once "../Functions/Authentication.php";

if(!IsAuthenticated()){
	new MESSAGE('No puedes ver nada sin loguearte','../index.php');
}else{

	include_once "../Models/Contactos_Model.php";
	include_once "../Views/Contactos_SHOWALL.php";
	include_once "../Views/Contactos_ADD.php";
	include_once "../Views/Contactos_SEARCH.php";
	include_once "../Views/Contactos_EDIT.php";
	include_once "../Views/Contactos_SHOWCURRENT.php";
	include_once "../Views/Contactos_DELETE.php";

	if (!isset($_SESSION['idioma'])) {
		$_SESSION['idioma'] = 'SPANISH';
		$idioma = 'SPANISH';
	}else{
		$idioma = $_SESSION['idioma'];
	}
	
	include_once '../Locales/Strings_'.$idioma.'.php';

	/* RECOGE LOS DATOS DEL FORMULARIO */
	function getDataForm(){
		
		$email = $_REQUEST['email'];
		$nombre = $_REQUEST['nombre'];
		$descripcion = $_REQUEST['descripcion'];
		$telefono = $_REQUEST['telefono'];	
		
		$contacto = new CONTACTOS_Model ($email,$nombre,$descripcion,$telefono);
		
		return $contacto;
	}

	if(!isset($_REQUEST['action'])){
		$_REQUEST['action'] = '';
	}

	switch ($_REQUEST['action']){
		case 'Confirmar_ADD':
			if(count($_REQUEST) < 4 ){					
				new Contactos_ADD('../Controllers/Contactos_Controller.php');
			}else{
				$contacto = getDataForm();
				$mensaje = $contacto-> add();
				new MESSAGE($mensaje,'../Controllers/Contactos_Controller.php');
			}
			
		break;

		case 'Confirmar_EDIT':
			if(count($_REQUEST) < 4 ){
				$contacto = new CONTACTOS_Model($_REQUEST['email'],'','','');
				$datos = $contacto->rellenadatos();
				new Contactos_EDIT($datos,'../Controllers/Contactos_Controller.php');
			}else{					
				$contacto = getDataForm();
				$mensaje = $contacto-> edit();
				new MESSAGE($mensaje,'../Controllers/Contactos_Controller.php');
			}
		break;

		
		case 'Confirmar_SEARCH':
			if(count($_REQUEST) < 4 ){
				
				new Contactos_SEARCH('../Controllers/Contactos_Controller.php');
			}else{
				$contacto = getDataForm();
				$datos = $contacto-> search();
				new Contactos_SHOWALL($datos,'../Controllers/Contactos_Controller.php');					
			}
		break;

		
		case 'Confirmar_DELETE1':				
				$contacto = new CONTACTOS_Model($_REQUEST['email'],'','','');
				$datos = $contacto->rellenadatos();
				new Contactos_DELETE($datos,'../Controllers/Contactos_Controller.php');
		break;
		
		case 'Confirmar_DELETE2':					
				$contacto = new CONTACTOS_Model($_REQUEST['email'],'','','');
				$mensaje = $contacto-> delete();
				new MESSAGE($mensaje,'../Controllers/Contacto_Controller.php');					
		break;

		case 'Confirmar_SHOWCURRENT':
			if(count($_REQUEST) < 4 ){
				$contacto = new CONTACTOS_Model($_REQUEST['email'],'','','','','','','');
				$datos = $contacto->rellenadatos();
				new Contactos_SHOWCURRENT($datos,'../Controllers/Contactos_Controller.php');
			}
		break;

		default: /*PARA EL SHOWALL */
			$contacto = new CONTACTOS_Model('','','','','','','','');
			$datos = $contacto -> search();
			$respuesta = new Contactos_SHOWALL($datos,'../Controllers/Contactos_Controller.php');

	}
}
?>