<!-- TABLA QUE MUESTRA TODOS LOS DATOS DE UNA FASE A BORRAR
 CREADO POR mi3ac6 EL 17/11/2018-->
 
  <?php
  	 //Comprueba que esta autenticado
	include_once '../Functions/Authentication.php';
  //Declaracion de la clase
 class Fases_DELETE{


	var $fila;
	//Variable con el enlace al DELETE fase
	var $enlace;
	//Constructor de la clase
	function __construct($fila,$enlace){
		
		$this -> fila = $fila -> fetch_array();

		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	
	//función que pinta la vista
    function mostrar(){
        //comprueba si hay un idioma en $_SESSION
        //si no, inserta el idioma español
        if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }
//Archivo del idioma
        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
	?>
	
	<!--Tabla con los datos de la fase-->
		<div class="show-half">
            
            <form class="formShow" enctype="multipart/form-data" action="../Controllers/Fases_Controller.php">
				<!--Clave de la fase que se pasa como hidden al model-->
                <input type="hidden" name="id_fase" value= "<?php echo $this -> fila['id_FASES'] ?>">
                <!--Clave de la tarea que se pasa como hidden al model-->
				<input type="hidden" name="id_tarea" value= "<?php echo $this -> fila['TAREAS_id_TAREAS'] ?>">
                <table class="showU" style="margin-left: 30%;">

                    <tr><th class="title" colspan="4"><?php echo $strings['Borrar fase']; ?>
                    <!--Boton para volver atrás -->
					<button type="button" onclick="location.href='../Controllers/Tareas_Controller.php?action=Confirmar_SHOWFASES&id_tarea=<?php echo $this -> fila['TAREAS_id_TAREAS'] ?>';" class="volver"></button></th>                    
                    </tr>
				<!--Campo ID de la fase-->
					<tr>
                        <th><?php echo $strings['ID fase']; ?></th>
                        <td><?php echo $this -> fila['id_FASES']; ?></td>
                    </tr>
					<!--Campo descripcion de la fase-->
                    <tr>
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

                    <tr>
					<!--Boton de confirmar borrado-->
                        <th><button class="borrar-si" type="submit" name="action" value="Confirmar_DELETE2"></button></th>
                      <!--Boton de cancelar borrado-->
					   <td><button class="borrar-no" type="submit" name="action" value=""></button></td>
                    </tr>            
                                                                            
                </table>
            </form>            
        </div>       
        
<?php    
    }
}
?>