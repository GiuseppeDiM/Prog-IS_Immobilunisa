<?php
	include_once("utente.php");
	include_once("database.php");
	include_once("interfacciaGestioneAccount.php");
	
	class FacadeGestioneAccount implements gestioneAccount{
		
		var $database;
		function FacadeGestioneAccount(){
			$this->database=new Database();
		}
		
		function login($user, $password){
			$utente=new Utente();
			$res=$utente->login($user,$password);
			if($res!="")
				return $utente;
			else return null;
		
		}
		
		//AGENTE
		function registraAgente($cod,$nome,$data,$email,$telefono,$username,$password){
			
			$agente=new Utente();
			if($cod==""||$nome==""||$data==""||$email==""||$telefono==""||$username==""||$password=="")
				return null;
			$query="SELECT * FROM utente WHERE codiceFiscale='$cod'";
			
			$this->database->query($query);
			$res=$this->database->result;
			$riga=mysql_fetch_array($res);
			if(isset($riga[0])) 
				return null;
			
			$agente->setCodice($cod);
			$agente->setNome($nome);
			$agente->setDataNascita($data);
			$agente->setEmail($email);
			$agente->setTelefono($telefono);
			$agente->setUsername($username);
			$agente->setPassword($password);
			$agente->setTipo("agente");
			$risultato=$agente->insert();
			if($risultato==1)
				return $agente;
			
		}
		
		function eliminaAgente($cod){
			$agente=new Utente();
			$query="SELECT * FROM utente WHERE codiceFiscale='$cod' and tipo='agente'";
			$this->database->query($query);
			$res=$this->database->result;
			$riga=mysql_fetch_array($res);
			if(isset($riga[0])){
				$agente->delete($cod);
				return 1;
				}
			else return 0;
			
		}
		
		function visualizzaAgente($cod){
			$agente=new Utente();
			$res=$agente->select($cod);
			return $agente;
			
		}
		
		function modificaAgente($cod,$cod2,$nome,$data,$email,$telefono,$username,$password){
			$agente=new Utente();
			if($cod==""||$cod2==""||$nome==""||$data==""||$email==""||$telefono==""||$username==""||$password=="")
				return null;
			$query="SELECT * FROM utente WHERE codiceFiscale='$cod' and tipo='agente'";
			
			$this->database->query($query);
			$res=$this->database->result;
			$riga=mysql_fetch_array($res);
			if(isset($riga[0])) {
			
				$agente->setCodice($cod2);
				$agente->setNome($nome);
				$agente->setDataNascita($data);
				$agente->setEmail($email);
				$agente->setTelefono($telefono);
				$agente->setUsername($username);
				$agente->setPassword($password);
				$agente->setTipo("agente");
				$agente->update($cod);
				return $agente;
			}
			else return null;
		}
		
		function getAgenti(){
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
		
		
	//UTENTE
		function registraCliente($cod,$nome,$data,$email,$telefono,$username,$password){
			
			$cliente=new Utente();
			if($cod==""||$nome==""||$data==""||$email==""||$telefono==""||$username==""||$password=="")
				return null;
			$query="SELECT * FROM utente WHERE codiceFiscale='$cod'";
			
			$this->database->query($query);
			$res=$this->database->result;
			$riga=mysql_fetch_array($res);
			if(isset($riga[0])) 
				return null;
			
			$cliente->setCodice($cod);
			$cliente->setNome($nome);
			$cliente->setDataNascita($data);
			$cliente->setEmail($email);
			$cliente->setTelefono($telefono);
			$cliente->setUsername($username);
			$cliente->setPassword($password);
			$cliente->setTipo("cliente");
			$risultato=$cliente->insert();
			if($risultato==1)
				return $cliente;
			
		}
		
		function eliminaCliente($cod){
			$cliente=new Utente();
			$query="SELECT * FROM utente WHERE codiceFiscale='$cod' and tipo='cliente'";
			$this->database->query($query);
			$res=$this->database->result;
			$riga=mysql_fetch_array($res);
			if(isset($riga[0])){
				$cliente->delete($cod);
				return 1;
				}
			else return 0;
			
		}
		
		function visualizzaCliente($cod){
			$cliente=new Utente();
			$res=$cliente->select($cod);
			return $cliente;
		}
		
		function modificaCliente($cod,$cod2,$nome,$data,$email,$telefono,$username,$password){
			$cliente=new Utente();
			if($cod==""||$cod2==""||$nome==""||$data==""||$email==""||$telefono==""||$username==""||$password=="")
				return null;
			$query="SELECT * FROM utente WHERE codiceFiscale='$cod' and tipo='cliente'";
			
			$this->database->query($query);
			$res=$this->database->result;
			$riga=mysql_fetch_array($res);
			if(isset($riga[0])){
			
				$cliente->setCodice($cod2);
				$cliente->setNome($nome);
				$cliente->setDataNascita($data);
				$cliente->setEmail($email);
				$cliente->setTelefono($telefono);
				$cliente->setUsername($username);
				$cliente->setPassword($password);
				$cliente->setTipo("cliente");
				$cliente->update($cod);
				return $cliente;
			}
			else return null;
		}
		
		function getUtenti(){
			$clienti=array();
			$query="SELECT codiceFiscale FROM utente WHERE tipo='cliente'";
			$this->database->query($query);
			$res=$this->database->result;
			
			$i=0;
			while($riga=mysql_fetch_array($res)){
				$cliente=new Utente();
				$id=$riga[0];
				$cliente->select($riga[0]);
				$clienti[$i]=$cliente;
				$i=$i+1;
				
			}
			if(isset($clienti)) return $clienti;
			else return null;
		
		}
	
	}
?>