<?php

	
	if (isset($_POST['id'])){
		
		require_once('lib/nusoap.php');
	    require_once('lib/class.wsdlcache.php');
	
		$soapclient = new nusoap_client('http://localhost/ComprobarContrasena.php?wsdl', true);
		
		$result = $soapclient->call('ObtenerPregunta', array('id'=>trim($_POST['id'])));
		
		echo $result;
		
		
	}
?>
?>