<!-- TABLA QUE MUESTRA LOS DATOS DE UNA PRIORIDAD
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

<?php
//Comprueba que esta autenticado
    include_once '../Functions/Authentication.php';    
    //Declaracion de la clase
	class Prioridades_SHOWCURRENT{
	 //Datos de la prioridad 
	var $datos;	
	var $fila;
	//Variable con el enlace al SHOWCURRENT prioridad
	var $enlace;
	//Constructor de la clase
	function __construct($datos,$enlace){

		$this -> datos = $datos;
		$this -> enlace = $enlace;
		$this -> fila = $this -> datos -> fetch_array();
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
             <!--Tabla con los datos de la prioridad-->
        <div class="show-half">	
            <table class="showU" style="margin-left: 30%;">

                <tr><th class="title" colspan="4"><?php echo $strings['Detalles de la prioridad']; ?>
					<!--Boton para volver atras-->
				  <button onclick="location.href='../Controllers/Prioridades_Controller.php';" class="volver"></button></th>
                </tr>
				<!--Campo nivel de la prioridad-->
                <tr>
                    <th><?php echo $strings['Nivel']; ?></th>
                    <td><?php echo $this -> fila['nivel']; ?></td>								
                </tr>
				<!--Campo descripcion de la prioridad-->
                <tr>
                    <th><?php echo $strings['Descripcion']; ?></th>
                    <td><?php echo $this -> fila['descripcion']; ?></td>
                </tr>
				<!--Campo color de la prioridad-->
                <tr>
                    <th><?php echo $strings['Color']; ?></th>
                    <td><?php echo $this -> fila['color']; ?></td>
                </tr>
                                                                        
            </table>

        </div>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>