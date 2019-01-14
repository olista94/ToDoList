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
				$date = date('Y-m-d', time());
				$sql = "INSERT INTO tareas
						VALUES (
							'$this->id_tarea',
							'$this->descripcion',
							'$date',
							'$this->fecha_fin',
							'$this->completada',
							'$this->USUARIOS_login',
							'$this->CATEGORIAS_id_CATEGORIAS',
							'$this->PRIORIDADES_nivel')
						";

				if (!$this->mysqli->query($sql)) { 
					return 'Error al insertar';
					
					
						
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

/* function search(){ 

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
				
				
    if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la búsqueda';
	
	}
    else{ 
	
		return $resultado;
	}
}
 */
function search1(){ 

	$sql = "
			   SELECT id_tarea,t.`descripcion`,`Fecha_Ini`,`Fecha_Fin`,`completada` as completa,`USUARIOS_login`,c.nombre as categoria,p.descripcion,p.color AS color_tarea
			   FROM `tareas` t,categorias c,prioridades p
			   WHERE `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS && `PRIORIDADES_nivel`=p.nivel &&
			   (`id_tarea` LIKE '%$this->id_tarea%') &&
				(t.`descripcion` LIKE '%$this->descripcion%') &&
			   (`Fecha_Ini` LIKE '%$this->fecha_ini%') &&
			   (`Fecha_Fin` LIKE '%$this->fecha_fin%') &&
			   (`completada` LIKE '%$this->completada%') &&
			   (`USUARIOS_login` = '".$_SESSION['login']."') &&
			   (c.nombre LIKE '%$this->CATEGORIAS_id_CATEGORIAS%') &&
			   (p.descripcion LIKE '%$this->PRIORIDADES_nivel%')
	
	
	";
		   

if (!($resultado = $this->mysqli->query($sql))){
   return 'Error en la búsqueda';
   /* return "Error en la consulta"; */
}
else{ 
   return $resultado;
}
}

function searchAdmin(){ 

	$sql = "
			   SELECT id_tarea,t.`descripcion`,`Fecha_Ini`,`Fecha_Fin`,`completada` as completa,`USUARIOS_login`,c.nombre as categoria,p.descripcion,p.color AS color_tarea
			   FROM `tareas` t,categorias c,prioridades p
			   WHERE `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS && `PRIORIDADES_nivel`=p.nivel &&
			   
				(t.`descripcion` LIKE '%$this->descripcion%') &&
			   (`Fecha_Ini` LIKE '%$this->fecha_ini%') &&
			   (`Fecha_Fin` LIKE '%$this->fecha_fin%') &&
			   (`completada` LIKE '%$this->completada%') &&
			   (`USUARIOS_login` LIKE '%$this->USUARIOS_login%') &&
			   (c.nombre LIKE '%$this->CATEGORIAS_id_CATEGORIAS%') &&
			   (p.descripcion LIKE '%$this->PRIORIDADES_nivel%')
	
	
	";
		   

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
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p, categorias c 
			WHERE t.PRIORIDADES_nivel = p.nivel && c.id_CATEGORIAS = t.CATEGORIAS_id_CATEGORIAS";
	//die($sql);
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		return $result;
	}
}

function TareasShowAllNormal(){
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p, categorias c 
			WHERE t.PRIORIDADES_nivel = p.nivel && c.id_CATEGORIAS = t.CATEGORIAS_id_CATEGORIAS && `USUARIOS_login` = '".$_SESSION['login']."'";
	
	
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
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado->fetch_array()[0];
		
		return $result;
	}
}

function BuscarID2(){
	$sql = "SELECT descripcion
			FROM tareas
			WHERE id_tarea = (SELECT MAX(id_tarea)
							 FROM tareas) ";
					
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado->fetch_array()[0];
		
		return $result;
	}
}

function BuscarMaxID(){
	$sql = "SELECT MAX(id_tarea)
			FROM tareas
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado->fetch_array()[0];
		
		return $result;
	}
}

function BuscarDescripcion(){
	$sql = "SELECT descripcion
			FROM tareas
			WHERE id_tarea = '$this->id_tarea' ";
					
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado->fetch_array()[0];
		
		return $result;
	}
}

function BuscarTareasUser(){//Busca las tareas que pertenezcan a un usuario normal
	$sql = " SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion 
	AS descripcion_prioridad, p.color AS color_tarea, Fecha_Ini, t.completada AS completa
			FROM tareas t,prioridades p
			WHERE `USUARIOS_login` = '".$_SESSION['login']."' && t.PRIORIDADES_nivel = p.nivel
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		
		return $result;
	}
}


function OrdenarFecha(){//Ordena por fecha de inicio
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p,categorias c
			WHERE t.PRIORIDADES_nivel = p.nivel && `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS
			ORDER BY `Fecha_Ini` 
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		
		return $result;
	}
}

function OrdenarPrioridad(){//Ordena por prioridad
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p,categorias c
			WHERE t.PRIORIDADES_nivel = p.nivel && `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS 
			ORDER BY `PRIORIDADES_nivel`  
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		
		return $result;
	}
}

function OrdenarCategoria(){//Ordena por categoria
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p,categorias c
			WHERE t.PRIORIDADES_nivel = p.nivel && `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS
			ORDER BY `CATEGORIAS_id_CATEGORIAS`  
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		
		return $result;
	}
}


function OrdenarFechaNormal(){//Ordena por fecha de inicio
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p,categorias c
			WHERE t.PRIORIDADES_nivel = p.nivel && `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS && `USUARIOS_login` = '".$_SESSION['login']."'
			ORDER BY `Fecha_Ini` 
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		
		return $result;
	}
}

function OrdenarPrioridadNormal(){//Ordena por prioridad
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p,categorias c
			WHERE t.PRIORIDADES_nivel = p.nivel && `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS && `USUARIOS_login` = '".$_SESSION['login']."'
			ORDER BY `PRIORIDADES_nivel` 
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		
		return $result;
	}
}

function OrdenarCategoriaNormal(){//Ordena por categoria
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p,categorias c
			WHERE t.PRIORIDADES_nivel = p.nivel && `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS && `USUARIOS_login` = '".$_SESSION['login']."'
			ORDER BY `CATEGORIAS_id_CATEGORIAS`  
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; 
	}
    else{ 
		$result = $resultado;
		
		
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
			return 'Error al cerrar la tarea';
		}
		else{ 
			return 'La tarea se ha cerrado'; 
		}
    }else{ 
		return 'No se puede cerrar una tarea con fases abiertas';
	}
}

function puedeDescompletar()
{	
	$sql = "UPDATE tareas SET
				`completada` = '0',
				`Fecha_Fin` = ''				

			WHERE (`id_tarea` = '$this->id_tarea')";

	if (!($resultado = $this->mysqli->query($sql))){
		return 'Error al abrir la tarea';
	}
	else{ 
		return 'La tarea se ha vuelto a abrir'; 
	}
}

function TareasCompleto()
{	
    $sql = "SELECT T.*,C.nombre,P.descripcion
			FROM tareas T,categorias C,prioridades P 
			WHERE T.CATEGORIAS_id_CATEGORIAS = C.id_CATEGORIAS && T.PRIORIDADES_nivel = P.nivel 
			AND T.id_tarea = '$this->id_tarea' 
			";
    
    $result = $this->mysqli->query($sql);
    
    if ($result->num_rows == 1)
    {
    	
       return $result;
    } 
    else
        return 'No existe';
}

function ContarArchivos()
{	
    $sql = "SELECT COUNT(`id_ARCHIVOS`),`FASES_TAREAS_id_TAREAS`
			FROM archivos
			GROUP BY `FASES_TAREAS_id_TAREAS`
			";
    
    $result = $this->mysqli->query($sql);
    
    if ($result)
    {    	
       return $result;
    } 
    else
        return 'No existe';
}

function ContarFases()
{	
    $sql = "SELECT COUNT(`id_FASES`),`TAREAS_id_TAREAS`
			FROM fases
			GROUP BY `TAREAS_id_TAREAS`
			";
    
    $result = $this->mysqli->query($sql);
    
    if ($result)
    {
    	
       return $result;
    } 
    else
        return 'No existe';
}

function ContarContactos()
{	
    $sql = "SELECT COUNT(DISTINCT  `CONTACTOS_email`),`FASES_TAREAS_id_TAREAS`
			FROM fases_has_contactos
			GROUP BY `FASES_TAREAS_id_TAREAS`
			";
    
    $result = $this->mysqli->query($sql);
    
    if ($result)
    {
    	
       return $result;
    } 
    else
        return 'No existe';
}

function getEstado(){
	$sql = "SELECT completada FROM tareas WHERE id_tarea = '$this->id_tarea'";

	$result = $this->mysqli->query($sql);

	$estado = $result->fetch_array()[0];
    
    if ($estado == 0){	
       	return 'No';
    }else{
		return 'No se puede añadir una fase a una tarea cerrada';
	}
}


}//fin de clase

?> 