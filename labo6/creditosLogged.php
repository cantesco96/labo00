<!DOCTYPE html>
<html>
  <head>
  <?php 
	session_start(); 
	 if(!isset($_SESSION["foto"])){
			echo "<script>";
			echo "alert('Debes loguearte para acceder a esta función.');";
			echo "window.location = 'Login.php'";
			echo "</script>";
		}
	
	?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
		<h3> Hola, <script> document.write(<?php echo "'".$_SESSION['nick']."'"; ?>); </script> </h3>
			<img id="fotoPerfil"><br>
      		<span class="right"><a href="logout.php" id="logout">Logout</a></span>
      		<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layoutLogged.php' id="layout">Inicio</a></span><br><br>
		<span>
				<?php 
				$t=time();
				if ($_SESSION["logged"] == "profesor")
					echo '<a href="RevisarPreguntas.php">Revisar preguntas</a>';
				else
					echo '<a href="GestionPreguntas.php?t='.$t.'"id="gestion">Gestionar preguntas</a>';
				?>
		
				</span><br><br>
		<span><a href='creditosLogged.php' id="creditos">Creditos</a></span><br><br>
	</nav>
	<script>
	
	 //Poner la foto de perfil en caso de que haya
	<?php 
	   $fotoPerfil=$_SESSION["foto"];
	   if($fotoPerfil != "" & $fotoPerfil != null){
		   echo '$("#fotoPerfil").attr("src", "'.$fotoPerfil.'");';
		   echo '$("#fotoPerfil").attr("height", "80");';
		 }
		
	  ?>
	 //Despedirse cuando se vaya y restar uno al contador
	 $("#logout").click(function(){
	                	
					alert("Hasta pronto, <?php echo $_SESSION['nick']; ?>") 
					});
	
	
	
	</script>
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
