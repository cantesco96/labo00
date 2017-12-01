<?php

Session_start();
Session_destroy();
//Restamos uno al contador de personas.
$fich = 'contador.xml';
$xml = simplexml_load_file($fich);  
$xml->value-=1;
$xml->asXML($fich);  

header('Location: layout.php');



?>