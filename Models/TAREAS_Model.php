<!---MODELO DE LOS USUARIOS QUE ADMINISTRARÁN LA LOTERIAIU,DONDE SE REALIZARÁ LA OPERACION DE INSERCIÓN EN LA BD
 CREADO POR mi3ac6 EL 23/11/2018-->
<?php

class TAREAS_Model {

	var $id_tarea;
	var $descripcion;
	var $fecha_ini;
	var $fecha_fin;
	var $USUARIOS_login;
	var $CATEGORIAS_id_CATEGORIAS;
	var $PRIORIDADES_nivel;
	/* var $mysqli; */

//Constructor de la clase
//

function __construct($id_tarea,$descripcion,$fecha_ini,$fecha_fin,$USUARIOS_login,$CATEGORIAS_id_CATEGORIAS,$PRIORIDADES_nivel){
	$this->id_tarea = $id_tarea;
	$this->descripcion = $descripcion;
	$this->fecha_ini = $fecha_ini;
	$this->fecha_fin = $fecha_fin;
	$this->USUARIOS_login = $USUARIOS_login;
	$this->CATEGORIAS_id_CATEGORIAS = $CATEGORIAS_id_CATEGORIAS;
	$this->PRIORIDADES_nivel = $PRIORIDADES_nivel;

	include_once '../Models/Access_DB.php';
	$this->mysqli = ConnectDB();
}


function add(){
				
				$sql = "INSERT INTO tareas
						VALUES (
							'$this->id_tarea',
							'$this->descripcion',
							'$this->fecha_ini',
							'$this->fecha_fin',
							'$this->USUARIOS_login',
							'$this->CATEGORIAS_id_CATEGORIAS',
							'$this->PRIORIDADES_nivel')
						";

				if (!$this->mysqli->query($sql)) { 
					return 'Error al insertar';
					
					echo $sql;
						
				}
				else{ 
					return 'Insertado correcto'; 
					
				}

} 

function edit()
{
	
    $sql = "SELECT * FROM tareas WHERE (id_tarea = '$this->id_tarea')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {	
		$sql = "UPDATE tareas SET
					`descripcion` = '$this->descripcion',
					`fecha_ini` = '$this->fecha_ini',
					`fecha_fin` = '$this->fecha_fin',
					`USUARIOS_login` = '$this->USUARIOS_login',
					`CATEGORIAS_id_CATEGORIAS` = '$this->CATEGORIAS_id_CATEGORIAS',
					`PRIORIDADES_nivel` = '$this->PRIORIDADES_nivel'
					

				WHERE (`id_tarea` = '$this->id_tarea')";

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
       			FROM tareas
    			WHERE
    				( 
    				(`id_tarea` LIKE '%$this->id_tarea%') &&
	 				(`descripcion` LIKE '%$this->descripcion%') &&
					(`fecha_ini` LIKE '%$this->fecha_ini%') &&
					(`fecha_fin` LIKE '%$this->fecha_fin%') &&
					(`USUARIOS_login` LIKE '%$this->USUARIOS_login%') &&
					(`CATEGORIAS_id_CATEGORIAS` LIKE '%$this->CATEGORIAS_id_CATEGORIAS%') &&
					(`PRIORIDADES_nivel` LIKE '%$this->PRIORIDADES_nivel%')
					
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
    $sql = "SELECT * FROM tareas WHERE (`id_tarea` = '$this->id_tarea')";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {
    	
        $sql = "DELETE FROM tareas WHERE (`id_tarea` = '$this->id_tarea')";
        
        $this->mysqli->query($sql);
        
    	return 'Borrado correctamente';
    } 
    else
        return 'No existe';
}

	function rellenadatos() {	
	$sql = "SELECT * FROM tareas WHERE (`id_tarea` = '$this->id_tarea')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		return $result;
	}
}

function TareasShowAll(){
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion 
	AS descripcion_prioridad, Fecha_Ini FROM tareas t,prioridades p WHERE t.PRIORIDADES_nivel = p.nivel";
	//die($sql);
	
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


}//fin de clase

?> 