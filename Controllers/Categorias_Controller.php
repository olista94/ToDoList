<!---CONTROLADOR DE LA Categorias
 CREADO POR mi3ac6 EL 19/11/2018-->

 <?php
session_start();

if(isset($_SESSION['tipo'])){
	if($_SESSION['tipo']=='ADMIN'){
		
include_once "../Models/CATEGORIAS_Model.php";
include_once "../Views/Categorias_SHOWALL.php";
include_once "../Views/Categorias_ADD.php";
include_once "../Views/Categorias_SEARCH.php";
include_once "../Views/Categorias_EDIT.php";
include_once "../Views/Categorias_SHOWCURRENT.php";
include_once "../Views/Categorias_DELETE.php";
include_once "../Views/MESSAGE.php";
include_once "../Functions/Authentication.php";

if (!isset($_SESSION['idioma'])) {
		$_SESSION['idioma'] = 'SPANISH';
		$idioma = 'SPANISH';
	}
	else{
		$idioma = $_SESSION['idioma'];
	}
	

include_once '../Locales/Strings_'.$idioma.'.php';

/* RECOGE LOS DATOS DEL FORMULARIO */
function getDataForm(){
	if(isset($_REQUEST['id_CATEGORIAS'])){
		$id_CATEGORIAS = $_REQUEST['id_CATEGORIAS'];
		
	}
	else{
		$id_CATEGORIAS = "";
	}
	$nombre = $_REQUEST['nombre'];
	
	
	
	$categoria = new CATEGORIAS_Model ($id_CATEGORIAS,$nombre);
	
	return $categoria;
}

if(!isset($_REQUEST['action'])){
	$_REQUEST['action'] = '';
}


switch ($_REQUEST['action']){
	
	case 'Confirmar_ADD1':		
		new Categorias_ADD('../Controllers/Categorias_Controller.php');
	break;
	
	case 'Confirmar_ADD2':
		$categoria = getDataForm();
		$mensaje = $categoria-> add();
		new MESSAGE($mensaje,'../Controllers/Categorias_Controller.php');
	break;



	case 'Confirmar_EDIT1':
		$categoria = new CATEGORIAS_Model($_REQUEST['id_CATEGORIAS'],'');
		$datos = $categoria->rellenadatos();
		new Categorias_EDIT($datos,'../Controllers/Categorias_Controller.php');
	break;
	
	case 'Confirmar_EDIT2':	
			$categoria = getDataForm();
			$mensaje = $categoria-> edit();
			new MESSAGE($mensaje,'../Controllers/Categorias_Controller.php');
	break;

	
	case 'Confirmar_SEARCH1':
		
			print_r($_REQUEST);
			new Categorias_SEARCH('../Controllers/Categorias_Controller.php');
	break;
	
	case 'Confirmar_SEARCH2':
			$categoria = getDataForm();
			$datos = $categoria-> search();
			new Categorias_SHOWALL($datos,'../Controllers/Categorias_Controller.php');
	break;

	
	case 'Confirmar_DELETE1':
		
			$categoria = new CATEGORIAS_Model($_REQUEST['id_CATEGORIAS'],'');
			$datos = $categoria->rellenadatos();
			new Categorias_DELETE($datos,'../Controllers/Categorias_Controller.php');
	break;
	
	case 'Confirmar_DELETE2':
		
			
			$categoria = new CATEGORIAS_Model($_REQUEST['id_CATEGORIAS'],'');
			$mensaje = $categoria-> delete();
			new MESSAGE($mensaje,'../Controllers/Categorias_Controller.php');
			
	break;

	case 'Confirmar_SHOWCURRENT':
		if(count($_REQUEST) < 4 ){
			$categoria = new CATEGORIAS_Model($_REQUEST['id_CATEGORIAS'],'');
			$datos = $categoria->rellenadatos();
			new Categorias_SHOWCURRENT($datos,'../Controllers/Categorias_Controller.php');
		}
	break;

	 default: /*PARA EL SHOWALL */
		$categoria = new CATEGORIAS_Model('','');
		$datos = $categoria -> search();
		$respuesta = new Categorias_SHOWALL($datos,'../Controllers/Categorias_Controller.php');

}
	}
}

?>
