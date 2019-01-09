<?php

/*
 * Clase : LOTERIA_SHOWCURRENT
 * Vista para ver en detalle una participacion de loteria
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

    include_once '../Functions/Authentication.php';
    
    
    class LOTERIA_SHOWCURRENT {

        function __construct($loteria){
            
            $this->pinta($loteria);

        }


//función que pinta la vista
    function pinta($loteria){
        //comprueba si hay un idioma en $_SESSION
        //si no, inserta el idioma español
        if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
        ?>
            
        <div class="show-half">	
            <table class="showU" style="margin-left: 30%;">

                <tr><th class="title" colspan="4"><?php echo $strings['Ver Participación']; ?>
                    <button onclick="location.href='../Controllers/Loteria_Controller.php';" class="volver"></button></th>
                </tr>
                <tr>
                    <th><?php echo $strings['Id tarea']; ?></th>
                    <td><?php echo $loteria['lot.email']; ?></td>								
                </tr>
                <tr>
                    <th><?php echo $strings['Descripcion']; ?></th>
                    <td><?php echo $loteria['lot.nombre']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Fecha inicio']; ?></th>
                    <td><?php echo $loteria['lot.apellidos']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Fecha fin']; ?></th>
                    <td><?php echo $loteria['lot.participacion']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Usuario']; ?></th>
                    <td><?php echo $loteria['lot.ingresado']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Categoria']; ?></th>
                    <td><?php echo $loteria['lot.premiopersonal']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Prioridad']; ?></th>
                    <td><?php echo $loteria['lot.pagado']; ?></td>
                </tr>             
                                                                        
            </table>

        </div>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>