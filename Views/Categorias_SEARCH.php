<?php

    class Categorias_SEARCH {

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
        
        <form class="formB" id="searchForm"  method="post" action="../Controllers/Categorias_Controller.php">
            <legend><?php echo $strings['Buscar categoria'];?>
            
            </legend>

            
                <label ><?php echo $strings['Nombre']; ?></label>
                <input type="text"  name="nombre" size="45"/>
            
            
            
            <button type="submit" name="action" value="Confirmar_SEARCH2" class="buscar"></button>

        </form>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>