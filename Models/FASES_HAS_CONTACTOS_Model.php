<!---MODELO DE LOS USUARIOS QUE ADMINISTRARÁN LA LOTERIAIU,DONDE SE REALIZARÁ LA OPERACION DE INSERCIÓN EN LA BD
 CREADO POR mi3ac6 EL 23/11/2018-->
<?php



class FASES_HAS_CONTACTOS_Model {

	var $FASES_id_FASES;
	var $FASES_TAREAS_id_TAREAS;
    var $CONTACTOS_email;
	
	
	/* var $mysqli; */

//Constructor de la clase
//

function __construct($FASES_id_FASES, $FASES_TAREAS_id_TAREAS, $CONTACTOS_email){

	$this->FASES_id_FASES = $FASES_id_FASES;
    $this->FASES_TAREAS_id_TAREAS = $FASES_TAREAS_id_TAREAS;
    $this->CONTACTOS_email = $CONTACTOS_email;

    
	include_once '../Models/Access_DB.php';
	$this->mysqli = ConnectDB();
}


function add(){
				
	$sql = "INSERT INTO fases_has_contactos
			VALUES (
				'$this->FASES_id_FASES',
				'$this->FASES_TAREAS_id_TAREAS',
				'$this->CONTACTOS_email'
				)
			";
echo $sql;
	if (!$this->mysqli->query($sql)) { 
		return 'Error al insertar';
		
		
			
	}
	else{ 
	echo $sql;
		return 'Insertado correcto'; 
		
	}

}

function getContactosOfTarea() {	
    $sql = "SELECT * FROM fases_has_contactos WHERE (`FASES_TAREAS_id_TAREAS` = '$this->FASES_TAREAS_id_TAREAS')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		return $result;
	
	}
}

function getContactosOfFase() {	
    $sql = "SELECT * FROM fases_has_contactos WHERE (`FASES_id_FASES` = '$this->FASES_id_FASES')";

	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		return $result;
	
	}
}

function getArchivosOfFase() {	
    $sql = "SELECT * FROM archivos WHERE (`FASES_id_FASES` = '$this->FASES_id_FASES')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
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
			return 'Error en la modificación';
		}
		else{ 
			return 'Modificado correctamente'; 
		}
    }
    else 
    	return 'No existe';
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
		return 'Error en la búsqueda';
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
        
    	return 'Borrado correctamente';
    } 
    else
        return 'No existe';
}

	function rellenadatos() {	
    $sql = "SELECT * FROM archivos WHERE (`FASES_id_FASES` = '$this->id_fase')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		return $result;
	
	}
}

function getFasesOfTarea() {	
    $sql = "SELECT * FROM fases WHERE (`TAREAS_id_TAREAS` = '$this->TAREAS_id_TAREAS')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		return $result;
	
	}
}

function FasesShowAll(){
	$sql = "SELECT * FROM fases ";
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
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