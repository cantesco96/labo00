<!DOCTYPE html>

<?php 
	
	session_start(); 
	
	 if(isset($_SESSION["foto"])){
			echo "<script>";
			echo "window.location = 'creditosLogged.php'";
			echo "</script>";
		}
?>


<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Preguntas</title>
    <link rel='stylesheet' type='text/css' href='estilos/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
		   
  <style>
  #nosotros {
    width:250px;
    border-radius:160px;
    border:10px solid #666;
     }
   </style>
  
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
		<span class="right"><a href="Registro.php">Registrarse</a></span>
      		<span class="right"><a href="Login.php">Login</a></span>
      		<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layout.html'>Inicio</a></span><br><br>
		<span><a href='creditos.html'>Creditos</a></span><br><br>
	</nav>
    <section class="main" id="s1">
    
	<div>
	Aplicación desarollada por <b>Unai Cantero</b> y <b>Julen Riesco</b> <br>
	<br>
	Estudiantes de grado en <b>ingeniería informática</b>.<br>
	<br>
	Especializados en <b>computación</b> e <b>ingeniería del software</b>.<br>
	<br>
	
	<img src="imagenes\nosotros.jpeg" alt="nosotros" id="nosotros">
	
	

	</div>
    </section>
	<footer class='main' id='f1'>
		<!--<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>-->
	</footer>
</div>
</body>
</html>
