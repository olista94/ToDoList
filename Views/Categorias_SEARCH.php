<!-- FORMULARIO PARA BUSCAR CATEGORIAS
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

<?php
 //Declaracion de la clase 
    class Categorias_SEARCH {

//Variable con el enlace al form de SEARCH categoria
      var $enlace;

//Constructor de la clase
      function __construct($enlace){

        $this -> enlace = $enlace;
        $this->pinta();

      }
//Funcion que "muestra" el contenido de la página
      function pinta(){
         //Variable de idioma
        if(!isset($_SESSION['idioma'])){
            $_SESSION['idioma'] = 'SPANISH';
        }

//Archivo del idioma
        include '../Locales/Strings_'. $_SESSION['idioma'] .'.php';

        ?>
        <!--Formulario para buscar categoria-->
        <form class="formB" id="searchForm"  method="post" action="../Controllers/Categorias_Controller.php">
            <legend><?php echo $strings['Buscar categoria'];?>
            
            </legend>

			<!--Campo ID de la categoria-->
                <label ><?php echo $strings['ID categoria']; ?></label>
                <input type="text"  name="id_CATEGORIAS" size="5"/>
	
            <!--Campo nombre de la categoria-->
                <label ><?php echo $strings['Nombre']; ?></label>
                <input type="text"  name="nombre" size="45"/>
            
            
            <!--Boton de busqueda-->
            <button type="submit" name="action" value="Confirmar_SEARCH2" class="buscar"></button>

        </form>
            
        </body>
        </html>
        
        <?php
    
        }
    }
?>