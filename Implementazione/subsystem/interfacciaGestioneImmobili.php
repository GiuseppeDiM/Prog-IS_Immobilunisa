<?php
interface gestioneImmobili{

	function approvaImmobile($id);
	function assegnaImmobile($id,$agente);
	function creaImmobile( $approvato, $tipoContratto, $descrizione, $proprietario, $immagine, $metratura, $prezzo, $tipo,$comune);
	function cancellaImmobile($id);
	function modificaImmobile($id, $approvato, $agente, $tipoContratto, $descrizione, $proprietario, $immagine, $metratura, $prezzo, $tipo,$comune);
	function visualizzaImmobile($id);
	function getImmobili();
}

?>