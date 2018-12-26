<?php

/*
 * Clase : LOTERIA_EDIT 
 * Vista para editar participaciones de loteria
 * Autor: yq5lj9
 * Fecha: 30/11/2018
 */

    class LOTERIA_EDIT {

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
            <section>
                        
            <div class="form">

                <form name="registerForm" id="registerForm" method="post" action="../Controllers/Loteria_Controller.php" enctype="multipart/form-data" onsubmit="return comprobarFormularioEdit(this)">
                    <legend><?php echo $strings['Editar participación de lotería']; ?>
                        <button onclick="location.href='../Controllers/Loteria_Controller.php';" class="volver"></button>
                    </legend>

                    <div>	
                        <label for="email"><?php echo $strings['Correo electrónico']; ?></label>
                        <input type="email" id="email" name="email" size="40" value="<?php echo $loteria['lot.email']; ?>" maxlength="60" onchange="comprobarEmail(this,60)" readonly/>	
                            
                        <label for="nombre"><?php echo $strings['Nombre']; ?></label>
                        <input type="text" name="nombre" id="nombre" value="<?php echo $loteria['lot.nombre']; ?>" size="40" maxlength="30" onchange="comprobarAlfabetico(this,30)"/>
                        
                        <label for="apellidos"><?php echo $strings['Apellidos']; ?></label>
                        <input type="text" name="apellidos" id="apellidos" value="<?php echo $loteria['lot.apellidos']; ?>" size="40" maxlength="40" onchange="comprobarAlfabetico(this,40)"/>
                        
                        <label for="participacion"><?php echo $strings['Participación']; ?></label>
                        <input type="number" name="participacion" id="participacion" value="<?php echo $loteria['lot.participacion']; ?>" size="40" min="1" max="999" onchange="comprobarEntero(this,1,999)"/>
                        
                        <label for="resguardo"><?php echo $strings['Resguardo']; ?></label>
                        <input type="file" id="resguardo" name="resguardo" size="40" maxlength="50"/>

                        <input type="text" name="resguardoEdit" hidden value="<?php echo $loteria['lot.resguardo']; ?>" />
                        
                        <label for="ingresado"><?php echo $strings['Ingresado']; ?></label>
                        <select name="ingresado" id="ingresado">                       
                            <?php if ($loteria['lot.ingresado']=="SI"){ ?>
                                <option value="SI" selected><?php echo $strings['Si']; ?></option>
                                <option value="NO"><?php echo $strings['No']; ?></option>
                            <?php 
                            } else if ($loteria['lot.ingresado']=="NO"){ ?>
                                <option value="SI"><?php echo $strings['Si']; ?></option>
                                <option value="NO" selected><?php echo $strings['No']; ?></option>
                            <?php
                            } ?>

                        </select> 
                                
                        <label for="premiopersonal"><?php echo $strings['Premio personal']; ?></label>
                        <input type="number" name="premiopersonal" id="premiopersonal" value="<?php echo $loteria['lot.premiopersonal']; ?>" size="40" min="0" max="999999" onchange="comprobarEntero(this,0,999999)"/>
                        
                        <label for="pagado"><?php echo $strings['Pagado']; ?></label>
                        <select name="pagado" id="pagado">                       
                            <?php if ($loteria['lot.pagado']=="SI"){ ?>
                                <option value="SI" selected><?php echo $strings['Si']; ?></option>
                                <option value="NO"><?php echo $strings['No']; ?></option>
                            <?php 
                            } else if ($loteria['lot.pagado']=="NO"){ ?>
                                <option value="SI"><?php echo $strings['Si']; ?></option>
                                <option value="NO" selected><?php echo $strings['No']; ?></option>
                            <?php
                            } ?>

                        </select> 
                        
                    </div>

                <button type="submit" name="action" value="EDIT" value="Submit" class="aceptar"></button>
                <button type="reset" value="Reset" class="cancelar"></button>

                </form>               

                </div>

                

            </div>
        </body>
        </html>
        
        <?php
    
        }
    }
?>