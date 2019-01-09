<?php

    include_once '../Functions/Authentication.php';    
    
	class Prioridades_DELETE{
	 
	var $datos;	
	var $fila;
	var $enlace;
	
	function __construct($datos,$enlace){

		$this -> datos = $datos;
		$this -> enlace = $enlace;
		$this -> fila = $this -> datos -> fetch_array();
		$this -> mostrar();

	}

    function mostrar(){
        
        if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
        ?>
            
        <div class="show-half">
			<form class="formShow" enctype="multipart/form-data" action="../Controllers/Prioridades_Controller.php">
            <input type="hidden" name="nivel" value= "<?php echo $this -> fila['nivel'] ?>">	
            <table class="showU" style="margin-left: 30%;">

                <tr><th class="title" colspan="4"><?php echo $strings['Borrar prioridad']; ?>
                    <button onclick="location.href='../Controllers/Prioridades_Controller.php';" class="volver"></button></th>
                </tr>
                <tr>
                    <th><?php echo $strings['Nivel']; ?></th>
                    <td><?php echo $this -> fila['nivel']; ?></td>								
                </tr>
                <tr>
                    <th><?php echo $strings['Descripcion']; ?></th>
                    <td><?php echo $this -> fila['descripcion']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Color']; ?></th>
                    <td><?php echo $this -> fila['color']; ?></td>
                </tr>

				<tr>
					<th><button class="borrar-si" type="submit" name="action" value="Confirmar_DELETE2"></button></th>
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