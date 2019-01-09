<?php

    include_once '../Functions/Authentication.php';    
    
	class Categorias_SHOWCURRENT{
	 
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
			<form class="formShow" enctype="multipart/form-data" action="../Controllers/Categorias_Controller.php">
            <input type="hidden" name="id_CATEGORIAS" value= "<?php echo $this -> fila['id_CATEGORIAS'] ?>">	
            <table class="showU" style="margin-left: 30%;">

                <tr><th class="title" colspan="2"><?php echo $strings['Detalles']; ?>
                    <button onclick="location.href='../Controllers/Categorias_Controller.php';" class="volver"></button></th>
                </tr>
                <tr>
                    <th><?php echo $strings['ID categoria']; ?></th>
                    <td><?php echo $this -> fila['id_CATEGORIAS']; ?></td>								
                </tr>
                <tr>
                    <th><?php echo $strings['Nombre']; ?></th>
                    <td><?php echo $this -> fila['nombre']; ?></td>
                </tr>
                 
                                                                        
            </table>

        </div>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>