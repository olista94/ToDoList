<!-- TABLA QUE MUESTRA LOS DATOS DE UNA FASE
CREADO POR: Los Cangrejas
Fecha: 26/12/2018-->

<?php
  	 //Comprueba que esta autenticado
include_once '../Functions/Authentication.php';
include_once '../Views/Header.php';
  //Declaracion de la clase
 class Fases_SHOWCURRENT{	 
	  //Datos de la fase,con sus archivos y contactos
	var $fila;
	var $archivos;
	var $contactos;
	//Variable con el enlace al SHOWCURRENT fase
	var $enlace;	
		//Constructor de la clase
	function __construct($fila,$archivos,$contactos,$enlace){
		
		$this -> fila = $fila -> fetch_array();
		$this -> archivos = $archivos;
		$this -> contactos = $contactos;
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
		//función que pinta la vista
	function mostrar(){
		//Variable de idioma
		if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }
//Archivo del idioma
        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
 
?>
	

	<div class="showall">

				<!--Tabla con los ficheros de la fase-->
	<form class="form">
		<legend><?php echo $strings['Ficheros de la fase']; ?></legend>
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
	</div>
	<div class="showall">
	
		<!--Tabla con los contactos de la fase-->
	<form class="form">
		<legend><?php echo $strings['Contactos de la fase']; ?></legend>
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
					<!--Tabla con los datos de la fase-->				
		<div class="show-half">	
            <table class="showU" style="margin-left: 30%;">

                <tr><th class="title" colspan="2"><?php echo $strings['Detalles de la fase']; ?>
					 <!--Boton para volver atrás -->
				   <button onclick="location.href='../Controllers/Tareas_Controller.php?action=Confirmar_SHOWFASES&id_tarea=<?php echo $this -> fila['TAREAS_id_TAREAS']; ?>';" class="volver"></button></th>
                </tr>
				<tr>
				<!--Campo ID de la fase-->
                        <th><?php echo $strings['ID fase']; ?></th>
                        <td><?php echo $this -> fila['id_FASES']; ?></td>
                    </tr>
                <tr>
				<!--Campo descripcion de la fase-->
                    <th><?php echo $strings['Descripcion']; ?></th>
                    <td><?php echo $this -> fila['descripcion']; ?></td>
                </tr>
				<!--Campo fecha inicio de la fase-->
                <tr>
                    <th><?php echo $strings['Fecha inicio']; ?></th>
                    <td><?php echo $this -> fila['fecha_inicio']; ?></td>
                </tr>
				<!--Campo fecha fin de la fase-->
                <tr>
                    <th><?php echo $strings['Fecha fin']; ?></th>
                    <td><?php echo $this -> fila['fecha_fin']; ?></td>
                </tr>
                       
                                                                        
            </table>

        </div>
	</div>
		
	<footer>
	<!--Pie-->
		<?php include '../Views/Footer.php'; ?>
	</footer>

	<?php
				}
			}
		?>