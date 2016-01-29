<?php
include_once("database.php");

/**
 * Class: Utente
 * Description: Classe che implementa un utente generico
 * @version 1.0
 * @created 10-gen-2016 17:39:15
 */
class Utente{
	var $codice; 		//Codice Fiscale
	var $nome;			
	var $dataNascita;
	var $email;
	var $telefono;
	var $username;
	var $password;
	var $tipo;			//può assumere uno tra i seguenti valori: cliente, amministratore, agente
	var $database;		//riferimento all'istanza del database con cui ci si è collegati
		
	/**
	 * Function: Utente
	 * Description: Costruttore della classe Utente
	 * @param
	 */ 
	function Utente(){
		$this->database=new Database();
	}

	//**********************METODI DI ACCESSO**********************//
	function getNome(){
		return $this->nome;
	}
	function getCodice(){
		return $this->codice;
	}
	function getDataNascita(){
		return $this->dataNascita;
	}
	function getEmail(){
		return $this->email;
	}
	function getTelefono(){
		return $this->telefono;
	}
	function getUsername(){
		return $this->username;
	}
	function getPassword(){
		return $this->password;
	}
	function getTipo(){
		return $this->tipo;
	}
	
	//**********************METODI MODIFICATORI**********************//	
	function setNome($nome){
		$this->nome=$nome;
	}
	function setCodice($cod){
		$this->codice=$cod;
	}
	function setDataNascita($data){
		$this->dataNascita=$data;
	}
	function setEmail($email){
		$this->email=$email;
	}
	function setTelefono($tel){
		$this->telefono=$tel;
	}
	function setUsername($username){
		$this->username=$username;
	}
	function setPassword($password){
		$this->password=$password;
	}
	function setTipo($tipo){
		return $this->tipo=$tipo;
	}
	
	/**
	 * Function: Login
	 * Description: Effettua la verifica per autorizzare l'accesso all'utente nel sistema.
	 * @param $user l'username immessa dall'utente
	 * @param $password la password immessa dall'utente
	 */ 
	function login($user,$password){
		$query="SELECT * FROM utente WHERE username='$user' and psswd='$password'";
		$this->database->query($query);
		$result=$this->database->result;
		$row=mysql_fetch_array($result);
		if($row){
			$this->codice=$row[0];
			$this->nome=$row[1];
			$this->dataNascita=$row[2];
			$this->email=$row[3];
			$this->telefono=$row[4];
			$this->username=$row[5];
			$this->password=$row[6];
			$this->tipo=$row[7];
			return "Login Effettuato";
		}
		else return "";
	}
	
	/**
	 * Function: Insert
	 * Description: Inserisce un nuovo utente nel database, usando i valori già settati nelle variabili di istanza
	 * @param 
	 */ 
	function insert(){
		$query="INSERT INTO utente(codiceFiscale, nome, dataNascita, email, telefono, username, psswd, tipo) VALUES('$this->codice','$this->nome','$this->dataNascita','$this->email','$this->telefono','$this->username','$this->password','$this->tipo')";
		$this->database->query($query);
		return $this->database->result;
	}
	
	/**
	 * Function: Delete
	 * Description: Elimina un utente dal database
	 * @param $codice codice dell'utente da eliminare
	 */ 
	function delete($codice) {
		$sql = "DELETE FROM utente WHERE codiceFiscale = '$codice';";
		$this->database->query($sql);
		return $this->database->result;
	}
	
	/**
	 * Function: Update
	 * Description: Aggiorna i valori di un utente già esistente nel database
	 * @param $id id dell'utente da aggiornare, i valori nuovi saranno ricavati dalle variabili di istanza
	 */ 
	function update($id) {
		$sql = " UPDATE utente SET  codiceFiscale='$this->codice', nome = '$this->nome',dataNascita='$this->dataNascita',email='$this->email',telefono='$this->telefono',username = '$this->username',psswd = '$this->password',tipo = '$this->tipo' WHERE codiceFiscale = '$id' ";
		$result = $this->database->query($sql);
		return $this->database->result;
	}
	
	/**
	 * Function: Select
	 * Description: Ricavo i valori di un utente dal database e li setto nelle variabili di istanza
	 * @param $id id dell'utente da cui ricavare i dati
	 */
	function select($id){
		$sql =  "SELECT * FROM utente WHERE codiceFiscale = '$id';";
		$result =  $this->database->query($sql);
		$result = $this->database->result;
		$row=mysql_fetch_array($result);
		if($row){
				$this->codice=$row[0];
				$this->nome=$row[1];
				$this->dataNascita=$row[2];
				$this->email=$row[3];
				$this->telefono=$row[4];
				$this->username=$row[5];
				$this->password=$row[6];
				$this->tipo=$row[7];
		}
		return $this->database->result;
	}

}
?>
