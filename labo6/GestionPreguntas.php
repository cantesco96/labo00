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
		
		if($_SESSION["logged"]=="profesor"){
			echo "<script>";
			echo "alert('Un profesor no puede acceder a esta funcionalidad');";
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
		<span><a href='' id="gestion">Gestionar preguntas</span><br>
		<span><a href='creditosLogged.php' id="creditos">Creditos</a></span><br><br>
	</nav>
    <section class="main" id="s1">
	<div>

	<table width="770" cellspacing="5" cellpadding="3" border="0" bgcolor="#4177BF"> 
		<tr> 
		   <td><font color="#FFFFFF" face="arial, verdana, helvetica"> 
			<b> Preguntas Totales/Mis preguntas</b> 
		   </font></td> 
		</tr>
		<tr>
		<td bgcolor="#F4ED8E"> 
			<h3 id= 'preguntastot'></h3><br>
			
            <button type="button" onclick="loadDoc()">Mostrar preguntas</button>
			<button type="button" id= "Ocultar">Ocultar preguntas</button>
		</td> 
       </tr> 
       <br>
	   
	</table>
	
	<br>
	
	<table width="770" cellspacing="5" cellpadding="3" border="0" bgcolor="#4177BF"> 
	<tr> 
	   <td><font color="#FFFFFF" face="arial, verdana, helvetica"> 
		<b>Datos de la pregunta</b> 
	   </font></td> 
	</tr> 
	<tr> 
   <td bgcolor="#F4ED8E"> 
   <font face="arial, verdana, helvetica"> 
   
     
	   <form id='fpreguntas' name='fpreguntas' action= <?php $t=time(); echo "'GestionPreguntas.php?t=".$t."'"; ?>  method="POST" enctype="multipart/form-data">
        
        <!------------------FORMULARIO PARA INSERTAR PREGUNTA--------------------------->
        <br>
			Personas editando en este mometo: <h3 id="personas"></h3>  <br><br>
		    
             E-mail*:
            <input type="email" name="email" id="email"  pattern="[a-zA-Z]+[0-9]{3}@ikasle\.ehu\.(es|eus)" placeholder="ej: nombre123@ikasle.ehu.es" readonly required>
			<br><br>
			
			
			Enunciado de la pregunta*:
            <input type="text" name="enunciado" id="enunciado" required>
            <br><br>
			
			 Respuesta correcta*:
            <input type="text" name="correct" id="correct"  required>
            <br><br>
			
            Respuesta incorrecta*:
            <input type="text" name="incorrect1" id="incorrect1"  required>
			<br><br>
			
			Respuesta incorrecta*:
            <input type="text" name="incorrect2" id="incorrect2"  required>
			<br><br>
			
			Respuesta incorrecta*:
            <input type="text" name="incorrect3" id="incorrect3"  required>
			<br><br>
			
			Complejidad(1..5)*:
            <input type="number" name="complejidad" id="complejidad" min="1" max="5"  required>
			<br><br>
			
			Tema:
            <input type="text" name="tema" id="tema" required>
			<br><br>
		
			Inserta una imagen:
			<input type="file" name="imagen" id="imagen" onchange="subirImg()">
			<br><br>
			<img id="imagen2">
			<br><br>
		    <!------------------BOTONES----------------------------------------->
        
            <input type="submit" name="enviar" value="Enviar solicitud" id="enviar">
            <input type="reset" name="Resetear" value="Resetear" id="Resetear">
            <br><br>
		    
		 
        </form> 
		   </font> 
			
			<table  cellpadding="3" border="2px solid black"; style='width:100%' id="demo"></table>

          <!------------------PARTE DE PHP----------------------------------------->			
		  
		  <?php
		  
	
			if(isset($_POST['email']) & isset($_POST['enunciado']) & isset($_POST['correct']) & isset($_POST['incorrect1']) & isset($_POST['incorrect2']) & isset($_POST['incorrect3']) & isset($_POST['complejidad']) & isset($_POST['tema'])){
				


				$servername = "localhost";
				$dbname = "quiz";

				// Create connection
				$conn = mysqli_connect($servername,"root", "", $dbname);
				// Check connection
				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}



						$email = trim($_POST['email']);
						$enunciado = trim($_POST['enunciado']);
						$correct = trim($_POST['correct']);
						$incorrect1 = trim($_POST['incorrect1']);
						$incorrect2  = trim($_POST['incorrect2']);
						$incorrect3  = trim($_POST['incorrect3']);
						$complejidad = trim($_POST['complejidad']);
						$tema = trim($_POST['tema']);
						$emailRegEx = "/^([a-zA-Z])+[0-9][0-9][0-9]\@ikasle\.ehu\.(es|eus)$/";

						if ($email!="" &  $enunciado!="" &  $correct!="" &  $incorrect1!="" &  $incorrect2!="" &  $incorrect3!="" &  $complejidad!="" &  $tema!="" ){
							
								if (!preg_match($emailRegEx,$email)) {
								  $emailErr = "El email debe seguir el siguiente patrón: ejemplo123@ikasle.ehu.es"; 
								  echo $emailErr;
								}else if ($complejidad < 1 | $complejidad > 5){
								   $complejidadErr = "La complejidad debe ser un valor entre 1 y 5"; 
								  echo $complejidadErr;					
								}else{
									$t=time();		
									$foto=$_FILES["imagen"]["name"];
									$ruta=$_FILES["imagen"]["tmp_name"];
									$destino="imagenes/".$t.$foto;
									if($ruta != "")
										copy($ruta,$destino);

									$sql = "INSERT INTO preguntas (Enunciado, Correcta, Incorrecta1, Incorrecta2, Incorrecta3, Complejidad, Tema, Imagen)
									VALUES ('$_POST[enunciado]', '$_POST[correct]', '$_POST[incorrect1]', '$_POST[incorrect2]', '$_POST[incorrect3]', '$_POST[complejidad]', '$_POST[tema]', '$destino')";


									if (mysqli_query($conn, $sql)) {
										echo "<p id='preguntaIntro'>Pregunta introducida correctamente!</p>";
									} else {
										echo "Error: " . $sql . "<br>" . mysqli_error($conn);
									}
									
									//Insertar pregunta en el fichero XML
								
									  $fich = 'preguntas.xml';
									  $xml = simplexml_load_file($fich);
									  
									  $pregunta = $xml->addChild('assessmentItem');
									  $pregunta->addAttribute("complexity", $complejidad);
									  $pregunta->addAttribute("subject", $tema);
									  $pregunta->addAttribute("author", $email);
									  $pregunta->addChild("itemBody");
									  $pregunta->itemBody->addChild("p",$enunciado);
									  $pregunta->addChild("correctResponse");
									  $pregunta->correctResponse->addChild("value",$correct);
									  $pregunta->addChild("incorrectResponses");
									  $pregunta->incorrectResponses->addChild("value", $incorrect1);
									  $pregunta->incorrectResponses->addChild("value", $incorrect2);
									  $pregunta->incorrectResponses->addChild("value", $incorrect3);
									  $xml->asXML($fich);
									  

									
								}
							
						}else{
									
								$issetErr = "Debes rellenar todos los campos"; 
								echo $issetErr;
						}

					
									
					mysqli_close($conn);
					
			}	
		
		?>	

			
   </td> 
</tr> 
</table>
	<script>
	var emailActual = "<?php echo $_SESSION["email"] ?>"
	  $("#email").val(emailActual);			
	  
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
	 
	 //Poner el email del actual usuario
	 
	 
	 
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
					
		
     $("#Resetear").click(function(){				
		$("#imagen2").hide();    				
		});
   

    $("#Ocultar").click(function(){				
		$("#demo").hide();    				
		});
		
		
		
	//**************************************************FUNCIONES PARA CONTAR PREGUNTAS TOTALES/PROPIAS**************************************
		function loadDoc2() {	
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  myFunction2(this);
			}
		  };
		  xhttp.open("GET", "preguntas.xml", true);
		  xhttp.send();
		}
		
		function myFunction2(xml) {
			
		  var i;
		  var mispreguntas = 0;
		  var emailActual= "<?php echo $_SESSION["email"] ?>";
		  var xmlDoc = xml.responseXML;
		  var x = xmlDoc.getElementsByTagName("assessmentItem");
		  for (i = 0; i < x.length; i++) {
			var autor =  x[i].getAttribute("author");
			if(autor == emailActual)
				mispreguntas++
		  }
		  var lag = x.length + "/" + mispreguntas;
		  document.getElementById("preguntastot").innerHTML = lag;
		}
	
		loadDoc2();
		setInterval("loadDoc2()", 20000);
		
		
		
   
	//*******************************************************FUNCIONES PARA MOSTRAR LAS PREGUNTAS***********************************************************
		function loadDoc() {
		  $("#preguntaIntro").hide(); 
		  $("#demo").show();    	
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  myFunction(this);
			}
		  };
		  xhttp.open("GET", "preguntas.xml", true);
		  xhttp.send();
		}
		function myFunction(xml) {
		  var i;
		  var xmlDoc = xml.responseXML;
		  var table="<tr bgcolor='#4177BF'><th>Enunciado</th><th>Correctas</th><th>incorrectas</th><th>Tema</th><th>Complejidad</th><th>Autor</th></tr>";
		  var x = xmlDoc.getElementsByTagName("assessmentItem");
		  for (i = 0; i < x.length; i++) {
		  //Conseguir los elementos necesarios para la tabla:
		    var itemBody= x[i].getElementsByTagName("itemBody");
			var correctResponse =  x[i].getElementsByTagName("correctResponse");
			var incorrectResponses =  x[i].getElementsByTagName("incorrectResponses")[0].getElementsByTagName("value");
			var incorrect= new Array();
		  //Conseguimos todas las respuestas incorrectas.
			for (j = 0; j < incorrectResponses.length; j++) {
				incorrect[j]=incorrectResponses[j].childNodes[0].nodeValue;
			}
			var complejidad =  x[i].getAttribute("complexity");
			var autor =  x[i].getAttribute("author");
			var tema =  x[i].getAttribute("subject");
			
		 //Formar la tabla con los elementos obtenidos
			
            table += "<tr><td>" + itemBody[0].getElementsByTagName("p")[0].childNodes[0].nodeValue + "</td><td>" 
			                    +correctResponse[0].getElementsByTagName("value")[0].childNodes[0].nodeValue + "</td><td>" 
								+incorrect[0] + "<br><br>" + incorrect[1] + "<br><br>" + incorrect[2] + "<br<br>" + "</td><td>" 
								+tema + "</td><td>" 
								+complejidad + "</td><td>" 
								+autor + "</td><td>" + "</td></tr>";
		  }
		  document.getElementById("demo").innerHTML = table;
		}
			
			
		//*******************************************************FUNCIONES PARA RECUPERAR LAS PERSONAS EDITANDO******************************************
			
		function loadContador() {	
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  contador(this);
			}
		  };
		  xhttp.open("GET", "contador.xml", true);
		  xhttp.send();
		}
		
		function contador(xml) {
		  var xmlDoc = xml.responseXML;
		  var personas = xmlDoc.getElementsByTagName("contador")[0].getElementsByTagName("value")[0].childNodes[0].nodeValue;
		  document.getElementById("personas").innerHTML = personas;
		}
	   
	    loadContador();
		setInterval("loadContador()", 5000);
		
	   </script>
	</div>
    </section>
	
</div>
</body>
</html>
