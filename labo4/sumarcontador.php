<?php 
		  $fich = 'contador.xml';
		  $xml = simplexml_load_file($fich);  
		  $xml->value+=1;
		  $xml->asXML($fich);  
		  ?>	