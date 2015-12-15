<?php
	interface gestioneAccount{
		function registraAgente($cod,$nome,$data,$email,$telefono,$username,$password);
		function eliminaAgente($cod);
		function visualizzaAgente($cod);
		function modificaAgente($oldCod,$newCod,$nome,$data,$email,$telefono,$username,$password);
		function getAgenti();
		function registraCliente($cod,$nome,$data,$email,$telefono,$username,$password);
		function eliminaCliente($cod);
		function visualizzaCliente($cod);
		function modificaCliente($oldCod,$newCod,$nome,$data,$email,$telefono,$username,$password);
		function getUtenti();
	
	}

?>