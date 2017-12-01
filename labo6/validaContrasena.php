<?php

	
	if (isset($_POST['pass'])){
		
		require_once('lib/nusoap.php');
	    require_once('lib/class.wsdlcache.php');
	
		$soapclient = new nusoap_client('http://localhost/ComprobarContrasena.php?wsdl', true);
		
		$result = $soapclient->call('comprobar', array('pass'=>trim($_POST['pass'])));
		
		echo $result;
		
		
	}
?>