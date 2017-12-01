<?php 
	
	
	require_once('lib/nusoap.php'); 
	require_once('lib/class.wsdlcache.php');
	
	
	
	$ns = "http://localhost/ObtenerPreguntaSW.php?wsdl";   
	$server = new soap_server; 
	$server->configureWSDL('ObtenerPregunta',$ns); 
	$server->wsdl->schemaTargetNamespace = $ns;
	
	$server->wsdl->addComplexType(
		'Pregunta',
		'complexType',
		'struct',
		'all',
		'',
		array(
		    'enunciado' => array('name' => 'enunciado', 'type' => 'xsd:string'),
		    'correcta' => array('name' => 'correcta', 'type' => 'xsd:string'),
			'incorrecta1' => array('name' => 'incorrecta1', 'type' => 'xsd:string'),
			'incorrecta2' => array('name' => 'incorrecta2', 'type' => 'xsd:string'),
			'incorrecta3' => array('name' => 'incorrecta3', 'type' => 'xsd:string'),
		    'complejidad' => array('name' => 'complejidad', 'type' => 'xsd:int'),
			'tema' => array('name' => 'incorrecta3', 'type' => 'xsd:string'),
			)
	);
	
	
	$server->register('ObtenerPregunta', array('id'=>'xsd:int'), array('result'=>'tns:Pregunta'), $ns);
	
	
	function ObtenerPregunta($id) { 
				
				$result['enunciado']= "";
				$result['correcta']= "";
				$result['incorrecta1']= "";
				$result['incorrecta2']= "";
				$result['incorrecta3']= "";
				$result['tema']= "";
				$result['complejidad']=0;
				
		        $servername = "localhost";
				$dbname = "quiz";
				// Create connection
				$conn = mysqli_connect($servername,"root", "", $dbname);
				// Check connection
				if (!$conn) {
					die("No se ha podido conectar con la base de datos: " . mysqli_connect_error());
				}
				
				$query =  mysqli_query($conn, "SELECT * FROM preguntas WHERE id = $id");
				if(mysqli_num_rows($query) > 0) {
					    $row = mysqli_fetch_array($query);
						$result['enunciado']= $row[1];
						$result['correcta']= $row[2];
						$result['incorrecta1']= $row[3];
						$result['incorrecta2']= $row[4];
						$result['incorrecta3']= $row[5];
						$result['complejidad']= $row[6];
						$result['tema']= $row[7];

					}
						
				mysqli_close($conn);
				return $result;
	} 
	
	if (!isset( $HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
	$server->service($HTTP_RAW_POST_DATA); 
?> 