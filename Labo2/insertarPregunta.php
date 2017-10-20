<!DOCTYPE html>
<html>

<?php
$servername = "localhost";
$dbname = "quiz";

// Create connection
$conn = mysqli_connect($servername,"root", "", $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/*$enunciado = $_POST['enunciado'];
$correct = $_POST['correct'];
$incorrect1 = $_POST['incorrect1'];
$incorrect2  = $_POST['incorrect2'];
$incorrect3  = $_POST['incorrect3'];
$complejidad = $_POST['complejidad'];
$tema = $_POST['tema'];*/


$sql = "INSERT INTO preguntas (Enunciado, Correcta, Incorrecta1, Incorrecta2, Incorrecta3, Complejidad, Tema)
VALUES ('$_POST[enunciado]', '$_POST[correct]', '$_POST[incorrect1]', '$_POST[incorrect2]', '$_POST[incorrect3]', '$_POST[complejidad]', '$_POST[tema]')";


if (mysqli_query($conn, $sql)) {
    echo "Pregunta introducida correctamente!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
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