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
		    'complejidad' => array('name' => 'complejidad', 'type' => 'xsd:int'),
			)
	);
	
	
	$server->register('ObtenerPregunta', array('id'=>'xsd:int'), array('result'=>'tns:Pregunta'), $ns);
	
	
	function ObtenerPregunta($id) { 
				
				$result['enunciado']= "";
				$result['correcta']= "";
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
						$result['complejidad']= $row[6];

					}
						
				mysqli_close($conn);
				return $result;
	} 
	
	if (!isset( $HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
	$server->service($HTTP_RAW_POST_DATA); 
?> 