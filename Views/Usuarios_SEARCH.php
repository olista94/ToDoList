<?php

    class Usuarios_SEARCH {

      var $enlace;

      function __construct($enlace){

        $this -> enlace = $enlace;
        $this->pinta();

      }

      function pinta(){
        
        if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';

        ?>
        
        <form class="formB" id="searchForm" enctype="multipart/form-data" method="post" action="../Controllers/Usuarios_Controller.php">
            <legend><?php echo $strings['Buscar usuario'];?>
            <button onclick="location.href='../Controllers/Usuarios_Controller.php';" class="volver"></button>
            </legend>

            <input hidden type="text" id="password" name="password" maxlength="25" size="40"/>
            <div class="form-group">
                <label for="login"><?php echo $strings['Login']; ?></label>
                <input type="text" id="login" name="login" />
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
                <label for="dni"><?php echo $strings['DNI']; ?></label>
                <input type="text" id="dni" name="dni" />
            </div>	
            <div class="form-group">
                <label for="email"><?php echo $strings['Correo electrónico']; ?></label>
                <input type="text" id="email" name="email" maxlength="50" size="40"/>
            </div>
            <div class="form-group">
                <label for="fecha"><?php echo $strings['Fecha de nacimiento']; ?></label>
                <input type="text" id="fecha" name="fecha" />
            </div>
            <div class="form-group">
                <label for="telefono"><?php echo $strings['Telefono']; ?></label>
                <input type="text" id="telefono" name="telefono" maxlength="11"/>
            </div>	
		<div class="form-group">
		<label for="tipo"><?php echo $strings['Tipo']; ?></label>
		<input type="text" id="tipo" name="tipo"/>
           </div>  
		   
            <button type="submit" name="action" value="Confirmar_SEARCH" class="buscar"></button>

        </form>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>
