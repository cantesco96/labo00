 <?php
 
   $servername = "localhost";
   $dbname = "quiz";

   // Create connection
   $conn = mysqli_connect($servername,"root", "", $dbname);
		// Check connection
    if (!$conn) {
	     die("Connection failed: " . mysqli_connect_error());
	}
			
	if(isset($_POST['respuesta'])){
		$respuesta = $_POST['respuesta'];
		$id = $_POST['id'];
		$result = mysqli_query($conn, "SELECT * FROM preguntas WHERE id='$id'");
		$row = mysqli_fetch_row($result);
		if($row[2]==$respuesta){
			echo "¡Respuesta correcta!";	
		}else{
			
			echo "Incorrecto";	
		}
		
	}
	
?>