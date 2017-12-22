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
<b>Recuperación de contraseña</b> 
   </font></td> 
</tr> 
<tr> 
   <td bgcolor="#F4ED8E"> 
   <font face="arial, verdana, helvetica"> 
   <form id='recuperacion' name='recuperacion' action="recuperarContrasena.php" method="POST">
        
        <!------------------FORMULARIO PARA LOGUEARSE--------------------------->
        <br>
            
			 Introduce tu e-mail de recuperación*:
            <input type="text" name="email" id="email" required>
            <br><br>
					
		    <!------------------BOTONES----------------------------------------->
        
            <input type="submit" name="enviar" value="Enviar solicitud" id="enviar">
            <input type="reset" name="Resetear" value="Resetear" id="Resetear">
            <br><br>
			 <!------------------PARTE DEL SERVIDOR--------------------------->

			 
			
		<?php

		if(isset($_POST['email'])){

		
				$servername = "localhost";
				$dbname = "registro";
				// Create connection
				$conn = mysqli_connect($servername,"root", "", $dbname);
				// Check connection
				if (!$conn) {
					die("No se ha podido conectar con la base de datos: " . mysqli_connect_error());
				}
					
				
				$email= trim($_POST['email']);

				if ($email!=""){
					
							
							$sql = "SELECT * FROM registro WHERE email = '$email' ";
							$result=mysqli_query($conn, $sql);
                            $row = mysqli_fetch_row($result)
							
							if($row[0]==$email) {
								
								  // the message
								  
							      $explicacion = "Pasos para recuperar tu contraseña:\n\n 
													1-Entra en el link proporcionado.\n 
													2-Introduce el código proporcionado y la nueva contraseña.\n
													3-Si todo va bien la página te lo notificará y habrás cambiado tu contraseña.\n";
													
								 $link = "Link a la página de recuperación:\n
										 <a href='layout.html' id='layout'>Aquí</a>\n";
								 
								 $codigo = "Código de recuperación:\n
								 <h3>2514545554</h3>\n";

								$to = $email;
								$subject = "Recuperación de contraseña";
								$codigo = rand(10000, 99999);
								$message = "
								<html>
								<head>
								<title>Recuperación de contraseña</title>
								</head>
								<body>
								<h3>Pasos a realizar para recuperar tu contraseña:</h3>
								<ol>
								  <li>Entra en el link proporcionado.</li>
								  <li>Introduce el código proporcionado y la nueva contraseña.</li>
								  <li>Si todo va bien la página te lo notificará y habrás cambiado tu contraseña.</li>
								</ol> 
								<h3>Link a la página de recuperación:</h3>
								<h2><a href='layout.html' id='layout'>Aquí</a></h2>
								<h3>Código de recuperación:</h3>
								<h2>".$codigo."</h2>
								</body>
								</html>
								";

								// Always set content-type when sending HTML email
								$headers = "MIME-Version: 1.0" . "\r\n";
								$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

								mail($to,$subject,$message,$headers);


								echo "El e-mail se ha enviado correctamente.";
								  
								  
								}else{
									echo "Los datos introducidos son erroneos";
								}
								
							} else {
								echo "Debes rellenar todos los campos";
							}

							
						mysqli_close($conn);	
					
				}
				
			
		?>	
		 
		 
        </form> 
   </font> 
   </td> 
</tr> 
</table>
			<p> Cuando completes este formulario llegará un e-mail 
			     a la dirección de correo electrónico proporcionada.
			     Dicho correo incluirá las indicaciones necesarias 
				 para poder recuperar tu contraseña.</p>
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


