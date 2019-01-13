<!---CONTROLADOR DE LA Usuarios
 CREADO POR mi3ac6 EL 19/11/2018-->
<?php
session_start();
include_once "../Views/MESSAGE.php";
include_once "../Functions/Authentication.php";

if(isset($_SESSION['tipo'])){
	if($_SESSION['tipo']=='ADMIN'){
		
		if (!IsAuthenticated()){ //si no está autenticado

			new MESSAGE('No puedes ver esto si no estás logueado', '../Controllers/Login_Controller.php'); //muestra el mensaje

		}else{ //si lo está

			include_once "../Models/USUARIOS_Model.php";
			include_once "../Views/Usuarios_SHOWALL.php";
			include_once "../Views/Usuarios_ADD.php";
			include_once "../Views/Usuarios_SEARCH.php";
			include_once "../Views/Usuarios_EDIT.php";
			include_once "../Views/Usuarios_SHOWCURRENT.php";
			include_once "../Views/Usuarios_DELETE.php";

			/* RECOGE LOS DATOS DEL FORMULARIO */
			function getDataForm(){
				$login = $_REQUEST['login'];
				$password = $_REQUEST['password'];
				$dni = $_REQUEST['dni'];
				$nombre = $_REQUEST['nombre'];
				$apellidos = $_REQUEST['apellidos'];
				$telefono = $_REQUEST['telefono'];
				$email = $_REQUEST['email'];
				$fechanacimiento = $_REQUEST['fecha'];
				$tipo = $_REQUEST['tipo'];
				
				$usuario = new Usuarios_Model ($login,$password,$dni,$nombre,$apellidos,$telefono,$email,$fechanacimiento,$tipo);
				
				return $usuario;
			}


			if(!isset($_REQUEST['action'])){
				$_REQUEST['action'] = '';
			}

			switch ($_REQUEST['action']){

				case 'Confirmar_ADD':
					if(count($_REQUEST) < 4 ){						
						new Usuarios_ADD('../Controllers/Usuarios_Controller.php');
					}else{
						$usuario = getDataForm();
						$mensaje = $usuario-> Register();

						if($mensaje == true){
							$mensaje = $usuario -> registrar();
							new MESSAGE($mensaje,'../Controllers/Usuarios_Controller.php');
						}else{
							new MESSAGE($mensaje,'../Controllers/Usuarios_Controller.php');
						}					
					}					
				break;

				case 'Confirmar_EDIT':
					if(count($_REQUEST) < 4 ){
						$usuario = new Usuarios_Model($_REQUEST['login'],'','','','','','','','');
						$datos = $usuario->rellenadatos();
						new Usuarios_EDIT($datos,'../Controllers/Usuarios_Controller.php');
					}else{						
						$usuario = getDataForm();
						$mensaje = $usuario-> edit();
						new MESSAGE($mensaje,'../Controllers/Usuarios_Controller.php');
					}
				break;
				
				case 'Confirmar_SEARCH':
					if(count($_REQUEST) < 4 ){						
						new Usuarios_SEARCH('../Controllers/Usuarios_Controller.php');
					}else{
						$usuario = getDataForm();
						$datos = $usuario-> search();
						new Usuarios_SHOWALL($datos,'../Controllers/Usuarios_Controller.php');						
					}
				break;
			
				case 'Confirmar_DELETE1':					
					$usuario = new Usuarios_Model($_REQUEST['login'],'','','','','','','','');
					$datos = $usuario->rellenadatos();
					new Usuarios_DELETE($datos,'../Controllers/Usuarios_Controller.php');
				break;
				
				case 'Confirmar_DELETE2':						
					$usuario = new Usuarios_Model($_REQUEST['login'],'','','','','','','','');
					$mensaje = $usuario-> delete();
					new MESSAGE($mensaje,'../Controllers/Usuarios_Controller.php');						
				break;

				case 'Confirmar_SHOWCURRENT':
					if(count($_REQUEST) < 4 ){
						$usuario = new Usuarios_Model($_REQUEST['login'],'','','','','','','','');
						$datos = $usuario->rellenadatos();
						new Usuarios_SHOWCURRENT($datos,'../Controllers/Usuarios_Controller.php');
					}
				break;

				default: /*PARA EL SHOWALL */
					$usuario = new Usuarios_Model('','','','','','','','','');
					$datos = $usuario -> search();
					$respuesta = new Usuarios_SHOWALL($datos,'../Controllers/Usuarios_Controller.php');
			}
		}
	}else{
		new MESSAGE('No puedes ver esto si no eres administrador', '../Controllers/Index_Controller.php'); //muestra el mensaje
	}
}

?>