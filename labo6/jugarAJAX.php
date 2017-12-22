
<!DOCTYPE html>

 <?php
   
   $servername = "localhost";
   $dbname = "quiz";

   // Create connection
   $conn = mysqli_connect($servername,"root", "", $dbname);
		// Check connection
    if (!$conn) {
	     die("Connection failed: " . mysqli_connect_error());
	}
			
	
		$result = mysqli_query($conn, "SELECT * FROM preguntas ORDER BY RAND()");
        $row = mysqli_fetch_row($result);
		$numrows = mysqli_fetch_row($result);
		$contestado=0;
		$correctas =0;
		$row = mysqli_fetch_row($result);
		    $id=$row[0];
			$enunciado= $row[1];
		    $correcta= $row[2];
			$incorrecta1= $row[3];
			$incorrecta2= $row[4];
		    $incorrecta3= $row[5];
			$complejidad= $row[6];
			$tema= $row[7];
			$numbers= range(2,5);
			shuffle($numbers);
			echo "<h2>".$enunciado."</h2><br><br>";
			
			echo "<form id='form' name='fpreguntas' action= ''  method='POST'>
					  <input type='radio' name='respuesta' value='".$row[$numbers[0]]."' id='respuesta1' checked>".$row[$numbers[0]]."</input><br><br>
					  <input type='radio' name='respuesta' value='".$row[$numbers[1]]."' id='respuesta2'>".$row[$numbers[1]]."</input><br><br>
					  <input type='radio' name='respuesta' value='".$row[$numbers[2]]."' id='respuesta3'>".$row[$numbers[2]]."</input><br><br>
					  <input type='radio' name='respuesta' value='".$row[$numbers[3]]."' id='respuesta4'>".$row[$numbers[3]]."</input><br><br>
					  <input type='submit' name='enviar' value='Responder' id='enviar'>
				</form>";
				
		
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
       
        $("#enviar").on('click', function(){
            var respuesta=$("input:radio[name=respuesta]:checked").val();
			var id= <?php echo $id; ?>;
			$.post(
						"comprobarRespuestaAJAX.php",
						{
            			 respuesta: respuesta,
						 id : id
            			},
						 function(result){
							alert(result);
						}
						
				);
        });

</script>

