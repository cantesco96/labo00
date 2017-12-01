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
		<span><a href='layout.html'>Inicio</a></span><br><br>
		<span><a href='pregunta.html'>Insertar Preguntas</a></span><br><br>
		<span><a href='preguntaHTML5.html'>Insertar pregunta con HTML5</a></span><br><br>
		<span><a href='creditos.html'>Creditos</a></span><br><br>
		
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
   <form id='fregistro' name='fregistro' action="pruebaServiciosWeb.php" method="POST" target="_blank">
        
        <!------------------FORMULARIO PARA REGISTRARSE--------------------------->
        <br>
             E-mail*:
             <input type="text" class="frmInput" name="email" id="email" required>	
			 <font id= "usuarioVIP"></font>
			<br><br>
			<br><br>
			
		    Introduce tu contraseña*:
            <input type="password" name="pass" id="pass" required>
			<font id= "contraseñaVal"></font>
			<br><br>
			<br><br>
		
		    <!------------------BOTONES----------------------------------------->
        
            <input type="submit" name="enviar" value="Enviar solicitud" id="enviar">
            <input type="reset" name="Resetear" value="Resetear" id="Resetear">
            <br><br>
			 <!------------------PARTE DEL SERVIDOR--------------------------->
		 
        </form> 
   </font> 
   </td> 
</tr> 
</table>


		
		
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>  
	   
	   <script>
	   
	   //**************************************************PARTE DE LOS SERVICIOS WEB*******************************************
	         var usuarioVIP=false;
	        $("#email").change(function(){         
					var parametro = {"email" : $("#email").val()};
					$.ajax({
						  data: parametro,
						  url: "validaEmail.php",
						  type: "post",
						  success:  function (response) {
							  if(response=="SI"){
								  $("#usuarioVIP").attr("color", "green");
								  $("#usuarioVIP").text("e-mail válido");
								  usuarioVIP=true;  
							  }else{
								  $("#usuarioVIP").attr("color", "red");
								  $("#usuarioVIP").text("e-mail inválido");
								  usuarioVIP=false;
							  }
                          }
					});				
				});
				
			var contraseñaVal=false;
			 $("#pass").change(function(){         
					var parametro = {"pass" : $("#pass").val()};
					$.ajax({
						  data: parametro,
						  url: "validaContrasena.php",
						  type: "post",
						  success:  function (response) {
							  if(response=="VALIDA"){
								  $("#contraseñaVal").attr("color", "green");
								  $("#contraseñaVal").text("contraseña válida");
								  contraseñaVal=true;  
							  }else{
								  $("#contraseñaVal").attr("color", "red");
								  $("#contraseñaVal").text("contraseña inválida");
								  contraseñaVal=false;
							    }
							  }
                          });
					});				
			
			
			
			$("#enviar").click(function(){
				   if(usuarioVIP && contraseñaVal){
					   return(true);
				   }else{
					   alert("El e-mail y la contraseña deben ser válidos para continuar.")
					   return(false);
				   }
			});
				
	   
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


