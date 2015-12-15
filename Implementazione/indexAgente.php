<head>
</head>
<body>
<?php
include_once("subsystem/funzioni.php");
include_once("subsystem/facadeAccount.php");
include_once("subsystem/facadeTrattative.php");

	if(isset($_GET['bar'])){
		if($_GET['bar']=='clienti')
			mostraClienti();
		else if($_GET['bar']=='immobili')
			mostraCatalogo();
		else if($_GET['bar']=='trattative')
			mostraTrattative();
			}
	
	else if(isset($_GET['avvisi'])){
		mostraNotifiche();
	
	}
	else if(isset($_GET['registra'])){
		formRegistrazioneCliente();
	
	}
	else if(isset($_GET['id'])){
		mostraImmobile($_GET['id']);
	}
	
	else if(isset($_GET['action'])){
	
	
		if($_GET['action']=='Registra'){
			$f=new FacadeGestioneAccount();
			$cod=$_GET['codiceFiscale'];
		
	
			$nome=$_GET['nome'];
			$data=$_GET['data'];
			$email=$_GET['email'];
			$telefono=$_GET['telefono'];
			$username=$_GET['username'];
			$password=$_GET['password'];
		
			if($f->registraCliente($cod,$nome,$data,$email,$telefono,$username,$password)==null)
				echo "<script type='text/javascript'>alert('Registrazione non riuscita');window.location.replace('indexAgente.php?registra=RegistraCliente');</script>";
			else
				echo "<script type='text/javascript'>alert('Registrazione avvenuta con successo');window.location.replace('indexAgente.php');</script>";
			
	
		}
		else if($_GET['action']=='modifica'){
			$cod=$_GET['cod'];
			formModificaUtente($cod);
		}
		else if($_GET['action']=='conferma'){
			$f=new FacadeGestioneAccount();
			if(isset($_SESSION['modificaUtente'])) $cod=$_SESSION['modificaUtente'];
			$cod2=$_GET['codiceFiscale'];
	
		$nome=$_GET['nome'];
		$data=$_GET['data'];
		$email=$_GET['email'];
		$telefono=$_GET['telefono'];
		$username=$_GET['username'];
		$password=$_GET['password'];
		
		if($f->modificaCliente($cod,$cod2,$nome,$data,$email,$telefono,$username,$password)==null)
			echo "<script type='text/javascript'>alert('Modifica non riuscita');window.location.replace('indexAgente.php');</script>";
		else
			echo "<script type='text/javascript'>alert('Modifica avvenuta con successo');window.location.replace('indexAgente.php');</script>";
			
		}
		else if($_GET['action']=='elimina'){
			$f=new FacadeGestioneAccount();
			$cod=$_GET['cod'];
			$res=$f->eliminaCliente($cod);
			if($res==0) echo "<script type='text/javascript'>alert('Eliminazione non riuscita');window.location.replace('indexAgente.php');</script>";
			else  	echo "<script type='text/javascript'>alert('Eliminazione avvenuta con successo');window.location.replace('indexAgente.php?bar=clienti');</script>";

		}
		else if($_GET['action']=='approva'){
			$f=new FacadeGestioneImmobili();
			$res=$f->approvaImmobile($_GET['immobile']);
			if($res==null) echo "<script type='text/javascript'>alert('Errore');window.location.replace('indexAgente.php');</script>";
			else  	echo "<script type='text/javascript'>alert('Approvazione avvenuta con successo');window.location.replace('indexAgente.php?bar=clienti');</script>";

			
		}
		else if($_GET['action']=='eliminaImmobile'){
			$f=new FacadeGestioneImmobili();
			$res=$f->cancellaImmobile($_GET['immobile']);
			if($res==0) echo "<script type='text/javascript'>alert('Eliminazione non riuscita');window.location.replace('indexAgente.php');</script>";
			else  	echo "<script type='text/javascript'>alert('Eliminazione avvenuta con successo');window.location.replace('indexAgente.php?bar=immobili');</script>";

		}
		else if($_GET['action']=='modificaImmobile'){
			formModificaImmobile($_GET['immobile']);
		
		}
	}

	else if(isset($_GET['modificaImmobile'])){
		$f=new FacadeGestioneImmobili();
		$id=$_GET['modificaImmobile'];
		$immobile=$f->visualizzaImmobile($id);
		$approvato=$immobile->getApprovato();
		$agente=$immobile->getAgente();
		$tipoContratto=$_GET['contratto'];
		$descrizione=$_GET['descrizione'];
		$proprietario=$immobile->getProprietario();
		$immagine=$_GET['immagine'];
		$comune=$_GET['comune'];
		$metratura=floatval($_GET['metratura']);
		$prezzo=floatval($_GET['prezzo']);
		$tipo=$_GET['tipo'];
		$res=$f->modificaImmobile($id, $approvato, $agente, $tipoContratto, $descrizione, $proprietario, $immagine, $metratura, $prezzo, $tipo,$comune);
		if($res==null)
			echo "<script type='text/javascript'>alert('Modifica non riuscita');window.location.replace('indexAgente.php');</script>";
		else
			echo "<script type='text/javascript'>alert('Modifica avvenuta con successo');window.location.replace('indexAgente.php');</script>";
					
	}
	else if(isset($_GET['cf']))
		mostraUtente($_GET['cf']);
		
	
	else if(isset($_GET['logout'])){
		logout();
}
	else if(isset($_GET['approva'])){
		$f=new FacadeGestioneTrattative();
		$res=$f->approvaTrattativa($_GET['approva']);
		if($res!=null) 			
			echo "<script type='text/javascript'>alert('Trattativa Approvata');window.location.replace('indexAgente.php?bar=trattative');</script>";
		else 	echo "<script type='text/javascript'>alert('Errore');window.location.replace('indexAgente.php?bar=trattative');</script>";


	}
	else if(isset($_GET['eliminaTrattativa'])){
		$f=new FacadeGestioneTrattative();
		$res=$f->eliminaTrattativa($_GET['eliminaTrattativa']);
		if($res==1) echo "<script type='text/javascript'>alert('Trattativa Eliminata');window.location.replace('indexAgente.php?bar=trattative');</script>";
		else 	echo "<script type='text/javascript'>alert('Errore');window.location.replace('indexAgente.php?bar=trattative');</script>";

	
	}
	
	else{
		mostraNotifiche();
	}
	
	
	
?>
</body>