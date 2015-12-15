<?php
interface gestioneTrattative{

	function approvaTrattativa($id);
	function assegnaTrattativa($id,$agente);
	function creaTrattativa( $acquirente, $agente, $immobile, $approvata);
	function eliminaTrattativa($id);
	function visualizzaTrattativa($id);
	function getTrattative();
}

?>