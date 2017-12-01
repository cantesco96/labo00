<!DOCTYPE html>
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
		<span><a href='layout.html' id="layout">Inicio</a></span><br><br>
		<span><a href='creditos.html' id="creditos">Creditos</a></span><br><br>
	</nav>
    <section class="main" id="s1">
    
	<div>

	   
	
	<table width="770" cellspacing="5" cellpadding="3" border="0" bgcolor="#4177BF"> 
<tr> 
   <td><font color="#FFFFFF" face="arial, verdana, helvetica"> 
<b>Datos del usuario</b> 
   </font></td> 
</tr> 
<tr> 
   <td bgcolor="#F4ED8E"> 
   <font face="arial, verdana, helvetica"> 
   <form id='fregistro' name='fregistro' action="Login.php" method="POST">
        
        <!------------------FORMULARIO PARA LOGUEARSE--------------------------->
        <br>
            
			 Introduce tu e-mail*:
            <input type="text" name="email" id="email" required>
            <br><br>
			
            Introduce tu contraseña*:
            <input type="password" name="pass" id="pass" required>
			<br><br>
		
		    <!------------------BOTONES----------------------------------------->
        
            <input type="submit" name="enviar" value="Enviar solicitud" id="enviar">
            <input type="reset" name="Resetear" value="Resetear" id="Resetear">
            <br><br>
			 <!------------------PARTE DEL SERVIDOR--------------------------->
			<a href='Registro.php' id="login2">¿Aún no estás registrado?</a>
		<?php

		if(isset($_POST['email']) & isset($_POST['pass'])){
			  
			   
				$servername = "localhost";
				$dbname = "registro";
				// Create connection
				$conn = mysqli_connect($servername,"root", "", $dbname);
				// Check connection
				if (!$conn) {
					die("No se ha podido conectar con la base de datos: " . mysqli_connect_error());
				}
					
				
				$email= trim($_POST['email']);
				$contraseña = trim($_POST['pass']);

				if ($email!="" &  $contraseña!=""){
					
						
							
							$sql = "SELECT * FROM registro WHERE email = '$email' ";
							$result=mysqli_query($conn, $sql);
                             
							if($result) {
								
								$row = mysqli_fetch_row($result);
								if($row[3]==$contraseña){
								  session_start();
								  if (strpos($email, '@ehu.es') !== false)
									 $_SESSION["logged"] = "profesor";
								  else
									   $_SESSION["logged"] = "alumno";
									  
								  
								  $_SESSION["email"] = $row[0];
								  $_SESSION["foto"] = $row[4];
								  $_SESSION["nick"] = $row[2];
								  
								  //Sumamos uno al contador de personas.
			                      $fich = 'contador.xml';
                        		  $xml = simplexml_load_file($fich);  
                        		  $xml->value+=1;
                        		  $xml->asXML($fich);  
								  
								  //Le damos la bienvenida al usuario recién logueado.
								  echo "<script> alert('Bienvenido, ".$row[2]."') </script>";
								  header("Location: layoutLogged.php");
								  
								}else{
									echo "Los datos introducidos son erroneos";
								}
								
							} else {
								echo "Los datos introducidos son erroneos";
							}

							
						
					
				}else{
							
						$issetErr = "Debes rellenar todos los campos";
						echo $issetErr;
				}
				
				mysqli_close($conn);
			}
		?>	
		 
		 
        </form> 
   </font> 
   </td> 
</tr> 
</table>
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
	   
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
					
			   $("#Resetear").click(function(){
					
					$("#imagen2").hide();    
					
					});
					
		</script>	
	</div>
    </section>
	<footer class='main' id='f1'>
		<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
		<a href='https://github.com'>Link GITHUB</a>
	</footer>
</div>

</body>
</html>


