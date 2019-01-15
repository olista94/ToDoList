<?php
//Comprueba que esta autenticado
    include_once '../Functions/Authentication.php';    
      //Declaracion de la clase
	class Prioridades_DELETE{
	 //Datos de la prioridad
	var $datos;	
	var $fila;
	//Variable con el enlace al DELETE prioridad
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
			<form class="formShow" enctype="multipart/form-data" action="../Controllers/Prioridades_Controller.php">
            <!--Clave de la prioridad que se pasa como hidden al model-->
			<input type="hidden" name="nivel" value= "<?php echo $this -> fila['nivel'] ?>">	
            <table class="showU" style="margin-left: 30%;">

                <tr><th class="title" colspan="4"><?php echo $strings['Borrar prioridad']; ?>
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

				<tr>
					<!--Confirmar borrado-->
					<th><button class="borrar-si" type="submit" name="action" value="Confirmar_DELETE2"></button></th>
					<!--Cancelar borrado-->	
					<td><button class="borrar-no" type="submit" name="action" value=""></button></td>
                </tr>   
                                                                        
            </table>

        </div>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>