<!-- TABLA QUE MUESTRA TODOS LOS DATOS DE UNA TAREA A BORRAR
 CREADO POR mi3ac6 EL 17/11/2018-->
 
<?php

	include_once '../Functions/Authentication.php';

 class Tareas_DELETE{
	 
	var $fila;
	var $prioridades;
	var $categorias;
	var $enlace;
	
	function __construct($fila,$prioridades,$categorias,$enlace){

		$this -> fila = $fila -> fetch_array();

		$this -> prioridades = $prioridades -> fetch_array();
		$this -> categorias = $categorias -> fetch_array();
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

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
?>
            
		<div class="show-half">
            <form class="formShow" enctype="multipart/form-data" action="../Controllers/Tareas_Controller.php">
                <input type="hidden" name="id_tarea" value= "<?php echo $this -> fila['id_tarea'] ?>">
                <table class="showU" style="margin-left: 30%;">

                    <tr><th class="title" colspan="4"><?php echo $strings['Borrar tarea']; ?>
                        <button onclick="location.href='../Controllers/Tareas_Controller.php';" class="volver"></button></th>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Id tarea']; ?></th>
                        <td><?php echo $this -> fila['id_tarea']; ?></td>								
                    </tr>
                    <tr>
                        <th><?php echo $strings['Descripcion']; ?></th>
                        <td><?php echo $this -> fila['descripcion']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Fecha inicio']; ?></th>
                        <td><?php echo $this -> fila['Fecha_Ini']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Fecha fin']; ?></th>
                        <td><?php echo $this -> fila['Fecha_Fin']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Usuario']; ?></th>
                        <td><?php echo $this -> fila['USUARIOS_login']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Categoria']; ?></th>
                        <td><?php echo $this -> categorias['nombre']; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo $strings['Prioridad']; ?></th>
                        <td><?php echo $this -> prioridades['descripcion']; ?></td>
                    </tr>

                    <tr>
                        <th><button class="borrar-si" type="submit" name="action" value="Confirmar_DELETE2"></button></th>
                        <td><button class="borrar-no" type="submit" name="action" value=""></button></td>
                    </tr>            
                                                                            
                </table>
            </form>            
        </div>       
        
<?php    
    }
}
?>