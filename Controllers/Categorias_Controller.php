<!---CONTROLADOR DE LAS CATEGORIAS
 Creado por: Los Cangrejas
 Fecha: 20/12/2018-->
 
<?php
//Variable de sesion
session_start();

//Incluye la funciones que se encuentran en los siguientes ficheros:

include_once "../Views/MESSAGE.php";
include_once "../Functions/Authentication.php";

if(isset($_SESSION['tipo'])){
	//Si se loguea como ADMIN
	if($_SESSION['tipo']=='ADMIN'){
		//Incluye la funciones que se encuentran en los siguientes ficheros:
		include_once "../Models/CATEGORIAS_Model.php";
		include_once "../Views/Categorias_SHOWALL.php";
		include_once "../Views/Categorias_ADD.php";
		include_once "../Views/Categorias_SEARCH.php";
		include_once "../Views/Categorias_EDIT.php";
		include_once "../Views/Categorias_SHOWCURRENT.php";
		include_once "../Views/Categorias_DELETE.php";
		include_once "../Views/MESSAGE.php";
		include_once "../Functions/Authentication.php";

		/* RECOGE LOS DATOS DEL FORMULARIO */
		function getDataForm(){
			if(isset($_REQUEST['id_CATEGORIAS'])){
				$id_CATEGORIAS = $_REQUEST['id_CATEGORIAS'];//Identificador de la categoria
				
			}
			else{
				$id_CATEGORIAS = "";
			}
			$nombre = $_REQUEST['nombre'];//Nombre de la categoria	
			//Creamos un objeto Categoria
			$categoria = new CATEGORIAS_Model ($id_CATEGORIAS,$nombre);
			
			//Devuelve el objeto Categoria
			return $categoria;
		}
		
		//Si no existe un botón action le asigno cadena vacía para asegurarme que entre por el default del switch
		if(!isset($_REQUEST['action'])){
			$_REQUEST['action'] = '';
		}

		//Acciones a realizar dependiendo del boton pulsado
		switch ($_REQUEST['action']){
			//Pulsa añadir categoria en Categorias_SHOWALL
			case 'Confirmar_ADD1':		
			//Muestra el form de ADD categoria
				new Categorias_ADD('../Controllers/Categorias_Controller.php');
			break;
			//Confirma el ADD de categoria tras rellenar el form ADD
			case 'Confirmar_ADD2':
			//Recoge los datos
				$categoria = getDataForm();
				//LLama a la funcion sql para insertar categoria
				$mensaje = $categoria-> add();
				//Crea un nuevo objeto de tipo MESSAGE que muestra por pantalla el texto de la respuesta y hace un enlace para permitir la vuelta hacia atrás (hacia el controlador)
				new MESSAGE($mensaje,'../Controllers/Categorias_Controller.php');
			break;
			
			//Pulsa editar categoria en Categorias_SHOWALL
			case 'Confirmar_EDIT1':
			//Pasa el id de la categoria a editar
				$categoria = new CATEGORIAS_Model($_REQUEST['id_CATEGORIAS'],'');
				//Recoge los datos
				$datos = $categoria->rellenadatos();
				//Muestra el form de EDIT
				new Categorias_EDIT($datos,'../Controllers/Categorias_Controller.php');
			break;
			//Confirma el EDIT de categoria tras rellenar el form EDIT
			case 'Confirmar_EDIT2':	
			//Recoge los datos
				$categoria = getDataForm();
				//Crea un nuevo objeto de tipo MESSAGE que muestra por pantalla el texto de la respuesta y hace un enlace para permitir la vuelta hacia atrás (hacia el controlador)
				$mensaje = $categoria-> edit();
				new MESSAGE($mensaje,'../Controllers/Categorias_Controller.php');
			break;
		
			//Pulsa buscar categoria en Categorias_SHOWALL
			case 'Confirmar_SEARCH1':
			//Muestra el form de SEARCH
				new Categorias_SEARCH('../Controllers/Categorias_Controller.php');
			break;
			
			//Confirma el SEARCH categoria tras rellenar el form search
			case 'Confirmar_SEARCH2':
			//Recoge los datos
				$categoria = getDataForm();
				//Muestra las categorias tras aplicar la busqueda con una vista de Showall
				$datos = $categoria-> search();
				new Categorias_SHOWALL($datos,'../Controllers/Categorias_Controller.php');
			break;
		
			//Pulsa borrar categoria en Categorias_SHOWALL
			case 'Confirmar_DELETE1':
			//Pasa el id de la categoria a borrar
				$categoria = new CATEGORIAS_Model($_REQUEST['id_CATEGORIAS'],'');
				//Recoge los datos
				$datos = $categoria->rellenadatos();
				//Muestra la tabla con los datos de la categoria a borrar
				new Categorias_DELETE($datos,'../Controllers/Categorias_Controller.php');
			break;
			
			//Confirma el DELETE categoria
			case 'Confirmar_DELETE2':	
			//Pasa el id de la categoria a borrar			
				$categoria = new CATEGORIAS_Model($_REQUEST['id_CATEGORIAS'],'');
				//Borra dicha categoria de la bd
				$mensaje = $categoria-> delete();
			//Crea un nuevo objeto de tipo MESSAGE que muestra por pantalla el texto de la respuesta y hace un enlace para permitir la vuelta hacia atrás (hacia el controlador)
				new MESSAGE($mensaje,'../Controllers/Categorias_Controller.php');			
			break;
			
			//Confirma el SHOWCURRENT de categoria
			case 'Confirmar_SHOWCURRENT':
				if(count($_REQUEST) < 4 ){
					//Pasa el id de la categoria a mostrar
					$categoria = new CATEGORIAS_Model($_REQUEST['id_CATEGORIAS'],'');
					//Recoge los datos
					$datos = $categoria->rellenadatos();
					//Muesta la tabla con los datos de la categoria seleccionada
					new Categorias_SHOWCURRENT($datos,'../Controllers/Categorias_Controller.php');
				}
			break;

			//Por defecto al seleccionar la seccion de Categorias en el menu se mostrara el SHOWALL
			default: /*PARA EL SHOWALL */
			//Busca todas las categorias
				$categoria = new CATEGORIAS_Model('','');
				$datos = $categoria -> search();
				//Las muestra en una tabla
				$respuesta = new Categorias_SHOWALL($datos,'../Controllers/Categorias_Controller.php');

		}
	}else{
		//muestra el mensaje si no es admin
		new MESSAGE('No puedes ver esto si no eres administrador', '../Controllers/Index_Controller.php'); 
	}
}

?>
