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
	 
		<h3>Datos de la pregunta a editar</h3> <br><br>
	
	 <?php
			if(isset($_GET['id'])){
				require_once('lib/nusoap.php');
				require_once('lib/class.wsdlcache.php');
			    $id = trim($_GET['id']);
				$soapclient = new nusoap_client('http://localhost/ObtenerPreguntaSW.php?wsdl', true);
				
				$result = $soapclient->call('ObtenerPregunta', array('id'=>$id));
				
				echo "<table style='width:100%'>";  
				echo "<tr>";  
				echo "<th>Enunciado</th>";  
				echo "<th>Correcta</th>";  
				echo "<th>Incorrectas</th>"; 
				echo "<th>Complejidad</th>"; 
				echo "<th>Tema</th>"; 
				echo "</tr>";  
				echo "<tr>";  
				echo "<td>".$result['enunciado']."</td>";  
				echo "<td>".$result['correcta']."</td>";  
				echo "<td>".$result['incorrecta1']."<br>".$result['incorrecta2']."<br>".$result['incorrecta3']."</td>";  
				echo "<td>".$result['complejidad']."</td>";  
				echo "<td>".$result['tema']."</td>";  
				echo "</tr>";  
				
				
			}
		?>	
		
	
   <table width="770" cellspacing="5" cellpadding="3" border="0" bgcolor="#4177BF"> 
	<tr> 
	   </font></td> 
	</tr> 
	<tr> 
   <td bgcolor="#F4ED8E"> 
   <font face="arial, verdana, helvetica"> 
   
	   <form id='fpreguntas' name='fpreguntas' action=<?php echo "'editarPregunta.php?id=".$_GET['id']."'"?> method="POST" enctype="multipart/form-data"> 
        <!------------------FORMULARIO PARA INSERTAR PREGUNTA--------------------------->
        <br>
			
		    <!------------------BOTONES----------------------------------------->
			
			
			
            Nuevo enunciado:
            <input type="text" name="enunciado" id="enunciado">
            <br><br>
			
			Respuesta correcta:
            <input type="text" name="correct" id="correct">
            <br><br>
			
            Respuesta incorrecta:
            <input type="text" name="incorrect1" id="incorrect1">
			<br><br>
			
			Respuesta incorrecta:
            <input type="text" name="incorrect2" id="incorrect2">
			<br><br>
			
			Respuesta incorrecta:
            <input type="text" name="incorrect3" id="incorrect3">
			<br><br>
			
			Complejidad(1..5):
            <input type="number" name="complejidad" id="complejidad" min="1" max="5">
			<br><br>
			
			Tema:
            <input type="text" name="tema" id="tema">
			<br><br>
		
			<font color='green'>Nota: No es obligatorio rellenar todos los campos, puedes editar los campos individualmente.</font>
            <br><br>
		    <!------------------BOTONES----------------------------------------->
            
            <input type="submit" name="enviar" value="Guardar cambios" id="enviar">
            <input type="reset" name="Resetear" value="Resetear" id="Resetear">
            <br><br>
            <br><br>
		 
        </form> 
		   </font> 
			
			<table  cellpadding="3" border="2px solid black"; style='width:100%' id="demo"></table>

          <!------------------PARTE DE PHP----------------------------------------->			
		  
		<?php
	
			if(isset($_POST['enunciado']) || isset($_POST['correct']) || isset($_POST['incorrect1']) || isset($_POST['incorrect2']) || isset($_POST['incorrect3']) || isset($_POST['complejidad']) || isset($_POST['tema'])){
				
				if(isset($_GET['id'])){
					require_once('lib/nusoap.php');
					require_once('lib/class.wsdlcache.php');
					$id = trim($_GET['id']);
					$soapclient = new nusoap_client('http://localhost/ObtenerPreguntaSW.php?wsdl', true);
					
					$result = $soapclient->call('ObtenerPregunta', array('id'=>$id));

					$servername = "localhost";
					$dbname = "quiz";
				}
				
				// Create connection
				$conn = mysqli_connect($servername,"root", "", $dbname);
				// Check connection
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}


						//ENUNCIADO
						if(trim($_POST['enunciado'])!="")
							$enunciado = trim($_POST['enunciado']);
						else
							$enunciado = $result['enunciado'];
						
						//CORRECTA
						if(trim($_POST['correct'])!="")
							$correct = trim($_POST['correct']);
						else
							$correct = $result['correcta'];
						
						//INCORRECTA 1
						if(trim($_POST['incorrect1'])!="")
							$incorrect1 = trim($_POST['incorrect1']);
						else
							$incorrect1 = $result['incorrecta1'];
						
						//INCORRECTA 2
						if(trim($_POST['incorrect2'])!="")
							$incorrect2 = trim($_POST['incorrect2']);
						else
							$incorrect2 = $result['incorrecta2'];
						//INCORRECTA 3
						
						if(trim($_POST['incorrect3'])!="")
							$incorrect3 = trim($_POST['incorrect3']);
						else
							$incorrect3 = $result['incorrecta3'];
						
						//COMPLEJIDAD
						if(trim($_POST['complejidad'])!="")
							$complejidad = trim($_POST['complejidad']);
						else
							$complejidad = $result['complejidad'];
						
						//TEMA
						if(trim($_POST['tema'])!="")
							$tema = trim($_POST['tema']);
						else
							$tema = $result['tema'];
						
		
						$emailRegEx = "/^([a-zA-Z])+[0-9][0-9][0-9]\@ikasle\.ehu\.(es|eus)$/";

						if ($enunciado!="" ||  $correct!="" || $incorrect1!="" || $incorrect2!="" ||  $incorrect3!="" ||  $complejidad!="" ||  $tema!="" ){
							
							    if ($complejidad < 1 || $complejidad > 5){
								   $complejidadErr = "La complejidad debe ser un valor entre 1 y 5"; 
								  echo $complejidadErr;					
								}else{
									
									$sql = "UPDATE preguntas SET Enunciado = '$enunciado', Correcta = '$correct' , Incorrecta1 = '$incorrect1', Incorrecta2 = '$incorrect2', Incorrecta3 = '$incorrect3', Complejidad = '$complejidad', Tema = '$tema'
									 WHERE id ='$id'";


									if (mysqli_query($conn, $sql)) {
										echo "<p id='preguntaIntro'>Pregunta editada correctamente! <a href='editarPregunta.php?id=".$id."'>Refresca</a> la página para ver los cambios </p>";
									} else {
										echo "Error: " . $sql . "<br>" . mysqli_error($conn);
									}

									
								}
							
						}else{
									
								$issetErr = "Debes rellenar al menos un campo"; 
								echo $issetErr;
						}

					
									
					mysqli_close($conn);
					
			}	
		
		?>	
			
   </td> 
</tr> 
</table>
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
	                	$.ajax({
            			 url: "restarcontador.php",
            			});
					alert("Hasta pronto, <?php echo $_SESSION['nick']; ?>") 
					});
					
		
    
		
	
		
	   </script>
	</div>
    </section>
	
</div>
</body>
</html>
