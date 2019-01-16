<!-- TABLA QUE MUESTRA TODAS LAS TAREAS
CREADO POR: Los Cangrejas
Fecha: 26/12/2018-->

<?php
//Comprueba si esta autenticado
include_once '../Functions/Authentication.php';
//Header
include_once '../Views/Header.php';

 //Declaracion de la clase 
 class Tareas_SHOWALL{ 
	//Datos de todas las tareas
	var $datos;
	//Datos de los archivos
	var $archivos;
	//Contador de archivos en una tarea
	var $archivos2;
	//Datos de las fases
	var $fases;
	//Contador de fases en una tarea
	var $fases2;
	//Datos de los contactos
	var $contactos;
	//Contador de contactos en una tarea
	var $contactos2;
	//Variable con el enlace al showall
	var $enlace;	
	
	//Constructor de la clase
	function __construct($datos,$archivos,$fases,$contactos,$enlace){
		
		$this -> datos = $datos;
		$this -> archivos = $archivos;
		$this -> archivos2 = [];
		//Cuenta el numero de archivos
		if($this -> archivos -> num_rows > 0){
			while($archi = $this -> archivos -> fetch_array()){
						$this -> archivos2[$archi[1]] = $archi[0];	
							}
		}
		
		$this -> fases = $fases;
		$this -> fases2 = [];
		//Cuenta el numero de fases
		if($this -> fases -> num_rows > 0){
			while($fas = $this -> fases -> fetch_array()){
						$this -> fases2[$fas[1]] = $fas[0];	
							}
		}
		
		$this -> contactos = $contactos;
		$this -> contactos2 = [];
		//Cuenta el numero de contactos
		if($this -> contactos -> num_rows > 0){
			while($cont = $this -> contactos -> fetch_array()){
						$this -> contactos2[$cont[1]] = $cont[0];	
							}
		}
		
		$this -> enlace = $enlace;
		$this -> pinta();
	}
	//Funcion que "muestra" el contenido de la página	
	function pinta(){
		//Variable de idioma
		if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }
//Archivo del idioma
        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
?>

 <!--Tabla con todas las tareas en la bd-->
        <div class="showall">           
		
            <table class="showAllUsers">
				<tr><th class="title" colspan="7"><?php echo $strings['Tareas']; ?>
				<form class="tableActions" action="../Controllers/Tareas_Controller.php" method="">
				 <!--Botones para añadir y buscar-->
					<button class="buscar-little" name="action" value="Confirmar_SEARCH1" type="submit"></button>
					<button class="anadir-little"  name="action" value="Confirmar_ADD" type="submit"></button>
				</form>
				 <!--Select para ordenar por fecha,categoria o prioridad-->
				<form class="tableActions" action="../Controllers/Tareas_Controller.php" method="">
					<div>
						<label class="lblSearch" for="action"><?php echo $strings['Ordenar por']; ?>:</label>
						<select class="slcSearch" name="action" id="action" onchange="this.form.submit()">
							<option value=""><?php echo $strings['Seleccionar']; ?></option>
							<option value="Ordenar_Fecha"><?php echo $strings['Fecha']; ?></option>
							<option value="Ordenar_Prioridad"><?php echo $strings['Prioridad']; ?></option>
							<option value="Ordenar_Categoria"><?php echo $strings['Categoria']; ?></option>
						</select>

					</div>
				</form>
				
				</th></tr>
				 <!--Campos de muestra-->
				<tr>
					<th><?php echo $strings['Completada']; ?></th>
					<th><?php echo $strings['Descripcion']; ?></th>
					<th><?php echo $strings['Categoria']; ?></th>	
					<th><?php echo $strings['Archivos']; ?></th>	
					<th><?php echo $strings['Fases']; ?></th>
					<th><?php echo $strings['Contactos']; ?></th>
					<th></th>
				</tr>
			<?php 
				//Mientras haya filas en la bd
				while($fila = $this ->datos->fetch_array()){                        
			?>
			 <!--Pone el color de fondo de la tarea dependiendo de su prioridad-->
				<tr style="background-color:<?php echo $fila['color_tarea']; ?>;">
				 <!--Tick para cerrar o abrir una fase-->
					<form action="../Controllers/Tareas_Controller.php" method="post" name="id_tarea" >
					 <!--Clave de la tarea que se pasa como hidden al model-->
						<input type="hidden" name="id_tarea" value="<?php echo $fila['id_tarea']; ?>">
						<?php
							if($fila['completa'] == 0){
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
						<td style="background-color:<?php echo $fila['color_tarea']; ?>;" ><button class="tarea" name="action" value="Confirmar_SHOWFASES"><?php echo $fila[1]; ?></button></td>
						<td><?php echo $fila[6]; ?></td>	
						<td>
						 <!--Muestra el numero de archivos-->
						<?php
						if($this -> archivos-> num_rows == 0){
							//Si no hay archivos muestra 0
							echo '0';
						}
						else{
							$entra = 0;
							//Foreach para contar los archivos que tiene la tarea
							foreach($this -> archivos2 as $indice => $valor){
								if($indice == $fila['id_tarea']){
									$entra = 1;
									echo $valor;
								}
							}
							if($entra == 0){
								echo '0';
							}
							$entra = 0;
						}
						?>
						</td>
						
						 <!--Muestra el numero de fases-->
						<td>
						<?php
						//Si no hay fases muestra 0
						if($this -> fases-> num_rows == 0){
							echo '0';
						}
						else{
							$entra = 0;
							//Foreach para contar las fases que tiene la tarea
							foreach($this -> fases2 as $indice => $valor){
								if($indice == $fila['id_tarea']){
									$entra = 1;
									echo $valor;
								}
							}
							if($entra == 0){
								echo '0';
							}
							$entra = 0;
						}
						?>
						</td>
						
						 <!--Muestra el numero de contactos-->
							<td>
						<?php
						//Si no hay contactos muestra 0
						if($this -> contactos-> num_rows == 0){
							echo '0';
						}
						else{
							$entra = 0;
							//Foreach para contar los contactos que tiene la tarea
							foreach($this -> contactos2 as $indice => $valor){
								if($indice == $fila['id_tarea']){
									$entra = 1;
									echo $valor;
								}
							}
							if($entra == 0){
								echo '0';
							}
							$entra = 0;
						}
						?>
						</td>
						
						<!--Botones para editar,borrar y ver en detalle-->
						<td style="text-align:right">
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