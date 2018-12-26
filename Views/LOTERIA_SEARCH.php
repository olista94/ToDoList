<?php

/*
 * Clase : LOTERIA_SEARCH 
 * Vista para buscar participaciones de loteria
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

    class LOTERIA_SEARCH {

        function __construct(){

            $this->pinta();

        }


//función que pinta la vista
    function pinta(){
        //comprueba si hay un idioma en $_SESSION
        //si no, inserta el idioma español
        if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';

        ?>
        
        <form class="formB" id="searchForm" enctype="multipart/form-data" method="post" action="../Controllers/Loteria_Controller.php">
            <legend>Búsqueda
            <button onclick="location.href='../Controllers/Loteria_Controller.php';" class="volver"></button>
            </legend>

            <div class="form-group">
                <label for="email"><?php echo $strings['Correo electrónico']; ?></label>
                <input type="text" id="email" name="email" maxlength="25" size="40"/>
            </div>	
            <div class="form-group">
                <label for="nombre"><?php echo $strings['Nombre']; ?></label>
                <input type="text" id="nombre" name="nombre" maxlength="50" size="40"/>
            </div>
            <div class="form-group">
                <label for="apellidos"><?php echo $strings['Apellidos']; ?></label>
                <input type="text" id="apellidos" name="apellidos" maxlength="25" size="40"/>
            </div>	
            <div class="form-group">
                <label for="participacion"><?php echo $strings['Participación']; ?></label>
                <input type="number" id="participacion" name="participacion"/>
            </div>
            <div class="form-group">
                <label for="resguardo"><?php echo $strings['Resguardo']; ?></label>
                <input type="text" id="resguardo" name="resguardo"/>
            </div>
            <div class="form-group">
                <label for="ingresado"><?php echo $strings['Ingresado']; ?></label>
                <select name="ingresado" id="ingresado">
                    <option label=" "></option>
                    <option value="SI"><?php echo $strings['Si']; ?></option>
                    <option value="NO"><?php echo $strings['No']; ?></option>
                </select> 
            </div>
            <div class="form-group">
                <label for="premiopersonal"><?php echo $strings['Premio personal']; ?></label>
                <input type="premiopersonal" id="premiopersonal" name="resguardo"/>
            </div>
            <div class="form-group">
                <label for="pagado"><?php echo $strings['Pagado']; ?></label>
                <select name="pagado" id="pagado">
                    <option label=" "></option>
                    <option value="SI"><?php echo $strings['Si']; ?></option>
                    <option value="NO"><?php echo $strings['No']; ?></option>
                </select> 
            </div>
            
            <button type="submit" name="action" value="SEARCH" class="buscar"></button>

        </form>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>