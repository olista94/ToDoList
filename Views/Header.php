<!-- CABECERA Y MENU DE LA APLICACION (TANTO SI ES ADMIN COMO SI ES NORMAL)
CREADO POR: Los Cangrejas
Fecha: 20/12/2018-->

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
	<title>TopPadel</title>
	
	 <!--Archivos css,js...necesarios para el funcionamiento de la aplicacion-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
	<link rel="stylesheet" type="text/css" href="../Views/css/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript" src="../Views/js/validaciones.js"></script> 
	<script src="../Views/js/script.js"></script>
	<link rel="stylesheet" type="text/css" href="../Views/css/tcal.css" />
	<script type="text/javascript" src="../Views/js/tcal.js"></script>	

</head>

<?php
if(isset($_SESSION['tipo'])){//Si se loguea como ADMIN
	
?>

<header id="main-header">	

	<div class="fixednav">
		<div class="topnav">
			<div class="topnav-centered">
				<a><h2>TopPadel</h2></a>
			</div>

			<a class="alogo"><button class="logo"></button></a>

			<div class="topnav-right">
			
			
			
                <?php	
                    if (IsAuthenticated()){//Si esta autenticado
                ?>
				 <!--Login del usuario conectado-->
			<nav class="perfil"><ul>
				<li><?php echo $_SESSION['login'];?></a>
					
					<ul><li>
							<a href="../Controllers/Usuarios_Controller.php?action=Confirmar_SHOWCURRENT1"><?php echo $strings['Perfil']; ?></a>
						</li>
						<li>
							<a href="../Controllers/Tareas_Controller.php?action=Mostrar_Completas"><?php echo $strings['Hacerte socio']; ?></a>
						</li>
						<li class="cerrar">
							<a href='../Functions/Desconectar.php'><?php echo $strings['Cerrar sesion']; ?></a>
						</li>
					</ul>
				</li>
			</ul>
			</nav>				
				

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
					<input type="image" src="../Views/img/uk.png"  width="45px">
				</form>
				 <!--Al castellano-->
				<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:0; padding:0;">
					<input type="hidden" name='idioma' value="SPANISH" >
					<input type="image"  src="../Views/img/spain.png"  width="35px" >
				</form>
				 <!--Al gallego-->
				<form name='idioma' action="../Functions/CambioIdioma.php" method="POST" style="display: inline-block; margin:0; padding:0;">
					<input type="hidden" name='idioma' value="GALLAECIAN" >
					<input type="image"  src="../Views/img/galicia.png" width="35px">	
				</form>
			</div>
		
	</div>
 <!--Opciones del menu que puede gestionar si es ADMIN (todo)-->
	<div class="menu-bar" id="menu-bar">
		
		<li><a href="../Controllers/Usuarios_Controller.php"><?php echo $strings['Usuarios']; ?></a></li>
		<li><a href="../Controllers/Torneos_Controller.php"><?php echo $strings['Torneos']; ?></a></li>
		<li><a href="../Controllers/Pistas_Controller.php"><?php echo $strings['Pistas']; ?></a></li>
		<li><a href="../Controllers/Reservas_Controller.php"><?php echo $strings['Reservas']; ?></a></li>
		<li><a href="../Controllers/Promociones_Controller.php"><?php echo $strings['Promociones']; ?></a></li>
		
		<a href="javascript:void(0);" class="icon" onclick="responsiveMenu()">
			<i class="fa fa-bars"></i>
		</a>
	</div>

</header>

<?php
}
?>