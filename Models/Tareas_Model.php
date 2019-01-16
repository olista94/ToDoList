<!---MODELO DE LAS TAREAS
 CREADO POR los Cangrejas EL 21/12/2018-->
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
	
//Constructor de la clase
function __construct($id_tarea,$descripcion,$fecha_ini,$fecha_fin,$completada,$USUARIOS_login,$CATEGORIAS_id_CATEGORIAS,$PRIORIDADES_nivel){
	$this->id_tarea = $id_tarea;
	$this->descripcion = $descripcion;
	$this->fecha_ini = $fecha_ini;
	$this->fecha_fin = $fecha_fin;
	$this->completada = $completada;
	$this->USUARIOS_login = $USUARIOS_login;
	$this->CATEGORIAS_id_CATEGORIAS = $CATEGORIAS_id_CATEGORIAS;
	$this->PRIORIDADES_nivel = $PRIORIDADES_nivel;

		//Incluimos el archivo de acceso a la bd
		include_once 'Access_DB.php';
		//Funcion de conexion a la bd
		$this->mysqli = ConnectDB();
}

//Funcion para añadir una tarea
function add(){

	//Fecha actual para la fecha de insercion
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
		return 'Error al insertar';//Devuelve mensaje de error
		
		
			
	}
	else{ 
		return 'Insercion correcta'; //Devuelve mensaje de exito
		
	}

} 

//Funcion para editar una tarea
function edit()
{
	
    $sql = "SELECT * FROM tareas WHERE (id_tarea = '$this->id_tarea')";
    
    $result = $this->mysqli->query($sql);//Guarda el resultado
    
    if ($result->num_rows == 1)
    {	
		$sql = "UPDATE tareas SET
					`descripcion` = '$this->descripcion',
					`CATEGORIAS_id_CATEGORIAS` = '$this->CATEGORIAS_id_CATEGORIAS',
					`PRIORIDADES_nivel` = '$this->PRIORIDADES_nivel'
					

				WHERE (`id_tarea` = '$this->id_tarea')";

        if (!($resultado = $this->mysqli->query($sql))){
			return 'Error en la modificación';//Devuelve mensaje de error
		}
		else{ 
			return 'Modificado correctamente'; //Devuelve mensaje de exito
		}
    }
    else 
    	return 'No existe';//Devuelve mensaje de error
} 

//Funcion para buscar una tarea
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
				
				
    if (!($resultado = $this->mysqli->query($sql))){
		return 'Error en la búsqueda'; //Devuelve mensaje de error
	
	}
    else{ 
	
		return $resultado;//Se devuelve el resultado de la consulta
	}
}

//Funcion para buscar las tareas de un usuario
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
	return 'Error en la búsqueda';//Devuelve mensaje de error

	}
	else{ 
	return $resultado;//Se devuelve el resultado de la consulta
	}
}

//Funcion para buscar todas las tareas
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
	return 'Error en la búsqueda';//Devuelve mensaje de error
	
	}
	else{ 
	return $resultado;//Se devuelve el resultado de la consulta
	}
}

//Funcion para borrar una tarea
function delete()
{	
    $sql = "SELECT * FROM tareas WHERE (`id_tarea` = '$this->id_tarea')";
    
    $result = $this->mysqli->query($sql);//Se guarda el resultado de la consulta sql
    
    if ($result->num_rows == 1)
    {
    	
        $sql = "DELETE FROM tareas WHERE (`id_tarea` = '$this->id_tarea')";
        
        $this->mysqli->query($sql);//Guarda el resultado
        
    	return 'Borrado correctamente';//Devuelve mensaje de exito
    } 
    else
        return 'No existe';//Devuelve mensaje de error
}

//Funcion que devuelve los datos de una tarea
function rellenadatos() {	
	$sql = "SELECT * FROM tareas WHERE (`id_tarea` = '$this->id_tarea')";
   
    if (!($resultado = $this->mysqli->query($sql))){
		
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
	
		$result = $resultado;//Se guarda el resultado de la consulta sql
		return $result;//Se devuelve el resultado de la consulta
		
	}
}

//Funcion que devuelve todas las tareas
function TareasShowAll(){
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p, categorias c 
			WHERE t.PRIORIDADES_nivel = p.nivel && c.id_CATEGORIAS = t.CATEGORIAS_id_CATEGORIAS";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado;//Se guarda el resultado de la consulta sql
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Funcion que devuelve todas la tareas de un usuario
function TareasShowAllNormal(){
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p, categorias c 
			WHERE t.PRIORIDADES_nivel = p.nivel && c.id_CATEGORIAS = t.CATEGORIAS_id_CATEGORIAS && `USUARIOS_login` = '".$_SESSION['login']."'";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado;//Se guarda el resultado de la consulta sql
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Funcion para buscar el ID de una tarea
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
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado->fetch_array()[0];//Se guarda el resultado de la consulta sql
		
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Funcion para buscar la descripcion de la ultima tarea insertada
function BuscarID2(){
	$sql = "SELECT descripcion
			FROM tareas
			WHERE id_tarea = (SELECT MAX(id_tarea)
							 FROM tareas) ";
					
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado->fetch_array()[0];//Se guarda el resultado de la consulta sql
		
		return $result;//Se devuelve el resultado de la consulta
	}
}

// Funcion para buscar la ultima tarea insertada
function BuscarMaxID(){
	$sql = "SELECT MAX(id_tarea)
			FROM tareas
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado->fetch_array()[0];//Se guarda el resultado de la consulta sql
		
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Funcion para buscar la descripcion de una tarea
function BuscarDescripcion(){
	$sql = "SELECT descripcion
			FROM tareas
			WHERE id_tarea = '$this->id_tarea' ";
					
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado->fetch_array()[0];//Se guarda el resultado de la consulta sql
		
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Busca las tareas que pertenezcan a un usuario normal
function BuscarTareasUser(){
	$sql = " SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion 
	AS descripcion_prioridad, p.color AS color_tarea, Fecha_Ini, t.completada AS completa
			FROM tareas t,prioridades p
			WHERE `USUARIOS_login` = '".$_SESSION['login']."' && t.PRIORIDADES_nivel = p.nivel
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado;//Se guarda el resultado de la consulta sql
		
		
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Ordena por fecha de inicio
function OrdenarFecha(){
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p,categorias c
			WHERE t.PRIORIDADES_nivel = p.nivel && `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS
			ORDER BY `Fecha_Ini` 
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado;//Se guarda el resultado de la consulta sql
		
		
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Ordena por prioridad
function OrdenarPrioridad(){
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p,categorias c
			WHERE t.PRIORIDADES_nivel = p.nivel && `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS 
			ORDER BY `PRIORIDADES_nivel`  
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado;//Se guarda el resultado de la consulta sql
		
		
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Ordena por categoria
function OrdenarCategoria(){
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p,categorias c
			WHERE t.PRIORIDADES_nivel = p.nivel && `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS
			ORDER BY `CATEGORIAS_id_CATEGORIAS`  
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado;//Se guarda el resultado de la consulta sql
		
		
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Ordena por fecha de inicio
function OrdenarFechaNormal(){
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p,categorias c
			WHERE t.PRIORIDADES_nivel = p.nivel && `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS && `USUARIOS_login` = '".$_SESSION['login']."'
			ORDER BY `Fecha_Ini` 
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado;//Se guarda el resultado de la consulta sql
		
		
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Ordena por prioridad
function OrdenarPrioridadNormal(){
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p,categorias c
			WHERE t.PRIORIDADES_nivel = p.nivel && `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS && `USUARIOS_login` = '".$_SESSION['login']."'
			ORDER BY `PRIORIDADES_nivel` 
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe';//Devuelve mensaje de error 
	}
    else{ 
		$result = $resultado;//Se guarda el resultado de la consulta sql
		
		
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Ordena por categoria
function OrdenarCategoriaNormal(){
	$sql = "SELECT id_tarea,t.descripcion AS descripcion_tarea ,p.descripcion AS descripcion_prioridad, p.color AS color_tarea,
			Fecha_Ini, t.completada AS completa, c.nombre as categoria
			FROM tareas t,prioridades p,categorias c
			WHERE t.PRIORIDADES_nivel = p.nivel && `CATEGORIAS_id_CATEGORIAS`= c.id_CATEGORIAS && `USUARIOS_login` = '".$_SESSION['login']."'
			ORDER BY `CATEGORIAS_id_CATEGORIAS`  
					";
	
	
	if (!($resultado = $this->mysqli->query($sql))){
		return 'No existe'; //Devuelve mensaje de error
	}
    else{ 
		$result = $resultado;//Se guarda el resultado de la consulta sql
		
		
		return $result;//Se devuelve el resultado de la consulta
	}
}

//Funcion que determina si se puede completar una tarea
function puedeCompletar()
{
	
	$sql = "SELECT * FROM fases WHERE (TAREAS_id_TAREAS = '$this->id_tarea') 
								   && (completada = '0')";

	    
    $result = $this->mysqli->query($sql);//Guarda el resultado
    
    if ($result->num_rows == 0)
    {	
		$date = date('Y-m-d', time());
		$sql = "UPDATE tareas SET
					`completada` = '1',
					`Fecha_Fin` = '$date'				

				WHERE (`id_tarea` = '$this->id_tarea')";

        if (!($resultado = $this->mysqli->query($sql))){
			return 'Error al cerrar la tarea';//Devuelve mensaje de error
		}
		else{ 
			return 'La tarea se ha cerrado'; //Devuelve mensaje de exito
		}
    }else{ 
		return 'No se puede cerrar una tarea con fases abiertas';//Devuelve mensaje de error
	}
}

//Funcion que descompleta una tarea
function puedeDescompletar()
{	
	$sql = "UPDATE tareas SET
				`completada` = '0',
				`Fecha_Fin` = ''				

			WHERE (`id_tarea` = '$this->id_tarea')";

	if (!($resultado = $this->mysqli->query($sql))){
		return 'Error al abrir la tarea';//Devuelve mensaje de error
	}
	else{ 
		return 'La tarea se ha vuelto a abrir'; //Devuelve mensaje de exito
	}
}

//Funcion que devuelve una tarea completa
function TareasCompleto()
{	
    $sql = "SELECT T.*,C.nombre,P.descripcion
			FROM tareas T,categorias C,prioridades P 
			WHERE T.CATEGORIAS_id_CATEGORIAS = C.id_CATEGORIAS && T.PRIORIDADES_nivel = P.nivel 
			AND T.id_tarea = '$this->id_tarea' 
			";
    
    $result = $this->mysqli->query($sql);//Se guarda el resultado de la consulta sql
    
    if ($result->num_rows == 1)
    {
    	
       return $result;//Se devuelve el resultado de la consulta
    } 
    else
        return 'No existe';//Devuelve mensaje de error
}

//Funcion que cuenta los archivos de una tarea
function ContarArchivos()
{	
    $sql = "SELECT COUNT(`id_ARCHIVOS`),`FASES_TAREAS_id_TAREAS`
			FROM archivos
			GROUP BY `FASES_TAREAS_id_TAREAS`
			";
    
    $result = $this->mysqli->query($sql);//Se guarda el resultado de la consulta sql
    
    if ($result)
    {    	
       return $result;//Se devuelve el resultado de la consulta
    } 
    else
        return 'No existe';//Devuelve mensaje de error
}

//Funcion que cuenta las fases de una tarea
function ContarFases()
{	
    $sql = "SELECT COUNT(`id_FASES`),`TAREAS_id_TAREAS`
			FROM fases
			GROUP BY `TAREAS_id_TAREAS`
			";
    
    $result = $this->mysqli->query($sql);//Se guarda el resultado de la consulta sql
    
    if ($result)
    {
    	
       return $result;//Se devuelve el resultado de la consulta
    } 
    else
        return 'No existe';//Devuelve mensaje de error
}

//Funcion que cuenta los contactos de una tarea
function ContarContactos()
{	
    $sql = "SELECT COUNT(DISTINCT  `CONTACTOS_email`),`FASES_TAREAS_id_TAREAS`
			FROM fases_has_contactos
			GROUP BY `FASES_TAREAS_id_TAREAS`
			";
    
    $result = $this->mysqli->query($sql);//Se guarda el resultado de la consulta sql
    
    if ($result)
    {
    	
       return $result;//Se devuelve el resultado de la consulta
    } 
    else
        return 'No existe';//Devuelve mensaje de error
}

//Funcion que devuelve el estado de una tarea (completada o sin completar)
function getEstado(){
	$sql = "SELECT completada FROM tareas WHERE id_tarea = '$this->id_tarea'";

	$result = $this->mysqli->query($sql);//Se guarda el resultado de la consulta sql

	$estado = $result->fetch_array()[0];//Guarda el resultado (el estado de la tarea)
    
    if ($estado == 0){	
       	return 'No'; //Devuelve el estado de la tarea
    }else{
		return 'No se puede añadir una fase a una tarea cerrada';//Devuelve mensaje de error
	}
}


}//fin de clase

?> 