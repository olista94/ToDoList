<!---MODELO DE LOS USUARIOS QUE ADMINISTRARÁN LA LOTERIAIU,DONDE SE REALIZARÁ LA OPERACION DE INSERCIÓN EN LA BD
 CREADO POR mi3ac6 EL 23/11/2018-->
<?php



class ARCHIVOS_Model {

	var $id_ARCHIVOS;
	var $nombre;
    var $url;
	var $FASES_id_FASES;
	var $FASES_TAREAS_id_TAREAS;
	
	/* var $mysqli; */

//Constructor de la clase
//

function __construct($id_ARCHIVOS, $nombre, $url, $FASES_id_FASES,$FASES_TAREAS_id_TAREAS){

	$this->id_ARCHIVOS = $id_ARCHIVOS;
    $this->nombre = $nombre;
    $this->url = $url;
	$this->FASES_id_FASES = $FASES_id_FASES;
	$this->FASES_TAREAS_id_TAREAS = $FASES_TAREAS_id_TAREAS;
    
	include_once '../Models/Access_DB.php';
	$this->mysqli = ConnectDB();
}


function add(){
				
				$sql = "INSERT INTO archivos
						VALUES (
							'$this->id_ARCHIVOS',
							'$this->nombre',
							'$this->url',
							'$this->FASES_id_FASES',
							'$this->FASES_TAREAS_id_TAREAS'
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

function getArchivosOfTarea() {	
    $sql = "SELECT * FROM archivos WHERE (`FASES_TAREAS_id_TAREAS` = '$this->FASES_TAREAS_id_TAREAS')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return $GLOBALS['strings']['No existe']; 
	}
    else{ 
		$result = $resultado;
		return $result;
	
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
    $sql = "SELECT * FROM archivos WHERE (`FASES_id_FASES` = '$this->id_fase')";
   
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