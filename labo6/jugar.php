<!DOCTYPE html>

<?php 
	
	session_start(); 
	
	 if(isset($_SESSION["foto"])){
			echo "<script>";
			echo "window.location = 'layoutLogged.php'";
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
		<span><a href='layout.php'>Inicio</a></span><br><br>
		<span><a href='creditos.php'>Creditos</a></span><br><br>
	</nav>
    <section class="main" id="s1">
    
	<div>
	
	<button type="button" class="jugar" id="jugar" style="width:20%">Pedir Pregunta</button><br><br>
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
	<script>

    $("#jugar").click(function(){
	                	$.post(
						"jugarAJAX.php",
						{
            			 numero: 1
            			},
						 function(result){
						$("#pregunta").html(result);
							}
						
						);
					});

	</script>

     <span id='pregunta'></span>
	
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>
</body>
</html>
