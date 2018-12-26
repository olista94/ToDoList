<?php

    class Contactos_SEARCH {

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
        
        <form class="formB" id="searchForm" enctype="multipart/form-data" method="post" action="../Controllers/Contactos_Controller.php">
            <legend><?php echo $strings['Buscar prioridad'];?>
            <button onclick="location.href='../Controllers/Contactos_Controller.php';" class="volver"></button>
            </legend>


            <div class="form-group">
                <label for="nombre"><?php echo $strings['Nombre']; ?></label>
                <input type="text" id="nombre" name="nombre" maxlength="50" size="40"/>
            </div>
            <div class="form-group">
                <label for="email"><?php echo $strings['Correo electrónico']; ?></label>
                <input type="text" id="email" name="email" maxlength="50" size="40"/>
            </div>
            <div class="form-group">
                <label for="descripcion"><?php echo $strings['Descripcion']; ?></label>
                <input type="text" id="descripcion" name="descripcion" />
            </div>
            <div class="form-group">
                <label for="telefono"><?php echo $strings['Telefono']; ?></label>
                <input type="number" id="telefono" name="telefono" maxlength="11"/>
            </div>
            
            <button type="submit" name="action" value="Confirmar_SEARCH" class="buscar"></button>

        </form>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>