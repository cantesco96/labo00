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
	
	if($_SESSION["logged"]=="alumno"){
			echo "<script>";
			echo "alert('Un alumno no puede acceder a esta funcionalidad.');";
			echo "window.location = 'layoutLogged.php'";
			echo "</script>";
			
		}
	?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<style>
		table {
			font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
		}

		td, th {

			
			padding: 8px;
		}

	    tr:nth-child(even){background-color: #4177BF;}

		tr:hover {background-color: #ccffff;}

		 th {
			
			text-align: center;
			background-color: #F4ED8E;
			color: black;
		}
   </style>
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
		<h3> Hola, <script> document.write(<?php echo "'".$_SESSION['nick']."'"; ?>) </script> </h3>
		<img id="fotoPerfil"><br>
		<span class="right"><a href="logout.php" id="logout">Logout</a></span>
      		<span class="right" style="display:none;"><a href="/logout" id="logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='layoutLogged.php' id="layout">Inicio</a></span><br><br>
		<span><a href='RevisarPreguntas.php' id="gestion">Revisar preguntas</span><br>
		<span><a href='creditosLogged.php' id="creditos">Creditos</a></span><br><br>
	</nav>
    <section class="main" id="s1">
	<div>
	
	
   <font face="arial, verdana, helvetica"> 
   
     
	   <?php
		$servername = "localhost";
		$dbname = "quiz";

		// Create connection
		$conn = mysqli_connect($servername,"root", "", $dbname);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		//echo "<script>  alert('$conn') </script>";
		//$sql = "SELECT * FROM preguntas WHERE id ='' ORDER BY id ASC";

		$result = mysqli_query($conn, "SELECT * FROM preguntas WHERE id ORDER BY id ASC");


			echo "<table style='width:100%'>";  
			echo "<tr>";  
			echo "<th>Enunciado</th>";  
			echo "<th>Correcta</th>";  
			echo "<th>Incorrectas</th>"; 
			echo "<th>Complejidad</th>"; 
			echo "<th>Tema</th>"; 
			echo "</tr>";  
			while ($row = mysqli_fetch_row($result)){   
				echo "<tr>";  
				echo "<td>".$row[1]."</td>";  
				echo "<td>".$row[2]."</td>";  
				echo "<td>".$row[3]."<br>".$row[4]."<br>".$row[5]."</td>";  
				echo "<td>".$row[6]."</td>";  
				echo "<td>".$row[7]."</td>";  
				echo "<td><a href='editarPregunta.php?id=".$row[0]."' id='layout'>Editar</a></td>";  
				echo "</tr>";  
			}  

			echo "</table>"; 
		?>
		
		  </font> 
	
	<script>
	
	function subirImg(){
		var input = document.getElementById("imagen");
		var reader = new FileReader();
		reader.onload = function(){
		  var dataURL = reader.result;
		  var imagen2 =  document.getElementById("imagen2");
		  imagen2.setAttribute("src", dataURL);
		  imagen2.setAttribute("width", "135");
		  imagen2.setAttribute("height", "135");
		};
		reader.readAsDataURL(input.files[0]);

	 }
	 
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
	</div>
    </section>
	
</div>
</body>
</html>
