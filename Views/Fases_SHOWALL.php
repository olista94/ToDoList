<!-- TABLA QUE MUESTRA TODOS LOS fases QUE JUEGAN LA LOTERIAIU
 CREADO POR mi3ac6 EL 17/11/2018-->
<?php
//Comprueba si esta autenticado
include_once '../Functions/Authentication.php';
include_once '../Views/Header.php';
 //Declaracion de la clase 
 class Fases_SHOWALL{	 
	//Datos de las fases
	var $datos;
	//Archivos de una fase
	var $archivos;
	//Contactos de una fase
	var $contactos;
	//Tarea de la fase
	var $tareas;
	//Variable con el enlace al showall
	var $enlace;	
	
		//Constructor de la clase
	function __construct($datos,$archivos,$contactos,$tareas,$enlace){
		
		$this -> datos = $datos;
		$this -> archivos = $archivos;
		$this -> contactos = $contactos;
		if(is_string($tareas)){
			$this -> tareas = array();
		}else{
			$this -> tareas = $tareas -> fetch_array();
		}
		$this -> enlace = $enlace;
		
		$this -> aux = $this ->datos->fetch_array();

		$this -> mostrar();
	}
		//Funcion que "muestra" el contenido de la página
	function mostrar(){
		//Variable de idioma
		if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }
//Archivo del idioma
        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php'; 
?>
 <!--Boton para volver atrás -->
	<button onclick="location.href='../Controllers/Tareas_Controller.php?action=default';" class="volver"></button>
	 <!--Tabla con los detalles de la tarea a la que pertenece la fase-->
	
	<div class="showDandF">	
		<table class="showD" >

			<tr><th class="title" colspan="4"><?php echo $strings['Detalles de la tarea']; ?>

			</tr>
			<!--Campo ID de la tarea-->
			<tr>
				<th><?php echo $strings['Id tarea']; ?></th>
				<td><?php echo $this -> tareas['id_tarea']; ?></td>								
			</tr>
			<!--Campo descripcion de la tarea-->
			<tr>
				<th><?php echo $strings['Descripcion']; ?></th>
				<td><?php echo $this -> tareas[1]; ?></td>
			</tr>
			  <!--Campo fecha inicio de la tarea-->
			<tr>
				<th><?php echo $strings['Fecha inicio']; ?></th>
				<td><?php echo $this -> tareas['Fecha_Ini']; ?></td>
			</tr>
			  <!--Campo fecha fin de la tarea-->
			<tr>
				<th><?php echo $strings['Fecha fin']; ?></th>
				<td><?php echo $this -> tareas['Fecha_Fin']; ?></td>
			</tr>
			  <!--Usuario que creo la tarea-->
			<tr>
				<th><?php echo $strings['Usuario']; ?></th>
				<td><?php echo $this -> tareas['USUARIOS_login']; ?></td>
			</tr>
			 <!--Categoria de la tarea-->
			<tr>
				<th><?php echo $strings['Categoria']; ?></th>
				<td><?php echo $this -> tareas[8]; ?></td>
			</tr>
			 <!--Prioridad de la tarea-->
			<tr>
				<th><?php echo $strings['Prioridad']; ?></th>
				<td><?php echo $this -> tareas[9]; ?></td>
			</tr>             

		</table>
 <!--Ficheros de la tarea-->
		<form class=showT>
		<legend><?php echo $strings['Ficheros de la tarea']; ?></legend>
		<?php
			if($this ->archivos != null){
				while($fila2 = $this ->archivos->fetch_array()){
		?>  
			<li><a href="<?php echo $fila2['url']; ?>" download><?php echo $fila2['nombre']; ?></a></li>
		<?php
				}
			}
		?>
		</form>
 <!--Contactos de la tarea-->
		<form class=showT>
		<legend><?php echo $strings['Contactos de la tarea']; ?></legend>
		<?php
			if($this ->contactos != null){
				while($fila3 = $this ->contactos->fetch_array()){
		?>  
			<li><a><?php echo $fila3['CONTACTOS_email']; ?></a></li>
		<?php
				}
			}
		?>
		</form>

	</div>
 <!--Tabla con todas las fases de una tarea-->
	<div class="showall">
							
		<table class="showAllUsers">
			<tr><th class="title" colspan="8"><?php echo $strings['Fases']; ?>
			<form class="tableActions" action="../Controllers/Fases_Controller.php" method="">
			 <!--Clave de la tarea que se pasa como hidden al model-->
				<input type="hidden" name="TAREAS_id_TAREAS" value="<?php echo $this->tareas['id_tarea']; ?>">
				 <!--Botones para añadir y buscar-->
				<button class="buscar-little" name="action" value="Confirmar_SEARCH" type="submit"></button>
				<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
			</form></th></tr>
 <!--Campos de muestra-->
			<tr>
				<th><?php echo $strings['Completada']; ?></th>
				<th><?php echo $strings['Descripcion']; ?></th>
				<th><?php echo $strings['Fecha inicio']; ?></th>		
				<th></th>
			</tr>
		<?php
			$this -> datos->data_seek(0);
			while($fila = $this ->datos->fetch_array()){     
			
		?>
		
			<tr>
			 <!--Tick para cerrar o abrir una fase-->
				<form action="../Controllers/Fases_Controller.php" method="post" name="id_fase" >
					<input type="hidden" name="id_fase" value="<?php echo $fila[0]; ?>">
					<input type="hidden" name="TAREAS_id_TAREAS" value="<?php echo $fila['TAREAS_id_TAREAS']; ?>">
					<?php
						if($fila['completada'] == 0){
					?>
						<td>
							<label class="container">
							<input type="checkbox" name="action" onclick="this.form.submit()" value="Confirmar_COMPLETADA"><span class="checkmark"></span>
							</label>
						</td>
					<?php
						}else{
					?>
						<td>
							<label class="container">
							<input type="hidden" name="action" value="Confirmar_NO_COMPLETADA"/>
							<input type="checkbox" name="action" onclick="this.form.submit()" value="Confirmar_NO_COMPLETADA" checked><span class="checkmark"></span>
							</label>
						</td>
					<?php
						}
					?>
					<td><?php echo $fila['descripcion']; ?></td>
					<td><?php echo $fila['fecha_inicio']; ?></td>			
					<td style="text-align:right">
					 <!--Botones para editar,borrar y ver en detalle-->
						<button class="editar" name="action" value="Confirmar_EDIT" type="submit"></button>
						<button class="borrar" name="action" value="Confirmar_DELETE1" type="submit"></button>
						<button class="add" name="action" value="Confirmar_SHOWCURRENT" type="submit"></button>
					</td>
				</form>
			</tr>
		<?php
			}
		?>                 
		</table> 
	
	</div>           
			
	<?php   
		}
	}
	?>
		
	<footer>
	 <!--Pie-->
		<?php include '../Views/Footer.php'; ?>
	</footer>