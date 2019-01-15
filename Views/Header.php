<?php

 
 //Comprueba si esta autenticado
	include_once '../Functions/Authentication.php';
	if (!isset($_SESSION['idioma'])) {
		$_SESSION['idioma'] = 'SPANISH';
	}
	else{
	}
	include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';
?>

<script>
idioma = "<?php echo $_SESSION['idioma']; ?>"; //Variable global que permite pasar el idioma seleccionado al archivo JavaScript
</script>

<html>
<head>
	<title>ET4</title>
	
	 <!--Archivos css,js...necesarios para el funcionamiento de la aplicacion-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" type="text/css" href="../Views/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="../js/validaciones.js"></script> 
	<script src="../js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="../Views/tcal.css" />
	<script type="text/javascript" src="../js/tcal.js"></script>	

</head>

<?php
if(isset($_SESSION['tipo'])){//Si se loguea como ADMIN
	if($_SESSION['tipo']=='ADMIN'){
?>

<header id="main-header">	

	<div class="fixednav">
		<div class="topnav">
			<div class="topnav-centered">
				<a><h2><?php echo $strings['ToDoList']; ?></h2></a>
			</div>

			<a class="alogo"><button class="logo"></button></a>

			<div class="topnav-right">
			
			
			
                <?php	
                    if (IsAuthenticated()){//Si esta autenticado
                ?>
				 <!--Login del usuario conectado-->
				<button class="user"><?php echo $_SESSION['login'];?></button>				   		
				<!--Desconectar-->
				<a href='../Functions/Desconectar.php'><button class="logout"></button></a>

                <?php                    
                    }
                    else{
                ?>
				 <!--Si no esta logueado muestra un boton para ir al registro-->
                    <a href='../Controllers/Registro_Controller.php'><button class="registrar"></button></a>
                <?php
                    }	
                ?>
				 <!--Banderas para cambiar el idioma-->
			</div>
			 <!--Al ingles-->
			<div class="flags1" >
				<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:0; padding:0;">
					<input type="hidden" name='idioma' value="ENGLISH">
					<input type="image" src="../img/uk.png"  width="45px">
				</form>
				 <!--Al castellano-->
				<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:0; padding:0;">
					<input type="hidden" name='idioma' value="SPANISH" >
					<input type="image"  src="../img/spain.png"  width="35px" >
				</form>
				 <!--Al gallego-->
				<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:0; padding:0;">
					<input type="hidden" name='idioma' value="GALLAECIAN" >
					<input type="image"  src="../img/galicia.png" width="35px">	
				</form>
			</div>
		
	</div>
 <!--Opciones del menu que puede gestionar si es ADMIN (todo)-->
	<div class="menu-bar" id="menu-bar">
		<li><a class="dropdownElm" onclick="dropdown()"><?php echo $strings['Tareas']; ?></a>
			<nav class="dropdownContent" id="myDropdown">
				<a href="../Controllers/Tareas_Controller.php?action=default"><?php echo $strings['Todas']; ?></a>
				<a href="../Controllers/Tareas_Controller.php?action=Mostrar_Completas"><?php echo $strings['Completas']; ?></a>
				<a href="../Controllers/Tareas_Controller.php?action=Mostrar_NoCompletas"><?php echo $strings['Sin completar']; ?></a>
			</nav>
		</li>
		<li><a href="../Controllers/Prioridades_Controller.php"><?php echo $strings['Prioridades']; ?></a></li>
		<li><a href="../Controllers/Usuarios_Controller.php"><?php echo $strings['Usuarios']; ?></a></li>
		<li><a href="../Controllers/Contactos_Controller.php"><?php echo $strings['Contactos']; ?></a></li>
		<li><a href="../Controllers/Categorias_Controller.php"><?php echo $strings['Categorias']; ?></a></li>
		

		
		<a href="javascript:void(0);" class="icon" onclick="responsiveMenu()">
			<i class="fa fa-bars"></i>
		</a>
	</div>

</header>

<?php
	}
	else{//Si se loguea como un usuario normal
		?>
		
		<header id="main-header">	

	<div class="fixednav">
		<div class="topnav">
			<div class="topnav-centered">
				<a><h2><?php echo $strings['ToDoList']; ?></h2></a>
			</div>

			<a class="alogo"><button class="logo"></button></a>

			<div class="topnav-right">
                <?php	
                    if (IsAuthenticated()){//Si esta autenticado
                ?>
				 <!--Login del usuario conectado-->
				<button class="user"><?php echo $_SESSION['login'];?></button>				   		
				<!--Desconectar-->
				<a href='../Functions/Desconectar.php'><button class="logout"></button></a>

                <?php                    
                    }
                    else{
                ?>
				    <!--Si no esta logueado muestra un boton para ir al registro--> 
                    <a href='../Controllers/Registro_Controller.php'><button class="registrar"></button></a>
                <?php
                    }	
                ?>
				
			</div>
<!--Banderas para cambiar el idioma-->
		
			<div class="flags1" >
			 <!--Al ingles-->
				<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:0; padding:0;">
					<input type="hidden" name='idioma' value="ENGLISH">
					<input type="image" src="../img/uk.png"  width="45px">
				</form>
				 <!--Al castellano-->
				<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:0; padding:0;">
					<input type="hidden" name='idioma' value="SPANISH" >
					<input type="image"  src="../img/spain.png"  width="35px" >
				</form>
				 <!--Al gallego-->
				<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:0; padding:0;">
					<input type="hidden" name='idioma' value="GALLAECIAN" >
					<input type="image"  src="../img/galicia.png" width="35px">	
				</form>
			</div>

		</div>
	</div>
 <!--Opciones del menu que puede gestionar si no es ADMIN (gestion de sus tareas y fases y añadir usuarios)-->
	<div class="menu-bar" id="menu-bar">
		<li><a class="dropdownElm" onclick="dropdown()"><?php echo $strings['Tareas']; ?></a>
			<nav class="dropdownContent" id="myDropdown">
				<a href="../Controllers/Tareas_Controller.php?action=default"><?php echo $strings['Todas']; ?></a>
				<a href="../Controllers/Tareas_Controller.php?action=Mostrar_Completas"><?php echo $strings['Completas']; ?></a>
				<a href="../Controllers/Tareas_Controller.php?action=Mostrar_NoCompletas"><?php echo $strings['Sin completar']; ?></a>
			</nav>
		</li>
		<li><a href="../Controllers/Contactos_Controller.php"><?php echo $strings['Contactos']; ?></a></li>
		<a href="javascript:void(0);" class="icon" onclick="responsiveMenu()">
			<i class="fa fa-bars"></i>
		</a>
	</div>

</header>
		
<?php
}
}
?>