<!---MODELO DE LOS USUARIOS QUE ADMINISTRARÁN LA LOTERIAIU,DONDE SE REALIZARÁ LA OPERACION DE INSERCIÓN EN LA BD
 CREADO POR mi3ac6 EL 23/11/2018-->
<?php
$login = $_SESSION['login'];

class TAREAS_Model {

	var $id_tarea;
	var $descripcion;
	var $fecha_ini;
	var $fecha_fin;
	var $completada;
	var $USUARIOS_login;
	var $CATEGORIAS_id_CATEGORIAS;
	var $PRIORIDADES_nivel;
	/* var $mysqli; */
	
	
//Constructor de la clase
//

function __construct($id_tarea,$descripcion,$fecha_ini,$fecha_fin,$completada,$USUARIOS_login,$CATEGORIAS_id_CATEGORIAS,$PRIORIDADES_nivel){
	$this->id_tarea = $id_tarea;
	$this->descripcion = $descripcion;
	$this->fecha_ini = $fecha_ini;
	$this->fecha_fin = $fecha_fin;
	$this->completada = $completada;
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
							'$this->completada',
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
   /* echo $sql; */
    if (!($resultado = $this->mysqli->query($sql))){
		/* echo $sql; */
		return 'No existe'; 
	}
    else{ 
	/* echo $sql; */
		$result = $resultado;
		return $result;
		
	}
}

function TareasShowAll(){
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion 
	AS descripcion_prioridad, p.color AS color_tarea, Fecha_Ini, t.completada AS completa FROM tareas t,prioridades p WHERE t.PRIORIDADES_nivel = p.nivel";
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

function BuscarMaxID(){
	$sql = "SELECT MAX(id_tarea)
			FROM tareas
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

function BuscarTareasUser(){//Busca las tareas que pertenezcan a un usuario normal
	$sql = " SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion 
	AS descripcion_prioridad, p.color AS color_tarea, Fecha_Ini, t.completada AS completa
			FROM tareas t,prioridades p
			WHERE `USUARIOS_login` = '".$_SESSION['login']."' && t.PRIORIDADES_nivel = p.nivel
					";
	/* echo $sql; */
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		/* echo $result; */
		/* print_r($resultado); */
		return $result;
	}
}


function OrdenarFecha(){//Ordena por fecha de inicio
	$sql = "SELECT id_tarea,t.descripcion,p.descripcion AS descripcion_prioridad, p.color AS color_tarea, t.completada AS completa
			FROM tareas t,prioridades p
			WHERE t.PRIORIDADES_nivel = p.nivel
			ORDER BY `Fecha_Ini` 
					";
	/* echo $sql; */
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		/* print_r($resultado); */
		return $result;
	}
}

function OrdenarPrioridad(){//Ordena por prioridad
	$sql = "SELECT id_tarea,t.descripcion,p.descripcion AS descripcion_prioridad, p.color AS color_tarea, t.completada AS completa
			FROM tareas t,prioridades p
			WHERE t.PRIORIDADES_nivel = p.nivel 
			ORDER BY `PRIORIDADES_nivel`  
					";
	/* echo $sql; */
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		/* print_r($resultado); */
		return $result;
	}
}

function OrdenarCategoria(){//Ordena por categoria
	$sql = "SELECT id_tarea,t.descripcion,p.descripcion AS descripcion_prioridad, p.color AS color_tarea, t.completada AS completa
			FROM tareas t,prioridades p
			WHERE t.PRIORIDADES_nivel = p.nivel
			ORDER BY `CATEGORIAS_id_CATEGORIAS`  
					";
	/* echo $sql; */
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		/* print_r($resultado); */
		return $result;
	}
}


function OrdenarFechaNormal(){//Ordena por fecha de inicio
	$sql = "SELECT id_tarea,t.descripcion,p.descripcion AS descripcion_prioridad, t.completada AS completa
			FROM tareas t,prioridades p
			WHERE t.PRIORIDADES_nivel = p.nivel && `USUARIOS_login` = '".$_SESSION['login']."'
			ORDER BY `Fecha_Ini` 
					";
	/* echo $sql; */
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		/* print_r($resultado); */
		return $result;
	}
}

function OrdenarPrioridadNormal(){//Ordena por prioridad
	$sql = "SELECT id_tarea,t.descripcion,p.descripcion AS descripcion_prioridad, t.completada AS completa
			FROM tareas t,prioridades p
			WHERE t.PRIORIDADES_nivel = p.nivel && `USUARIOS_login` = '".$_SESSION['login']."'
			ORDER BY `PRIORIDADES_nivel`  
					";
	/* echo $sql; */
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		/* print_r($resultado); */
		return $result;
	}
}

function OrdenarCategoriaNormal(){//Ordena por categoria
	$sql = "SELECT id_tarea,t.descripcion,p.descripcion AS descripcion_prioridad, t.completada AS completa
			FROM tareas t,prioridades p
			WHERE t.PRIORIDADES_nivel = p.nivel && `USUARIOS_login` = '".$_SESSION['login']."'
			ORDER BY `CATEGORIAS_id_CATEGORIAS`  
					";
	/* echo $sql; */
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		/* print_r($resultado); */
		return $result;
	}
}

function puedeCompletar()
{
	
	$sql = "SELECT * FROM fases WHERE (TAREAS_id_TAREAS = '$this->id_tarea') 
								   && (completada = '0')";

	    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 0)
    {	
		$date = date('Y-m-d', time());
		$sql = "UPDATE tareas SET
					`completada` = '1',
					`Fecha_Fin` = '$date'				

				WHERE (`id_tarea` = '$this->id_tarea')";

        if (!($resultado = $this->mysqli->query($sql))){
			return 'Error al completar la tarea';
		}
		else{ 
			return 'La tarea se ha cerrado'; 
		}
    }
    else 
    	return 'No se puede completar una tarea con fases abiertas';
}

function puedeDescompletar()
{	
	$sql = "UPDATE tareas SET
				`completada` = '0',
				`Fecha_Fin` = ''				

			WHERE (`id_tarea` = '$this->id_tarea')";

	if (!($resultado = $this->mysqli->query($sql))){
		return 'Error al completar la tarea';
	}
	else{ 
		return 'La tarea se ha cerrado'; 
	}
}



}//fin de clase

?> 