<!DOCTYPE html>
<html>
<head>
<style>
	table, th, td {
		border: 1px solid black;
	}
</style>
</head>

		<?php
		$servername = "localhost";
		$dbname = "quiz";

		// Create connection
		$conn = mysqli_connect($servername,"root", "", $dbname);
		// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		//echo "<script>  alert('$conn') </script>";
		//$sql = "SELECT * FROM preguntas WHERE id ='' ORDER BY id ASC";

		$result = mysqli_query($conn, "SELECT * FROM preguntas WHERE id ORDER BY id ASC");


			echo "<table style='width:150%'>";  
			echo "<tr>";  
			echo "<th>Enunciado</th>";  
			echo "<th>Correcta</th>";  
			echo "<th>Incorrecta1</th>"; 
			echo "<th>Incorrecta2</th>"; 
			echo "<th>Incorrecta3</th>";  
			echo "<th>Complejidad</th>"; 
			echo "<th>Tema</th>"; 
			echo "</tr>";  
			while ($row = mysqli_fetch_row($result)){   
				echo "<tr>";  
				echo "<td>".$row[1]."</td>";  
				echo "<td>".$row[2]."</td>";  
				echo "<td>".$row[3]."</td>";  
				echo "<td>".$row[4]."</td>";
				echo "<td>".$row[5]."</td>";  	
				echo "<td>".$row[6]."</td>";  
				echo "<td>".$row[7]."</td>";  
				echo "</tr>";  
			}  

			echo "</table>"; 
		?>
		
	<input type="button" name="Volver" value="Volver a insertar preguntas" id="Volver">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
	<script>
	
	$("#Volver").click(function(){			
		window.location ="preguntaHTML5.html";		
		});
	
	</script>
		

</html>
