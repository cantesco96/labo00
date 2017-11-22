<!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	
	function getParameterByName(name, url) {
		if (!url) url = window.location.href;
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
		
	    
     }
	
	</script>
	<style>
	  #nosotros {
		width:250px;
		border-radius:160px;
		border:10px solid #666;
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
		<h3> Hola, <script> document.write(getParameterByName("nick")) </script> </h3>
		<img id="fotoPerfil"><br>
		<span class="right"><a href="layout.html" id="logout">Logout</a></span>
      		<span class="right" style="display:none;"><a href="/logout" id="logout">Logout</a></span>
		<h2>Quiz: el juego de las preguntas</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href='' id="layout">Inicio</a></span><br><br>
		<span><a href='' id="pregunta">Insertar Preguntas</a></span><br><br>
		<span><a href='' id="preguntaHTML5">Insertar pregunta con HTML5</a></span><br><br>
		<span><a href='' id="creditos">Creditos</a></span><br><br>
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
   
	   <form id='fpreguntas' name='fpreguntas' action="ObtenerPreguntaCliente.php" method="POST" enctype="multipart/form-data">
        
        <!------------------FORMULARIO PARA INSERTAR PREGUNTA--------------------------->
        <br>
			Personas editando en este mometo: <h3 id="personas"></h3>  <br><br>
			
			Indica el ID de la pregunta*:
            <input type="number" name="preguntaID" id="complejidad" required>
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

			if(isset($_POST['preguntaID'])){
				require_once('lib/nusoap.php');
				require_once('lib/class.wsdlcache.php');
			
				$soapclient = new nusoap_client('http://localhost/ObtenerPreguntaSW.php?wsdl', true);
				
				$result = $soapclient->call('ObtenerPregunta', array('id'=>trim($_POST['preguntaID'])));
				
				echo "<p>Enunciado de la pregunta: ".$result['enunciado']."</p>";
				echo "<p>Respuesta correcta :".$result['correcta']."</p>";
				echo "<p>Complejidad :".$result['complejidad']."</p>";
			}
		?>	

			
   </td> 
</tr> 
</table>
	<script>
	     var nick= getParameterByName("nick");
		 var email= getParameterByName("email");
		 var fotoPerfil=getParameterByName("foto");
		 var preguntaURL= "pregunta.html?logged=si&nick=" + nick+ "&email=" + email + "&foto=" + fotoPerfil; 
		 var preguntaHTML5URL= "preguntaHTML5.html?logged=si&nick=" + nick+ "&email=" + email + "&foto=" + fotoPerfil; 
		 var preguntaHTML5URL= "preguntaHTML5.html?logged=si&nick=" + nick+ "&email=" + email + "&foto=" + fotoPerfil; 
		 var gestionURL=  "GestionPreguntas.php?logged=si&nick=" + nick+ "&email=" + email + "&foto=" + fotoPerfil; 
		 var creditosURL= "creditosLogged.html?nick=" + nick + "&email=" + email + "&foto=" + fotoPerfil;
		 var layoutURL=  "layoutLogged.html?nick=" + nick + "&email=" + email + "&foto=" + fotoPerfil;
		 $("#pregunta").attr("href", preguntaURL);
		 $("#preguntaHTML5").attr("href", preguntaHTML5URL);
		 $("#gestion").attr("href", gestionURL);
		 $("#layout").attr("href", layoutURL);
		 $("#creditos").attr("href", creditosURL);
		 $("#email").attr("value", email);
		 if(fotoPerfil != "" & fotoPerfil != null){
		   $("#fotoPerfil").attr("src", fotoPerfil);
		   $("#fotoPerfil").attr("height", "80");
		  
		 }
		 
	
	 
	 
	 
	 $("#logout").click(function(){
					alert("Hasta pronto, " + nick) 
					});
	
	
		
		
		
		
	   </script>
	</div>
    </section>
	
</div>
</body>
</html>
