<?php
    include_once("database.php");
   // include_once("utenti.php");
	
	
class facadeMostraAgenti {
		var $database;
	
	function facadeMostraAccount(){
			$database=new Database();
		}
	
function visualizzaAgenti(){
			$agenti=array();
			$query="SELECT codiceFiscale FROM utente WHERE tipo='agente'";
			$this->database->query($query);
			$res=$this->database->result;
			
			$i=0;
			while($riga=mysql_fetch_array($res)){
				$agente=new Utente();
				$id=$riga[0];
				$agente->select($riga[0]);
				$agenti[$i]=$agente;
				$i=$i+1;
			}
			if(isset($agenti)) return $agenti;
			
			else return null;
		    }
		
        }
		?>