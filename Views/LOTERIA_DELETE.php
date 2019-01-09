<?php

/*
 * Clase : LOTERIA_DELETE 
 * Vista para borrar participaciones de loteria
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

    class LOTERIA_DELETE {

        function __construct($loteria){

            //if(!is_string($user))
            //$user = $user->fetch_array();
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
            <form class="formShow" enctype="multipart/form-data" action="../Controllers/Loteria_Controller.php" method="post"> 
            <table class="showU" style="margin-left: 40%;">
                
                <input type="hidden" name="email" value="<?php echo $loteria['lot.email']; ?>">
                
                <tr><th class="title" colspan="4"><?php echo $strings['Borrar participación']; ?>
                    <button onclick="location.href='../Controllers/Loteria_Controller.php';" class="volver"></button>
                </th></tr>
                <tr>
                    <th><?php echo $strings['Email']; ?></th>
                    <td><?php echo $loteria['lot.email']; ?></td>								
                </tr>
                <tr>
                    <th><?php echo $strings['Nombre']; ?></th>
                    <td><?php echo $loteria['lot.nombre']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Apellidos']; ?></th>
                    <td><?php echo $loteria['lot.apellidos']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Participacion']; ?></th>
                    <td><?php echo $loteria['lot.participacion']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Resguardo']; ?></th>
                    <td><?php echo $loteria['lot.resguardo']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Ingresado']; ?></th>
                    <td><?php echo $loteria['lot.ingresado']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Premio personal']; ?></th>
                    <td><?php echo $loteria['lot.premiopersonal']; ?></td>
                </tr>
                <tr>
                    <th><?php echo $strings['Pagado']; ?></th>
                    <td><?php echo $loteria['lot.pagado']; ?></td>
                </tr>

                <tr>
                    <th><button class="borrar-si" name="action" value="DELETE"></button></th>
                    <td><button class="borrar-no" name="action" value=""></button></td>
                </tr>            
                                                                        
            </table>
            </form>
            
        </div>
        
        </div>    
        
        </body>
        </html>
        
        <?php
    
        }
    }
?>