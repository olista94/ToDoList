
<?php

include_once '../Functions/Authentication.php';
include_once '../Views/Header.php';

 class Fases_SHOWCURRENT{	 
	
	var $fila;
	var $archivos;
	var $contactos;
	var $enlace;	
	
	function __construct($fila,$archivos,$contactos,$enlace){
		
		$this -> fila = $fila -> fetch_array();
		$this -> archivos = $archivos;
		$this -> contactos = $contactos;
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	
	function mostrar(){
		
		if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
 
?>

	<div class="showall">

			
	<form class="form">
		<legend>Ficheros de la fase</legend>
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
	
	<form class="form">
		<legend>Contactos de la tarea</legend>
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
								
		<div class="show-half">	
            <table class="showU" style="margin-left: 30%;">

                <tr><th class="title" colspan="2"><?php echo $strings['Detalles de la fase']; ?>
                    <button onclick="location.href='../Controllers/Tareas_Controller.php?action=Confirmar_SHOWFASES&id_tarea=<?php echo $this -> fila['TAREAS_id_TAREAS']; ?>';" class="volver"></button></th>
                </tr>
                <tr>
                    <th><?php echo $strings['Descripcion']; ?></th>
                    <td><?php echo $this -> fila['descripcion']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Fecha inicio']; ?></th>
                    <td><?php echo $this -> fila['fecha_inicio']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Fecha fin']; ?></th>
                    <td><?php echo $this -> fila['fecha_fin']; ?></td>
                </tr>
                       
                                                                        
            </table>

        </div>
	</div>
		
	<footer>
		<?php include '../Views/Footer.php'; ?>
	</footer>

	<?php
				}
			}
		?>