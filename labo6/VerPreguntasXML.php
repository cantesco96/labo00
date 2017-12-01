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
		
		
			echo "<table style='width:100%'>";  
			echo "<tr>";  
			echo "<th>Enunciado</th>";  
			echo "<th>Complejidad</th>"; 
			echo "<th>Tema</th>"; 
			echo "</tr>";  
			$xml=simplexml_load_file("preguntas.xml");
			foreach($xml->assessmentItem as $pregunta){   
				echo "<tr>";  
				echo "<td>".$pregunta->itemBody->p."</td>";  
				echo "<td>".$pregunta['complexity']."</td>";  
				echo "<td>".$pregunta['subject']."</td>";  
				echo "</tr>";  
			
			}

			echo "</table>"; 
		?>
		
	<input type="button" name="Volver" value="Volver a insertar preguntas" id="Volver">
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
	<script>
	
	$("#Volver").click(function(){			
		window.history.go(-2);		
		});
	
	</script>
		

</html>
