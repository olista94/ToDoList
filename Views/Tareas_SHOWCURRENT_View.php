<!-- TABLA QUE MUESTRA LOS DATOS DE UNA TAREA
CREADO POR: Los Cangrejas
Fecha: 29/12/2018-->


<?php
 	 //Comprueba que esta autenticado
    include_once '../Functions/Authentication.php';    
     //Declaracion de la clase 
	class Tareas_SHOWCURRENT{
//Datos de la tarea	
	var $fila;
	//Prioridad de la tarea
	var $prioridades;
	//Categoria de la tarea
	var $categorias;
	//Variable con el enlace a la tabla showcurrent
	var $enlace;
	//Constructor de la clase	
	function __construct($fila,$prioridades,$categorias,$enlace){

		$this -> fila = $fila -> fetch_array();

		$this -> prioridades = $prioridades -> fetch_array();
		$this -> categorias = $categorias -> fetch_array();
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
            
		<!--Tabla con los datos de la tarea-->    	
        <div class="show-half">	
            <table class="showU" style="margin-left: 30%;">

                <tr><th class="title" colspan="4"><?php echo $strings['Detalles de la tarea']; ?>
					<!--Boton para volver atrás -->
				   <button onclick="location.href='../Controllers/Tareas_Controller.php';" class="volver"></button></th>
                </tr>
				<!--Campo ID de la tarea-->
                <tr>
                    <th><?php echo $strings['Id tarea']; ?></th>
                    <td><?php echo $this -> fila['id_tarea']; ?></td>								
                </tr>
				<!--Campo descripcion de la tarea-->
                <tr>
                    <th><?php echo $strings['Descripcion']; ?></th>
                    <td><?php echo $this -> fila['descripcion']; ?></td>
                </tr>
				<!--Campo fecha inicio de la tarea-->
                <tr>
                    <th><?php echo $strings['Fecha inicio']; ?></th>
                    <td><?php echo $this -> fila['Fecha_Ini']; ?></td>
                </tr>
				<!--Campo fecha fin de la tarea-->
                <tr>
                    <th><?php echo $strings['Fecha fin']; ?></th>
                    <td><?php echo $this -> fila['Fecha_Fin']; ?></td>
                </tr>
				<!--Usuario que creo la tarea-->
                <tr>
                    <th><?php echo $strings['Usuario']; ?></th>
                    <td><?php echo $this -> fila['USUARIOS_login']; ?></td>
                </tr>
				<!--Categoria de la tarea-->
                <tr>
                    <th><?php echo $strings['Categoria']; ?></th>
                    <td><?php echo $this -> categorias['nombre']; ?></td>
                </tr>
				<!--Prioridad de la tarea-->
                <tr>
                    <th><?php echo $strings['Prioridad']; ?></th>
                    <td><?php echo $this -> prioridades['descripcion']; ?></td>
                </tr>             
                                                                        
            </table>

        </div>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>