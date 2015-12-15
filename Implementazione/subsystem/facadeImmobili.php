<?php
	include_once("database.php");
	include_once("immobile.php");
	include_once("interfacciaGestioneImmobili.php");
	
	class facadeGestioneImmobili implements gestioneImmobili{
		var $database;
		
		function facadeGestioneImmobili(){
			$database=new Database();
		}
		
		function approvaImmobile($id){
			$immobile=new Immobile();
			$immobile->select($id);
			if($immobile->getApprovato()!=null){
				$immobile->setApprovato(true);
				$immobile->update($id);
				}
			else return null;
			return $immobile;
		}
		
		function assegnaImmobile($id,$agente){
			$immobile=new Immobile();
			$immobile->select($id);
			if($immobile->getAgente()==null){
				$immobile->setAgente($agente);
				$immobile->update($id);
				return $immobile;
			}
			else return null;
		}
	
		function creaImmobile( $approvato, $tipoContratto, $descrizione, $proprietario, $immagine, $metratura, $prezzo, $tipo,$comune){
			$immobile=new Immobile();
			
			$immobile->setApprovato($approvato);
			$immobile->setContratto($tipoContratto);
			$immobile->setDescrizione($descrizione);
			$immobile->setProprietario($proprietario);
			
			$immobile->setImmagine($immagine);
			$immobile->setMetratura($metratura);
			$immobile->setPrezzo($prezzo);
			$immobile->setTipo($tipo);
			$immobile->setComune($comune);
			
			$immobile->insert();
			
		
		
		}
	
		function cancellaImmobile($id){
				$immobile=new Immobile();
			
			$database=new Database();
			$query="SELECT * FROM immobile WHERE id='$id'";
			$database->query($query);
			$res=$database->result;
			$riga=mysql_fetch_array($res);
			if($riga[0]!=null) {
				$immobile->delete($id);
				return 1;
			}
				return 0;
		
		}
		
		function modificaImmobile($id, $approvato, $agente, $tipoContratto, $descrizione, $proprietario, $immagine, $metratura, $prezzo, $tipo,$comune){
		
			$immobile=new Immobile();
			
			$database=new Database();
			$query="SELECT * FROM immobile WHERE id='$id'";
			$database->query($query);
			$res=$database->result;
			$riga=mysql_fetch_array($res);
			if($riga[0]!=null) {
				$immobile->setId($id);
				$immobile->setApprovato($approvato);
				$immobile->setAgente($agente);
				$immobile->setContratto($tipoContratto);
				$immobile->setDescrizione($descrizione);
				$immobile->setProprietario($proprietario);
				$immobile->setImmagine($immagine);
				$immobile->setMetratura($metratura);
				$immobile->setPrezzo($prezzo);
				$immobile->setTipo($tipo);
				$immobile->setComune($comune);
				$immobile->update($id);
				return $immobile;
			}
			return null;
		
		}
		
		function visualizzaImmobile($id){
			$immobile=new Immobile();
			
			$database=new Database();
			$query="SELECT * FROM immobile WHERE id='$id'";
			$database->query($query);
			$res=$database->result;
			$riga=mysql_fetch_array($res);
			if($riga[0]!=null) {
				$immobile->select($id);
				return $immobile;
			}
			return null;
		}
		
		function getImmobili(){
			$database=new Database();
			$immobili=array();
			$query="SELECT id FROM immobile ";
			$database->query($query);
			$res=$database->result;
			
			$i=0;
			while($riga=mysql_fetch_array($res)){
				$immobile=new Immobile();
				$id=$riga[0];
				$immobile->select($riga[0]);
				$immobili[$i]=$immobile;
				$i=$i+1;
			}
			if(isset($immobili)) return $immobili;
			else return null;
		}
		
		
	}

?>