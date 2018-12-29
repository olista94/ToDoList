<!---MODELO DE LOS USUARIOS QUE ADMINISTRARÁN LA LOTERIAIU,DONDE SE REALIZARÁ LA OPERACION DE INSERCIÓN EN LA BD
 CREADO POR mi3ac6 EL 23/11/2018-->
<?php



class FASES_Model {

	var $id_fase;
	var $descripcion;
	var $fecha_ini;
	var $fecha_fin;
	var $TAREAS_id_TAREAS;
	var $CONTACTOS_email;
	
	/* var $mysqli; */

//Constructor de la clase
//

function __construct($id_fase,$descripcion,$fecha_ini,$fecha_fin,$TAREAS_id_TAREAS,$CONTACTOS_email){
	$this->id_fase = $id_fase;
	$this->descripcion = $descripcion;
	$this->fecha_ini = $fecha_ini;
	$this->fecha_fin = $fecha_fin;
	$this->TAREAS_id_TAREAS = $TAREAS_id_TAREAS;
	$this->CONTACTOS_email = $CONTACTOS_email;

	include_once '../Models/Access_DB.php';
	$this->mysqli = ConnectDB();
}


function add(){
				
				$sql = "INSERT INTO fases
						VALUES (
							'$this->id_fase',
							'$this->descripcion',
							'$this->fecha_ini',
							'$this->fecha_fin',
							'$this->TAREAS_id_TAREAS',
							'$this->CONTACTOS_email'
							)
						";

				if (!$this->mysqli->query($sql)) { 
					/* return $GLOBALS['strings']['Error al insertar']; */
					
					echo $sql;
						
				}
				else{ 
				echo $sql;
					return $GLOBALS['strings']['Insertado correcto']; 
					
				}

} 

function edit()
{
	
    $sql = "SELECT * FROM fases WHERE (id_FASES = '$this->id_fase')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {	
		$sql = "UPDATE fases SET
					`descripcion` = '$this->descripcion',
					`fecha_inicio` = '$this->fecha_ini',
					`fecha_fin` = '$this->fecha_fin',
					`CONTACTOS_email` = '$this->CONTACTOS_email'
					

				WHERE (`id_FASES` = '$this->id_fase')";

        if (!($resultado = $this->mysqli->query($sql))){
			return $GLOBALS['strings']['Error en la modificación'];
		}
		else{ 
			return $GLOBALS['strings']['Modificado correctamente']; 
		}
    }
    else 
    	return $GLOBALS['strings']['No existe'];
} 

function search(){ 

	     $sql = "SELECT *
       			FROM fases
    			WHERE
    				( 
    				
	 				(`descripcion` LIKE '%$this->descripcion%') &&
					(`fecha_inicio` LIKE '%$this->fecha_ini%') &&
					(`fecha_fin` LIKE '%$this->fecha_fin%') &&
					(`TAREAS_id_TAREAS` LIKE '%$this->TAREAS_id_TAREAS%') &&
					(`CONTACTOS_email` LIKE '%$this->CONTACTOS_email%')
					
    				)";
				/* echo $sql; */
   
    if (!($resultado = $this->mysqli->query($sql))){
		return $GLOBALS['strings']['Error en la búsqueda'];
		/* return "Error en la consulta"; */
	}
    else{ 
		return $resultado;
	}
}

function delete()
{	
    $sql = "SELECT * FROM fases WHERE (`id_FASES` = '$this->id_fase')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {
    	
        $sql = "DELETE FROM fases WHERE (`id_FASES` = '$this->id_fase')";
        
        $this->mysqli->query($sql);
        
    	return $GLOBALS['strings']['Borrado correctamente'];
    } 
    else
        return $GLOBALS['strings']['No existe'];
}

	function rellenadatos() {	
    $sql = "SELECT * FROM fases WHERE (`id_FASES` = '$this->id_fase')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return $GLOBALS['strings']['No existe']; 
	}
    else{ 
		$result = $resultado;
		return $result;
	
	}
}

function getFasesOfTarea() {	
    $sql = "SELECT * FROM fases WHERE (`TAREAS_id_TAREAS` = '$this->TAREAS_id_TAREAS')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return $GLOBALS['strings']['No existe']; 
	}
    else{ 
		$result = $resultado;
		return $result;
	
	}
}

function FasesShowAll(){
	$sql = "SELECT * FROM fases ";
	
	if (!($resultado = $this->mysqli->query($sql))){
		return $GLOBALS['strings']['No existe']; 
	}
    else{ 
		$result = $resultado;
		return $result;
	}
}

function BuscarID(){
	$sql = "SELECT id_tarea
			FROM tareas
			WHERE `descripcion` = '$this->descripcion' &&
					`fecha_ini` = '$this->fecha_ini' &&
					`fecha_fin` = '$this->fecha_fin' &&
					`USUARIOS_login` = '$this->USUARIOS_login' &&
					`CATEGORIAS_id_CATEGORIAS` = '$this->CATEGORIAS_id_CATEGORIAS' &&
					`PRIORIDADES_nivel` = '$this->PRIORIDADES_nivel'
					";
	/* echo $sql; */
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado->fetch_array()[0];
		echo $result;
		print_r($resultado);
		return $result;
	}
}

function BuscarID2(){
	$sql = "SELECT descripcion
			FROM tareas
			WHERE id_tarea = (SELECT MAX(id_tarea)
							 FROM tareas) ";
					
	/* echo $sql; */
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado->fetch_array()[0];
		echo $result;
		print_r($resultado);
		return $result;
	}
}


}//fin de clase

?> 