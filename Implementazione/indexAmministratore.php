<head>
</head>
<body>
<?php
include_once("subsystem/funzioni.php");
include_once("subsystem/facadeAccount.php");
include_once("subsystem/facadeTrattative.php");

if(isset($_GET['action'])){
	if($_GET['action']=='Registra'){
		$f=new FacadeGestioneAccount();
			$cod=$_GET['codiceFiscale'];
			$nome=$_GET['nome'];
			$data=$_GET['data'];
			$email=$_GET['email'];
			$telefono=$_GET['telefono'];
			$username=$_GET['username'];
			$password=$_GET['password'];
		
			if($f->registraAgente($cod,$nome,$data,$email,$telefono,$username,$password)==null)
				echo "<script type='text/javascript'>alert('Registrazione non riuscita');window.location.replace('indexAmministratore.php');</script>";
			else
				echo "<script type='text/javascript'>alert('Registrazione avvenuta con successo');window.location.replace('indexAmministratore.php');</script>";
			
	}
	else if($_GET['action']=='modifica'){
		formModificaUtente($_GET['cod']);
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
		
		if($f->modificaAgente($cod,$cod2,$nome,$data,$email,$telefono,$username,$password)==null)
			echo "<script type='text/javascript'>alert('Modifica non riuscita');window.location.replace('indexAmministratore.php');</script>";
		else
			echo "<script type='text/javascript'>alert('Modifica avvenuta con successo');window.location.replace('indexAmministratore.php');</script>";
			
	}
	else if($_GET['action']=='elimina'){
		$f=new FacadeGestioneAccount();
			$cod=$_GET['cod'];
			$res=$f->eliminaAgente($cod);
			if($res==0) echo "<script type='text/javascript'>alert('Eliminazione non riuscita');window.location.replace('indexAmministratore.php');</script>";
			else  	echo "<script type='text/javascript'>alert('Eliminazione avvenuta con successo');window.location.replace('indexAmministratore.php');</script>";

	}
	else if($_GET['action']=='assegna'){
		assegnaAgenti();
	}
	else if($_GET['action']=='assegnaImmobile'){
		$f=new FacadeGestioneImmobili();
		$res=$f->assegnaImmobile($_GET['oggetto'],$_GET['agente']);
		if($res==null) echo "<script type='text/javascript'>alert('Assegnazione non riuscita');window.location.replace('indexAmministratore.php');</script>";
		else  	echo "<script type='text/javascript'>alert('Assegnazione avvenuta con successo');window.location.replace('indexAmministratore.php');</script>";

	}
	else if($_GET['action']=='assegnaTrattativa'){
		$f=new FacadeGestioneTrattative();
		$res=$f->assegnaTrattativa($_GET['oggetto'],$_GET['agente']);
		if($res==null) echo "<script type='text/javascript'>alert('Assegnazione non riuscita');window.location.replace('indexAmministratore.php');</script>";
		else  	echo "<script type='text/javascript'>alert('Assegnazione avvenuta con successo');window.location.replace('indexAmministratore.php');</script>";

	}
}

else if(isset($_GET['bar'])){
	if($_GET['bar']=='agenti'){
		mostraClienti();
	}
	else if($_GET['bar']=='immobili'){
		mostraCatalogo();
	}
	else if($_GET['bar']=='trattative')
		mostraTrattative();
	
}
else if(isset($_GET['logout'])){
		logout();
}

else if(isset($_GET['cf'])){
	mostraUtente($_GET['cf']);
}
else if(isset($_GET['registra'])){
	formRegistrazioneCliente();
}
else if(isset($_GET['id'])){
	mostraImmobile($_GET['id']);
}

else{
	mostraNotifiche();
	
	}


?>
</body>