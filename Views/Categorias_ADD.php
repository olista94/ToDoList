 <?php
 
 class Categorias_ADD{	 

	var $enlace;	
	
	function __construct($enlace){
		
		$this -> enlace = $enlace;
		$this -> mostrar();
	}
	
	function mostrar(){
  
  if(!isset($_SESSION['idioma'])){
    $_SESSION['idioma'] = 'SPANISH';
  }

  include '../Locales/Strings_'. $_SESSION['idioma'] .'.php'; 
	 	 
?>

  <form name="Form" id="registerForm" action="../Controllers/Categorias_Controller.php" method="post"  >
    <legend><?php echo $strings['Formulario para añadir categoria']; ?>
    <button onclick="location.href='../Controllers/Categorias_Controller.php';" class="volver"></button>
    </legend>

    <div>	
      <label ><?php echo $strings['Nombre']; ?></label>
      <input type="text" id="nombre" name="nombre" size="50" >
      
      
      
    </div>
    
    <button type="submit" name="action" value="Confirmar_ADD2" class="aceptar"></button>
    <button type="reset" value="Reset" class="cancelar"></button>

	</form>
 
 
 <?php
  }
}
 ?>
