<?php
/*
 * Archivo php donde manejamos las acciones para una participacion de loteria
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

session_start(); //solicito trabajar con la session
include '../Functions/Authentication.php';
include '../Views/MESSAGE.php';

if (!IsAuthenticated()){ //si no está autenticado

    new MESSAGE('No puedes ver esto si no estás logueado', '../Controllers/Login_Controller.php'); //muestra el mensaje

}else{ //si lo está


    //require_once("../Models/PERMISO_Modelo.php");
    require_once('../Models/LOTERIA_Model.php');
    include '../Views/LOTERIA_SHOWALL.php';
    include '../Views/LOTERIA_ADD.php';
    include '../Views/LOTERIA_SEARCH.php';
    include '../Views/LOTERIA_SHOWCURRENT.php';
    include '../Views/LOTERIA_EDIT.php';
    include '../Views/LOTERIA_DELETE.php';


    function get_data_form(){ //recoge los valores del formulario

        $email= $_REQUEST['email']; //Variable para el email
        $nombre = $_REQUEST['nombre']; //Variable para el nombre
        $apellidos = $_REQUEST['apellidos']; //Variable los apellidos
        $participacion = $_REQUEST['participacion']; //Variable para la participacion
        $resguardo = ''; //Variable para el resguardo que puede ser vacia
        $ingresado = $_REQUEST['ingresado']; //Variable para el ingreso
        $premiopersonal = ''; //Variable para el premio personal que puede ser vacio
        $pagado = ''; //Variable si esta pagado o no que puede ser vacio
        $action = $_REQUEST['action']; //Variable action para saber la accion a realizar

        
        if(isset($_REQUEST['resguardo']))
		{
			$resguardo = $_REQUEST['resguardo'];
			//unset($_REQUEST['resguardo']);
        }
        if(isset($_REQUEST['premiopersonal']))
		{
			$premiopersonal = $_REQUEST['premiopersonal'];
			unset($_REQUEST['premiopersonal']);
        }
        if(isset($_REQUEST['pagado']))
		{
			$pagado = $_REQUEST['pagado'];
			unset($_REQUEST['pagado']);
		}

        //crea una participacion de loteria
        $LOTERIA = new LOTERIA_Model(
            $email,
            $nombre,
            $apellidos,
            $participacion,
            $resguardo,
            $ingresado,
            $premiopersonal,
            $pagado);

        return $LOTERIA;
    }

    if (!isset($_REQUEST['action'])){ //si no hay accion, la asigna vacía
        $_REQUEST['action'] = '';
    }
    
    Switch ($_REQUEST['action']){ //switch case que controla las acciones

        //acción añadir
        case 'ADD':

            $LOTERIA; //coge los valores del formulario
            $respuesta; //almacena el mensaje de respuesta

            if (!$_POST){ //Si es por get envia un formulario para insertar la participacion
                new LOTERIA_ADD();
            }
            else{//Sino recoge los datos introducidos en el formulario, los envia a la BD y manda mensaje

                if($_FILES['resguardo']['size'] > 0){ //comprobamos si hay fichero de resguardo
                    $directory = '../Files/';
                    
                    $path = $_FILES['resguardo']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);

                    $email = strstr($_REQUEST['email'], '@', true);
                    $nombre = explode('@',$email);
            
                    $uploaded_file = $directory . "resguardo_" . $nombre[0] . "." . $ext; //creamos la ruta para el fichero del resguardo
                    copy($_FILES['resguardo']['tmp_name'], $uploaded_file);
            
                    $resguardo = $uploaded_file;
                    unset($_FILES['resguardo']);
                }else{ //si no hay fichero lo asignamos como vacio
                    $resguardo='';
                }

                $LOTERIA = new LOTERIA_Model($_REQUEST['email'],$_REQUEST['nombre'],$_REQUEST['apellidos'],
                $_REQUEST['participacion'],$resguardo,$_REQUEST['ingresado'],'','NO');

                $respuesta = $LOTERIA->ADD();
                new MESSAGE($respuesta, '../Controllers/Loteria_Controller.php');
            }
            break;


        //acción eliminar
        case 'DELETE':

            $LOTERIA; //crea un objecto del modelo
            $respuesta; //almacena la respuesta que muestra el mensaje
            $valores; //almacena los datos tras rellenarlos
            

            if (!$_POST){ //Si entra por get envia un formulario con los datos del loteria que se quiere borrar
                $LOTERIA = new LOTERIA_Model($_REQUEST['email'], '', '', '', '', '', '', '');
                $valores = $LOTERIA->RellenaDatos();
                new LOTERIA_DELETE($valores);
            }
            else{//Si entra por post envía los datos del loteria que se quiere borrar a la BD y manda mensaje
                $LOTERIA = new LOTERIA_Model($_REQUEST['email'], '', '', '', '', '', '', '');
                $respuesta = $LOTERIA->DELETE();
                new MESSAGE($respuesta, '../Controllers/Loteria_Controller.php');
            }
            break;



        //acción editar
        case 'EDIT':

            $LOTERIA; //crea un objecto del modelo
            $respuesta; //almacena la respuesta que muestra el mensaje
            $valores; //almacena los datos tras rellenarlos

            if (!$_POST){ //Si entra por get envia un formulario con los datos del loteria que se quiere editar

                $LOTERIA = new LOTERIA_Model($_REQUEST['email'], '', '', '', '', '', '', '');
                $valores = $LOTERIA->RellenaDatos();                
                new LOTERIA_EDIT($valores);
            }
            else{ //Si entra por post recoge los datos introducidos en el formulario, los envia a la BD y manda mensaje

                if($_FILES['resguardo']['size'] > 0){
                    $directory = '../Files/';
                    
                    $path = $_FILES['resguardo']['name'];
                    $ext = pathinfo($path, PATHINFO_EXTENSION);

                    $email = strstr($_REQUEST['email'], '@', true);
                    $nombre = explode('@',$email);
            
                    $uploaded_file = $directory . "resguardo_" . $nombre[0] . "." . $ext;
                    copy($_FILES['resguardo']['tmp_name'], $uploaded_file);
            
                    $resguardo = $uploaded_file;
                    unset($_FILES['resguardo']);
                }else{
                    $resguardo = $_REQUEST['resguardoEdit'];
                }

                $LOTERIA = new LOTERIA_Model($_REQUEST['email'],$_REQUEST['nombre'],$_REQUEST['apellidos'],
                $_REQUEST['participacion'],$resguardo,$_REQUEST['ingresado'],$_REQUEST['premiopersonal'],$_REQUEST['pagado']);
                $respuesta = $LOTERIA->EDIT();
                new MESSAGE($respuesta, '../Controllers/Loteria_Controller.php');
            }
            break;



        //acción buscar
        case 'SEARCH':

            $LOTERIA; //coge los valores del formulario
            $datos; //almacena los datos que busca
            $lista; //crea un array de los datos

            if (!$_POST){ //Si entra por get envia un formulario para buscar por los diferentes campos que tiene un loteria
                new LOTERIA_SEARCH();
            }
            else{ //Si entra por post recoge los datos introducidos en el formulario, los envia a la BD y manda mensaje
                $LOTERIA = get_data_form();
                $datos = $LOTERIA->SEARCH();                
                $lista = array('email',
                'nombre',
                'apellidos',
                'participacion',
                'resguardo',
                'ingresado',
                'premiopersonal',
                'pagado');
                new LOTERIA_SHOWALL($lista, $datos, '../Controllers/Loteria_Controller.php');
            }
            break;



        //acción mostrar en detalle
        case 'SHOWCURRENT':

            $LOTERIA; //crea un objecto del modelo
            $valores; //almacena los datos tras rellenarlos

            //Envia los datos del loteria que se quiere ver en detalle
            $LOTERIA = new LOTERIA_Model($_REQUEST['email'], '', '', '', '', '', '', '');
            $valores = $LOTERIA->RellenaDatos();
            new LOTERIA_SHOWCURRENT($valores);
            break;

        default:

            $LOTERIA; //crea un objecto del modelo
            $datos; //almacena los datos
            $lista; //crea un array de los datos

                
            if (!$_POST){ //Si entra por get muestra vista SHOWALL 
                $LOTERIA = new LOTERIA_Model('','','','','','','','');
            }
            else{ //Si entra por post muestra SHOWALL con el atributo designado
                $LOTERIA = new LOTERIA_Model('', '', '', '', '', '', '', '');
            }

            //lo hace de todas formas
            $datos = $LOTERIA->AllData();
            $lista = array('email',
                'nombre',
                'apellidos',
                'participacion',
                'resguardo',
                'ingresado',
                'premiopersonal',
                'pagado');
            new LOTERIA_SHOWALL($lista, $datos, '');
    }

}
?>