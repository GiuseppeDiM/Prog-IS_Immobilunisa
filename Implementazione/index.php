<?php

include_once("subsystem/funzioni.php");
include_once("subsystem/facadeImmobili.php");
include_once("subsystem/immobile.php");

	$f=new FacadeGestioneImmobili();
	$view="";
	$view = file_get_contents('index.html');

		
	$immobili=$f->getImmobili();
	$stringa="<form method='GET' action='indexCliente.php' ><div id='catalogo' >";
	foreach($immobili as $value){
		if($value->getApprovato()!=0){
			$temp=$value->getId();
			$metratura=$value->getMetratura();
			$contratto=$value->getContratto();
			$immagine=$value->getImmagine();
			$stringa=$stringa."<div id=$temp name='immobile'><img src=$immagine width=80 height=80></img><br>Metratura: $metratura <br>Contratto:".$contratto."</div>"."<br>";
			}
	}
	$stringa=$stringa."</div></form>";
	  $view_xhtml_valorizzata = str_replace('{CATALOGO}',$stringa,$view);
	echo $view_xhtml_valorizzata;
	
?>