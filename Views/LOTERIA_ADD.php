<?php

/*
 * Clase : LOTERIA_ADD 
 * Vista para añadir participaciones de loteria
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

    class LOTERIA_ADD {

        function __construct(){

            $this->pinta();

        }


//función que pinta la vista
    function pinta(){

        if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';
        
        ?>
            <section>
                    
            <div class="form">

                <form name="registerForm" id="registerForm" method="post" enctype="multipart/form-data" action="../Controllers/Loteria_Controller.php" onsubmit="return comprobarFormulario(this)">
                    <legend><?php echo $strings['Añadir participación de lotería']; ?> 
                        <button onclick="location.href='../Controllers/Loteria_Controller.php';" class="volver"></button>
                    </legend>
                    

                    <div>	
                        <label for="emailuser"><?php echo $strings['Correo electrónico']; ?></label>
                        <input type="email" name="email" id="email" size="40" maxlength="60" onchange="comprobarEmail(this,60)" required/>	
                            
                        <label for="nombre"><?php echo $strings['Nombre']; ?></label>
                        <input type="text" name="nombre" id="nombre" size="40" maxlength="30" onchange="comprobarAlfabetico(this,30)" required/>
                        
                        <label for="apellidos"><?php echo $strings['Apellidos']; ?></label>
                        <input type="text" name="apellidos" id="apellidos" size="40" maxlength="40" onchange="comprobarAlfabetico(this,40)" required/>
                        
                        <label for="participacion"><?php echo $strings['Participación']; ?></label>
                        <input type="number" name="participacion" id="participacion" size="40" min='1' max='999' onchange="comprobarEntero(this,1,999)" required/>
                        
                        <label for="resguardo"><?php echo $strings['Resguardo']; ?></label>
                        <input type="file" name="resguardo" id="resguardo" size="40" maxlength="50" required/>
                        
                        <label for="ingresado"><?php echo $strings['Ingresado']; ?></label>
                        <select name="ingresado" id="ingresado">
                            <option value="SI"><?php echo $strings['Si']; ?></option>
                            <option selected value="NO"><?php echo $strings['No']; ?></option>
                        </select>                        
                        
                    </div>

                <button type="submit" name="action" value="ADD" value="Submit" class="aceptar"></button>
                <button type="reset" value="Reset" class="cancelar"></button>

                </form>               

            </div>
        </body>
        </html>
        
        <?php
    
        }
    }
?>