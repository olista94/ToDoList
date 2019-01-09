<?php

    include_once '../Functions/Authentication.php';    
    
	class Prioridades_SHOWCURRENT{
	 
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
            <table class="showU" style="margin-left: 30%;">

                <tr><th class="title" colspan="4"><?php echo $strings['Detalles de la prioridad']; ?>
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
                                                                        
            </table>

        </div>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>