<?php 
		  $fich = 'contador.xml';
		  echo "alert('me ejecuto')";
		  $xml = simplexml_load_file($fich);  
		  $xml->value-=1;
		  $xml->asXML($fich);  
		  ?>	