<!---MODELO DE LOS USUARIOS QUE ADMINISTRARÁN LA LOTERIAIU,DONDE SE REALIZARÁ LA OPERACION DE INSERCIÓN EN LA BD
 CREADO POR mi3ac6 EL 23/11/2018-->
<?php



class FASES_Model {

	var $id_fase;
	var $descripcion;
	var $fecha_ini;
	var $fecha_fin;
	var $completada;
	var $TAREAS_id_TAREAS;
	
	/* var $mysqli; */

//Constructor de la clase
//

function __construct($id_fase,$descripcion,$fecha_ini,$fecha_fin,$completada,$TAREAS_id_TAREAS){
	$this->id_fase = $id_fase;
	$this->descripcion = $descripcion;
	$this->fecha_ini = $fecha_ini;
	$this->fecha_fin = $fecha_fin;
	$this->completada = $completada;
	$this->TAREAS_id_TAREAS = $TAREAS_id_TAREAS;

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
							'$this->completada',
							'$this->TAREAS_id_TAREAS'
							)
						";

				if (!$this->mysqli->query($sql)) { 
					return 'Error al insertar';
					
					echo $sql;
						
				}
				else{ 
				echo $sql;
					return 'Insertado correcto'; 
					
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
					`fecha_fin` = '$this->fecha_fin'					

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
    			WHERE `TAREAS_id_TAREAS` = '".$_REQUEST['TAREAS_id_TAREAS']."' &&
    				( 
    				
	 				(`descripcion` LIKE '%$this->descripcion%') &&
					(`fecha_inicio` LIKE '%$this->fecha_ini%') &&
					(`fecha_fin` LIKE '%$this->fecha_fin%') &&
					(`TAREAS_id_TAREAS` LIKE '%$this->TAREAS_id_TAREAS%')
					
    				)";
				echo $sql;
   
    if (!($resultado = $this->mysqli->query($sql))){
		return "Error en la consulta";
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
    $sql = "SELECT * FROM fases WHERE (`id_FASES` = '$this->id_fase')";
   
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

function BuscarIDFase(){
	$sql = "SELECT MAX(id_FASES) FROM fases";
					
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

function setCompletada()
{
	
    $sql = "SELECT * FROM fases WHERE (id_FASES = '$this->id_fase')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {	
		$date = date('Y-m-d', time());
		$sql = "UPDATE fases SET
					`completada` = '1',
					`fecha_fin` = '$date'				

				WHERE (`id_FASES` = '$this->id_fase')";

        if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la al cerrar la fase';
		}
		else{ 
			return 'La fase se ha cerrado'; 
		}
    }
    else 
    	return 'No existe';
} 

function setNoCompletada()
{
	$sql = "SELECT * FROM tareas WHERE (id_tarea = '$this->TAREAS_id_TAREAS') && (completada = '1')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 0)
    {	
	
		$sql = "SELECT * FROM fases WHERE (id_FASES = '$this->id_fase')";
		
		$result = $this->mysqli->query($sql);
		
		if ($result->num_rows == 1)
		{	
			$sql = "UPDATE fases SET
						`completada` = '0',
						`fecha_fin` = ''					

					WHERE (`id_FASES` = '$this->id_fase')";

			if (!($resultado = $this->mysqli->query($sql))){
				return 'Error al abrir la fase';
			}
			else{ 
				return 'La fase se ha vuelto a abrir'; 
			}
		}else{
			return 'No existe';
		}
	}else{
		return 'No se puede abrir una fase de una tarea cerrada';
	}
		
}

function BuscarMaxID(){
	$sql = "SELECT MAX(id_FASES)
			FROM fases
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


}//fin de clase

?> 