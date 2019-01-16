<!---CONTROLADOR DE LOS USUARIOS
 Creado por: Los Cangrejas
 Fecha: 22/12/2018-->
<?php

//Creamos la sesion
session_start();

//Incluimos los mensajes y la funcion de autenticacion
include_once "../Views/MESSAGE.php";
include_once "../Functions/Authentication.php";

//Comprobamos si esta el tipo de usuario en sesion
if(isset($_SESSION['tipo'])){
	//Si el usuario es tipo admin
	if($_SESSION['tipo']=='ADMIN'){
		
		if (!IsAuthenticated()){ //si no está autenticado

			new MESSAGE('No puedes ver esto si no estás logueado', '../Controllers/Login_Controller.php'); //muestra el mensaje

		}else{ //si lo está

			//Incluimos las vistas y modelo necesarios
			include_once "../Models/Usuarios_Model.php";
			include_once "../Views/Usuarios_SHOWALL_View.php";
			include_once "../Views/Usuarios_ADD_View.php";
			include_once "../Views/Usuarios_SEARCH_View.php";
			include_once "../Views/Usuarios_EDIT_View.php";
			include_once "../Views/Usuarios_SHOWCURRENT_View.php";
			include_once "../Views/Usuarios_DELETE_View.php";

			/* RECOGE LOS DATOS DEL FORMULARIO */
			function getDataForm(){
				$login = $_REQUEST['login']; //login
				$password = $_REQUEST['password'];//pas
				$dni = $_REQUEST['dni'];//dni
				$nombre = $_REQUEST['nombre'];//nombre
				$apellidos = $_REQUEST['apellidos'];//apellidos
				$telefono = $_REQUEST['telefono'];//telefono
				$email = $_REQUEST['email'];//email
				$fechanacimiento = $_REQUEST['fecha'];//fecha de nacimiento
				$tipo = $_REQUEST['tipo']; //tipo de usuario
				
				$usuario = new Usuarios_Model ($login,$password,$dni,$nombre,$apellidos,$telefono,$email,$fechanacimiento,$tipo); //creamos el objeto usuario
				
				return $usuario; //devolvemos el objeto usuario
			}

			//Si mandamos alguna accion desde la vista
			if(!isset($_REQUEST['action'])){
				$_REQUEST['action'] = ''; //Sino la dejamos vacia
			}

			//Segun la accion definida
			switch ($_REQUEST['action']){
				
				//Si queremos añadir un usuario
				case 'Confirmar_ADD':
					//Si no le pasamos datos desde formulario
					if(count($_REQUEST) < 4 ){						
						new Usuarios_ADD('../Controllers/Usuarios_Controller.php');
					//Si le pasamos datos desde formulario
					}else{
						$usuario = getDataForm(); //Guardamos los datos del formulario
						$mensaje = $usuario-> Register(); //Miramos si se puede resgistrar el usuario y guardamos el mensaje de vuelta

						//Si podemos
						if($mensaje == true){
							$mensaje = $usuario -> registrar(); //Guardamos el usuario y guardamos el mensaje
							new MESSAGE($mensaje,'../Controllers/Usuarios_Controller.php'); //Mostramos el mensaje
						//Si no podemos
						}else{
							new MESSAGE($mensaje,'../Controllers/Usuarios_Controller.php'); //Mostramos el mensaje
						}					
					}					
				break;

				//Si queremos editar un usuario
				case 'Confirmar_EDIT':
					//Si no le pasamos datos desde formulario
					if(count($_REQUEST) < 4 ){
						$usuario = new Usuarios_Model($_REQUEST['login'],'','','','','','','',''); //Creamos el objeto usuario
						$datos = $usuario->rellenadatos(); //Rellenamos con los datos del usuario
						new Usuarios_EDIT($datos,'../Controllers/Usuarios_Controller.php'); //Creamos la vista para editar un usuario
					//Si le pasamos datos desde formulario
					}else{						
						$usuario = getDataForm();//Obtenemos los datos del formulario y los guardamos
						$mensaje = $usuario-> edit(); //Editamos el usuario y guardamos el mensaje
						new MESSAGE($mensaje,'../Controllers/Usuarios_Controller.php'); //Mostramos el mensaje
					}
				break;

				//Si queremos buscar un usuario
				case 'Confirmar_SEARCH':
					//Si no le pasamos datos desde formulario
					if(count($_REQUEST) < 4 ){						
						new Usuarios_SEARCH('../Controllers/Usuarios_Controller.php'); //Creamos la vista para buscar usuarios
					//Si le pasamos datos desde formulario
					}else{
						$usuario = getDataForm();//Obtenemos los datos del formulario y los guardamos
						$datos = $usuario-> search();//Buscamos los usuarios
						new Usuarios_SHOWALL($datos,'../Controllers/Usuarios_Controller.php'); //Creamos la vista para los resultados						
					}
				break;

				//Si queremos borrar un usuario
				case 'Confirmar_DELETE1':					
					$usuario = new Usuarios_Model($_REQUEST['login'],'','','','','','','','');//Creamos el objeto usuario
					$datos = $usuario->rellenadatos();//Rellenamos con los datos del usuario
					new Usuarios_DELETE($datos,'../Controllers/Usuarios_Controller.php'); //Creamos la vista para borrar un usuario
				break;
				
				//Si queremos confirmar el borrado de un usuario
				case 'Confirmar_DELETE2':						
					$usuario = new Usuarios_Model($_REQUEST['login'],'','','','','','','','');//Creamos el objeto usuario
					$mensaje = $usuario-> delete(); //Borramos el usuario y guardamos el mensaje
					new MESSAGE($mensaje,'../Controllers/Usuarios_Controller.php');	//Mostramos el mensaje					
				break;

				//Si queremos mostrar los detalles de un usuario
				case 'Confirmar_SHOWCURRENT':
					//Si no le pasamos datos desde formulario
					if(count($_REQUEST) < 4 ){
						$usuario = new Usuarios_Model($_REQUEST['login'],'','','','','','','','');//Creamos el objeto usuario
						$datos = $usuario->rellenadatos();//Rellenamos con los datos del usuario
						new Usuarios_SHOWCURRENT($datos,'../Controllers/Usuarios_Controller.php'); //Creamos la vista
					}
				break;

				default: /*PARA EL SHOWALL */
					$usuario = new Usuarios_Model('','','','','','','','','');//Creamos el objeto usuario
					$datos = $usuario -> search();//Buscamos todos los usuarios
					$respuesta = new Usuarios_SHOWALL($datos,'../Controllers/Usuarios_Controller.php'); //Mostramos los usuarios en el showall
			}
		}
	}else{
		new MESSAGE('No puedes ver esto si no eres administrador', '../Controllers/Index_Controller.php'); //muestra el mensaje
	}
}

?>