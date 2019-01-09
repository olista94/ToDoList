<?php

    include_once '../Functions/Authentication.php';    
    
	class Tareas_SHOWCURRENT{
	 
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

    function mostrar(){
        
        if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
        ?>
            
        <div class="show-half">	
            <table class="showU" style="margin-left: 30%;">

                <tr><th class="title" colspan="4"><?php echo $strings['Detalles de la tarea']; ?>
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
                                                                        
            </table>

        </div>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>