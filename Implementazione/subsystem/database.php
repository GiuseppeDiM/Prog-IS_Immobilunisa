<?php
/**
 * Class: Database
 * Description: Classe che implementa le funzioni utili alla comunicazione con il DB predefinito
 * @version 1.0
 * @created 10-gen-2015 17:39:15
 */
class Database { 	
	var $host;  	//Hostname, Server
	var $password; 	//Password MySQL
	var $user; 		//Utente MySQL
	var $database; 	//Database MySQL
	var $link;		//Riferimento alla connessione al database
	var $query;		//Query MySQL
	var $result;	//Risultato della query
	var $rows;		

	/**
	 * Function: Database
	 * Description: Costruttore della classe Database
	 * @param
	 */ 
	function Database() {
		$this->host = "localhost";
		$this->password = "ciro1scala2";
		$this->user = "root";            
		$this->database = "immobilunisa";           
		$this->rows = 0; 
	} 
	
	/**
	 * Function: OpenLink
	 * Description: Instaura il collegamento al database
	 * @param
	 */ 
	function OpenLink() { 
		$this->link = @mysql_connect($this->host,$this->user) or die (print "Class Database: Errore durente la conessione al DB");
	}

	/**
	 * Function: SelectDB
	 * Description: Seleziona il database dal server
	 * @param
	 */ 
	function SelectDB() { 
		@mysql_select_db($this->database,$this->link) or die (print "Class Database: Errore durante la selezione del DB");
	}

	/**
	 * Function: CloseDB
	 * Description: Chiude la connessione col database utilizzato
	 * @param
	 */ 
	function CloseDB() {
		mysql_close();
	} 

	/**
	 * Function: Query
	 * Description: Esegue la query passata per parametro e ne restituisce il risultato
	 * @param $query Contiene la query da eseguire
	 */ 
	function Query($query) { 
		$this->OpenLink();
		$this->SelectDB();
		$this->query = $query;
		$this->result = mysql_query($query,$this->link) or die (print "Class Database: Errore durante l'esecuzione della Query");
		//$rows=mysql_affected_rows();

		if( preg_match("/SELECT/", $query) ) {
			$this->rows = mysql_num_rows($this->result);
		}
		$this->CloseDB();
	}

}
?>
