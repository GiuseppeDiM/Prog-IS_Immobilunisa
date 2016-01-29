<?php
	include_once("database.php");
	include_once("utente.php");
	/**
	 * Class: Immobile
	 * Description: Classe che implementa un immobile
	 * @version 1.0
	 * @created 10-gen-2016 17:39:15
	 */
	class Immobile{

		var $database;			//riferimento all'istanza del database utilizzato
		var $id;
		var $approvato;			//valore booleano 0=non approvato 1=approvato
		var $descrizione;
		var $contratto;			
		var $immagine;			//URL locale dell'immagine sul server
		var $metratura;			//misura in metri quadrati
		var $prezzo;
		var $proprietario;
		var $tipo;
		var $agente;
		var $comune;
		
		/**
		 * Function: Immobile
		 * Description: Costruttore della classe Immobile
		 * @param
		 */ 
		function Immobile(){
			$this->database=new Database();
			$approvato=false;
		}
		
		//***********************METODI DI ACCESSO***********************//
		function getId(){
			return $this->id;
		}
		function getApprovato(){
			return $this->approvato;
		}
		function getAgente(){
			return $this->agente;
		}
		function getDescrizione(){
			return $this->descrizione;
		}
		function getContratto(){
			return $this->contratto;
		}
		function getImmagine(){
			return $this->immagine;
		}
		function getMetratura(){
			return $this->metratura;
		}
		function getPrezzo(){
			return $this->prezzo;
		}
		function getProprietario(){
			return $this->proprietario;
		}
		function getTipo(){
			return $this->tipo;
		}
		function getComune(){
			return $this->comune;
		}
		//***********************METODI MODIFICATORI***********************//
		function setApprovato($approvato){
			$this->approvato=$approvato;
		}
		function setId($id){
			$this->id=$id;
		}
		function setAgente($agente){
			$this->agente=$agente;
		}
		function setDescrizione($descrizione){
			$this->descrizione=$descrizione;
		}
		function setContratto($contratto){
			$this->contratto=$contratto;
		}
		function setImmagine($immagine){
			$this->immagine=$immagine;
		}
		function setMetratura($metratura){
			$this->metratura=$metratura;
		}
		function setPrezzo($prezzo){
			$this->prezzo=$prezzo;
		}
		function setProprietario($proprietario){
			$this->proprietario=$proprietario;
		}
		function setTipo($tipo){
			$this->tipo=$tipo;
		}
		function setComune($comune){
			$this->comune=$comune;
		}
		
		/**
		 * Function: Select
		 * Description: Ricavo i valori di un immobile dal database e li setto nelle variabili di istanza
		 * @param $id id dell'immobile da cui ricavare i dati
		 */
		function select($id){
			$query="SELECT * FROM immobile WHERE id='$id';";
			$this->database->Query($query);
			$result=$this->database->result;
			$row=mysql_fetch_array($result);
			if($row){
				$this->id=$row[0];
				$this->approvato=$row[1];
				$this->agente=$row[2];
				$this->contratto=$row[3];
				$this->descrizione=$row[4];
				$this->proprietario=$row[5];
				$this->immagine=$row[6];
				$this->metratura=$row[7];
				$this->prezzo=$row[8];
				$this->tipo=$row[9];
				$this->comune=$row[10];
			}
		}
		
		/**
		 * Function: Update
		 * Description: Aggiorna i valori di un immobile già esistente nel database
		 * @param $id id dell'immobile da aggiornare, i valori nuovi saranno ricavati dalle variabili di istanza
		 */ 
		function update($id){
			$query="UPDATE immobile SET id='$this->id',approvato='$this->approvato',agente='$this->agente',tipoContratto='$this->contratto',descrizione='$this->descrizione',proprietario='$this->proprietario',immagine='$this->immagine',metratura='$this->metratura',prezzo='$this->prezzo',tipo='$this->tipo',comune='$this->comune' WHERE id='$id';";
			$this->database->query($query);
			$risultato=$this->database->result;
			return $risultato;
		}
		
		/**
		 * Function: Insert
		 * Description: Inserisce un nuovo immobile nel database, usando i valori già settati nelle variabili di istanza
		 * @param 
		 */ 
		function insert(){
			$query="INSERT INTO immobile(id, approvato, agente, tipoContratto, descrizione, proprietario, immagine, metratura, prezzo, tipo,comune) VALUES (NULL,'$this->approvato',NULL,'$this->contratto','$this->descrizione','$this->proprietario','$this->immagine' ,'$this->metratura' ,'$this->prezzo' ,'$this->tipo','$this->comune')";
			$this->database->query($query);
			return $this->database->result;
		}
		
		/**
		 * Function: Delete
		 * Description: Elimina un immobile dal database
		 * @param $id id dell'immobile da eliminare
		 */
		function delete($id){
			$query="DELETE FROM immobile WHERE id='$id';";
			$this->database->query($query);
			return $this->database->result;
		}
	}

?>
