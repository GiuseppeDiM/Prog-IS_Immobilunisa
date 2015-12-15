<?php
	include_once("database.php");
	include_once("trattativa.php");
	include_once("interfacciaGestioneTrattative.php");
	
	class facadeGestioneTrattative implements gestioneTrattative{
	
		function facadeGestioneTrattative(){
		
		}
		function approvaTrattativa($id){
			$trattativa=new Trattativa();
			$trattativa->select($id);
			if($trattativa->getApprovata()!=null){
				$trattativa->setApprovata(true);
				$trattativa->update($id);
				}
			else return null;
			return $trattativa;
		}
		
		function assegnaTrattativa($id,$agente){
			$trattativa=new Trattativa();
			$trattativa->select($id);
			//if($trattativa->getAgente()==null){
				$trattativa->setAgente($agente);
				$trattativa->update($id);
				return $trattativa;
			//}
			//return null;
		}
		
		function creaTrattativa( $acquirente, $agente, $immobile, $approvata){
		
			$trattativa=new Trattativa();
			
		
			$dt = new DateTime();
			$data= $dt->format('Y-m-d');
			$trattativa->setId(null);
			$trattativa->setAcquirente($acquirente);
			$trattativa->setAgente($agente);
			$trattativa->setImmobile($immobile);
			$trattativa->setData($data);
			$trattativa->setApprovata($approvata);
			
			$trattativa->insert();
			
			
		}
		
		function eliminaTrattativa($id){
		
			$trattativa=new Trattativa();
			
			$database=new Database();
			$query="SELECT * FROM trattativa WHERE id='$id'";
			$database->query($query);
			$res=$database->result;
			$riga=mysql_fetch_array($res);
			if($riga[0]!=null) {
				$trattativa->delete($id);
				return 1;
			}
				return 0;
		}
		
		function visualizzaTrattativa($id){
			$trattativa=new Trattativa();
			
			$database=new Database();
			$query="SELECT * FROM trattativa WHERE id='$id'";
			$database->query($query);
			$res=$database->result;
			$riga=mysql_fetch_array($res);
			if($riga[0]!=null) {
				$trattativa->select($id);
				return $trattativa;
			}
			return null;
		}
		
		function getTrattative(){
			$database=new Database();
			$trattative=array();
			$query="SELECT id FROM trattativa ";
			$database->query($query);
			$res=$database->result;
			
			$i=0;
			while($riga=mysql_fetch_array($res)){
				$trattativa=new Trattativa();
				$id=$riga[0];
				$trattativa->select($riga[0]);
				$trattative[$i]=$trattativa;
				$i=$i+1;
			}
			if(isset($trattative)) return $trattative;
			else return null;
		}
		
		
	}

?>