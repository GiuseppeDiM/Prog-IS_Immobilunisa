<?php
include_once("database.php");

/**
 * Class: Trattativa
 * Description: Classe che implementa una trattativa
 * @version 1.0
 * @created 10-gen-2016 17:39:15
 */
class Trattativa{
	
	var $database;
	var $id;
	var $aquirente;		//Codice dell'acquirente a cui è associata la trattativa
	var $agente;		//Codice dell'agente a cui è associata la trattativa
	var $immobile;		//Codice dell'immobile a cui è riferita la trattativa
	var $data;
	var $approvata;
	
	/**
	 * Function: Trattativa
	 * Description: Costruttore della classe Trattativa
	 * @param
	 */ 
	function Trattativa(){
		$this->database=new Database();
	}
	
	//***********************METODI DI ACCESSO***********************//
	function getId(){
		return $this->id;
	}
	function getAcquirente(){
		return $this->acquirente;
	}
	function getAgente(){
		return $this->agente;
	}
	function getImmobile(){
		return $this->immobile;
	}
	function getData(){
		return $this->data;
	}
	function getApprovata(){
		return $this->approvata;
	}
	
	//***********************METODI MODIFICATORI***********************//
	function setId($id){
		$this->id=$id;
	}
	function setAcquirente($acquirente){
		$this->acquirente=$acquirente;
	}
	function setAgente($agente){
		$this->agente=$agente;
	}
	function setImmobile($immobile){
		$this->immobile=$immobile;
	}
	function setData($data){
		$this->data=$data;
	}
	function setApprovata($approvata){
		$this->approvata=$approvata;
	}
	
	/**
	 * Function: Select
	 * Description: Ricavo i valori di una trattativa dal database e li setto nelle variabili di istanza
	 * @param $id id della trattativa da cui ricavare i dati
	 */
	function select($id){
		$query="SELECT * FROM trattativa WHERE id='$id';";
		$this->database->query($query);
		$result=$this->database->result;
		$row=mysql_fetch_array($result);
		if($row){
			$this->id=$row[0];
			$this->acquirente=$row[1];
			$this->agente=$row[2];
			$this->immobile=$row[3];
			$this->data=$row[4];
			$this->approvata=$row[5];		
		}
	}
	
	/**
	 * Function: Insert
	 * Description: Inserisce una nuova trattativa nel database, usando i valori già settati nelle variabili di istanza
	 * @param 
	 */
	function insert(){
		$query="INSERT INTO trattativa(id, acquirente, agente, immobile, dataSottomissione, approvata) VALUES (NULL,'$this->acquirente',NULL,'$this->immobile','$this->data','$this->approvata')";
		$this->database->query($query);
		return $this->database->result;
	}
	
	/**
	 * Function: Delete
	 * Description: Elimina una trattativa dal database
	 * @param $id id della trattativa da eliminare
	 */
	function delete($id){
		$query="DELETE FROM trattativa WHERE id='$id';";
		$this->database->query($query);
		return $this->database->result;
	}
	
	/**
	 * Function: Update
	 * Description: Aggiorna i valori di una trattativa già esistente nel database
	 * @param $id id della trattativa da aggiornare, i valori nuovi saranno ricavati dalle variabili di istanza
	 */ 
	function update($id){
		$query="UPDATE trattativa SET id='$this->id',acquirente='$this->acquirente',agente='$this->agente',immobile='$this->immobile',dataSottomissione='$this->data',approvata='$this->approvata' WHERE id='$id'";
		$this->database->query($query);
		$risultato=$this->database->result;
		return $risultato;
	}

}
?>
