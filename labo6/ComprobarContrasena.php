<?php 
	

	require_once('lib/nusoap.php'); 
	require_once('lib/class.wsdlcache.php');
	
	$ns = "http://localhost/ComprobarContrasena.php?wsdl";   
	$server = new soap_server; 
	$server->configureWSDL('comprobar',$ns); 
	$server->wsdl->schemaTargetNamespace = $ns;
	
	$server->register('comprobar', array('pass'=>'xsd:string'), array('response'=>'xsd:string'), $ns);
	
	function comprobar($pass) { 
		$file = file_get_contents("toppasswords.txt");
		if(strpos($file, $pass) == false) {
			
    		return "VALIDA";
    	} else {
    		
			return "INVALIDA";
    	}
	} 

	if (!isset( $HTTP_RAW_POST_DATA)) $HTTP_RAW_POST_DATA = file_get_contents('php://input');
	$server->service($HTTP_RAW_POST_DATA); 
?> 