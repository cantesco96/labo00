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
											
						$foto=$_FILES["imagen"]["name"];
						$ruta=$_FILES["imagen"]["tmp_name"];
						$destino="imagenes/".$foto;
						if($ruta != "")
							copy($ruta,$destino);

						$sql = "INSERT INTO preguntas (Enunciado, Correcta, Incorrecta1, Incorrecta2, Incorrecta3, Complejidad, Tema, Imagen)
						VALUES ('$_POST[enunciado]', '$_POST[correct]', '$_POST[incorrect1]', '$_POST[incorrect2]', '$_POST[incorrect3]', '$_POST[complejidad]', '$_POST[tema]', '$destino')";


						if (mysqli_query($conn, $sql)) {
							echo "Pregunta introducida correctamente!";
						} else {
							echo "Error: " . $sql . "<br>" . mysqli_error($conn);
						}

						
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
		window.location ="verPreguntasConFoto.php";			
		});
	
	</script>
</html>