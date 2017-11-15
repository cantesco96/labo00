<!DOCTYPE html>
<html>

<?php


if(isset($_POST['email']) & isset($_POST['enunciado']) & isset($_POST['correct']) & isset($_POST['incorrect1']) & isset($_POST['incorrect2']) & isset($_POST['incorrect3']) & isset($_POST['complejidad']) & isset($_POST['tema'])){
	
	
		$servername = "localhost";
		$dbname = "quiz";

		// Create connection
		$conn = mysqli_connect($servername,"root", "", $dbname);
		// Check connection
		if (!$conn) {
			die("No se ha podido conectar con la base de datos: " . mysqli_connect_error());
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
					
					//Insertar pregunta en la base de datos
					
					$sql = "INSERT INTO preguntas (Enunciado, Correcta, Incorrecta1, Incorrecta2, Incorrecta3, Complejidad, Tema)
					VALUES ('$_POST[enunciado]', '$_POST[correct]', '$_POST[incorrect1]', '$_POST[incorrect2]', '$_POST[incorrect3]', '$_POST[complejidad]', '$_POST[tema]')";


					if (mysqli_query($conn, $sql)) {
						echo "Pregunta introducida correctamente!";
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
				  //$xml->asXML($fich);
				  
			
				}
			
		}else{
					
			    $issetErr = "Debes rellenar todos los campos"; 
				echo $issetErr;
		}

		mysqli_close($conn);	
	}

		
		

?>	

    <input type="button" name="Volver" value="Volver" id="Volver">
	<input type="button" name="ver" value="Ver preguntas" id="ver">
	
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
	<script>
	
	$("#Volver").click(function(){			
		window.history.back();			
		});
	
	$("#ver").click(function(){			
		window.location ="verPreguntas.php";			
		});
	
	</script>
</html>